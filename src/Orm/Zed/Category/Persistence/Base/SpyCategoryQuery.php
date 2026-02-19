<?php

namespace Orm\Zed\Category\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet;
use Orm\Zed\Category\Persistence\SpyCategory as ChildSpyCategory;
use Orm\Zed\Category\Persistence\SpyCategoryQuery as ChildSpyCategoryQuery;
use Orm\Zed\Category\Persistence\Map\SpyCategoryTableMap;
use Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector;
use Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory;
use Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilter;
use Orm\Zed\ProductCategory\Persistence\SpyProductCategory;
use Orm\Zed\ProductList\Persistence\SpyProductListCategory;
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
 * Base class that represents a query for the `spy_category` table.
 *
 * @method     ChildSpyCategoryQuery orderByIdCategory($order = Criteria::ASC) Order by the id_category column
 * @method     ChildSpyCategoryQuery orderByFkCategoryTemplate($order = Criteria::ASC) Order by the fk_category_template column
 * @method     ChildSpyCategoryQuery orderByCategoryKey($order = Criteria::ASC) Order by the category_key column
 * @method     ChildSpyCategoryQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyCategoryQuery orderByIsClickable($order = Criteria::ASC) Order by the is_clickable column
 * @method     ChildSpyCategoryQuery orderByIsInMenu($order = Criteria::ASC) Order by the is_in_menu column
 * @method     ChildSpyCategoryQuery orderByIsSearchable($order = Criteria::ASC) Order by the is_searchable column
 *
 * @method     ChildSpyCategoryQuery groupByIdCategory() Group by the id_category column
 * @method     ChildSpyCategoryQuery groupByFkCategoryTemplate() Group by the fk_category_template column
 * @method     ChildSpyCategoryQuery groupByCategoryKey() Group by the category_key column
 * @method     ChildSpyCategoryQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyCategoryQuery groupByIsClickable() Group by the is_clickable column
 * @method     ChildSpyCategoryQuery groupByIsInMenu() Group by the is_in_menu column
 * @method     ChildSpyCategoryQuery groupByIsSearchable() Group by the is_searchable column
 *
 * @method     ChildSpyCategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyCategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyCategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyCategoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyCategoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyCategoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyCategoryQuery leftJoinCategoryTemplate($relationAlias = null) Adds a LEFT JOIN clause to the query using the CategoryTemplate relation
 * @method     ChildSpyCategoryQuery rightJoinCategoryTemplate($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CategoryTemplate relation
 * @method     ChildSpyCategoryQuery innerJoinCategoryTemplate($relationAlias = null) Adds a INNER JOIN clause to the query using the CategoryTemplate relation
 *
 * @method     ChildSpyCategoryQuery joinWithCategoryTemplate($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CategoryTemplate relation
 *
 * @method     ChildSpyCategoryQuery leftJoinWithCategoryTemplate() Adds a LEFT JOIN clause and with to the query using the CategoryTemplate relation
 * @method     ChildSpyCategoryQuery rightJoinWithCategoryTemplate() Adds a RIGHT JOIN clause and with to the query using the CategoryTemplate relation
 * @method     ChildSpyCategoryQuery innerJoinWithCategoryTemplate() Adds a INNER JOIN clause and with to the query using the CategoryTemplate relation
 *
 * @method     ChildSpyCategoryQuery leftJoinAttribute($relationAlias = null) Adds a LEFT JOIN clause to the query using the Attribute relation
 * @method     ChildSpyCategoryQuery rightJoinAttribute($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Attribute relation
 * @method     ChildSpyCategoryQuery innerJoinAttribute($relationAlias = null) Adds a INNER JOIN clause to the query using the Attribute relation
 *
 * @method     ChildSpyCategoryQuery joinWithAttribute($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Attribute relation
 *
 * @method     ChildSpyCategoryQuery leftJoinWithAttribute() Adds a LEFT JOIN clause and with to the query using the Attribute relation
 * @method     ChildSpyCategoryQuery rightJoinWithAttribute() Adds a RIGHT JOIN clause and with to the query using the Attribute relation
 * @method     ChildSpyCategoryQuery innerJoinWithAttribute() Adds a INNER JOIN clause and with to the query using the Attribute relation
 *
 * @method     ChildSpyCategoryQuery leftJoinNode($relationAlias = null) Adds a LEFT JOIN clause to the query using the Node relation
 * @method     ChildSpyCategoryQuery rightJoinNode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Node relation
 * @method     ChildSpyCategoryQuery innerJoinNode($relationAlias = null) Adds a INNER JOIN clause to the query using the Node relation
 *
 * @method     ChildSpyCategoryQuery joinWithNode($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Node relation
 *
 * @method     ChildSpyCategoryQuery leftJoinWithNode() Adds a LEFT JOIN clause and with to the query using the Node relation
 * @method     ChildSpyCategoryQuery rightJoinWithNode() Adds a RIGHT JOIN clause and with to the query using the Node relation
 * @method     ChildSpyCategoryQuery innerJoinWithNode() Adds a INNER JOIN clause and with to the query using the Node relation
 *
 * @method     ChildSpyCategoryQuery leftJoinSpyCategoryStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCategoryStore relation
 * @method     ChildSpyCategoryQuery rightJoinSpyCategoryStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCategoryStore relation
 * @method     ChildSpyCategoryQuery innerJoinSpyCategoryStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCategoryStore relation
 *
 * @method     ChildSpyCategoryQuery joinWithSpyCategoryStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCategoryStore relation
 *
 * @method     ChildSpyCategoryQuery leftJoinWithSpyCategoryStore() Adds a LEFT JOIN clause and with to the query using the SpyCategoryStore relation
 * @method     ChildSpyCategoryQuery rightJoinWithSpyCategoryStore() Adds a RIGHT JOIN clause and with to the query using the SpyCategoryStore relation
 * @method     ChildSpyCategoryQuery innerJoinWithSpyCategoryStore() Adds a INNER JOIN clause and with to the query using the SpyCategoryStore relation
 *
 * @method     ChildSpyCategoryQuery leftJoinSpyCategoryImageSet($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCategoryImageSet relation
 * @method     ChildSpyCategoryQuery rightJoinSpyCategoryImageSet($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCategoryImageSet relation
 * @method     ChildSpyCategoryQuery innerJoinSpyCategoryImageSet($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCategoryImageSet relation
 *
 * @method     ChildSpyCategoryQuery joinWithSpyCategoryImageSet($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCategoryImageSet relation
 *
 * @method     ChildSpyCategoryQuery leftJoinWithSpyCategoryImageSet() Adds a LEFT JOIN clause and with to the query using the SpyCategoryImageSet relation
 * @method     ChildSpyCategoryQuery rightJoinWithSpyCategoryImageSet() Adds a RIGHT JOIN clause and with to the query using the SpyCategoryImageSet relation
 * @method     ChildSpyCategoryQuery innerJoinWithSpyCategoryImageSet() Adds a INNER JOIN clause and with to the query using the SpyCategoryImageSet relation
 *
 * @method     ChildSpyCategoryQuery leftJoinSpyCmsBlockCategoryConnector($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCmsBlockCategoryConnector relation
 * @method     ChildSpyCategoryQuery rightJoinSpyCmsBlockCategoryConnector($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCmsBlockCategoryConnector relation
 * @method     ChildSpyCategoryQuery innerJoinSpyCmsBlockCategoryConnector($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCmsBlockCategoryConnector relation
 *
 * @method     ChildSpyCategoryQuery joinWithSpyCmsBlockCategoryConnector($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCmsBlockCategoryConnector relation
 *
 * @method     ChildSpyCategoryQuery leftJoinWithSpyCmsBlockCategoryConnector() Adds a LEFT JOIN clause and with to the query using the SpyCmsBlockCategoryConnector relation
 * @method     ChildSpyCategoryQuery rightJoinWithSpyCmsBlockCategoryConnector() Adds a RIGHT JOIN clause and with to the query using the SpyCmsBlockCategoryConnector relation
 * @method     ChildSpyCategoryQuery innerJoinWithSpyCmsBlockCategoryConnector() Adds a INNER JOIN clause and with to the query using the SpyCmsBlockCategoryConnector relation
 *
 * @method     ChildSpyCategoryQuery leftJoinSpyMerchantCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchantCategory relation
 * @method     ChildSpyCategoryQuery rightJoinSpyMerchantCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchantCategory relation
 * @method     ChildSpyCategoryQuery innerJoinSpyMerchantCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchantCategory relation
 *
 * @method     ChildSpyCategoryQuery joinWithSpyMerchantCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchantCategory relation
 *
 * @method     ChildSpyCategoryQuery leftJoinWithSpyMerchantCategory() Adds a LEFT JOIN clause and with to the query using the SpyMerchantCategory relation
 * @method     ChildSpyCategoryQuery rightJoinWithSpyMerchantCategory() Adds a RIGHT JOIN clause and with to the query using the SpyMerchantCategory relation
 * @method     ChildSpyCategoryQuery innerJoinWithSpyMerchantCategory() Adds a INNER JOIN clause and with to the query using the SpyMerchantCategory relation
 *
 * @method     ChildSpyCategoryQuery leftJoinSpyProductCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductCategory relation
 * @method     ChildSpyCategoryQuery rightJoinSpyProductCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductCategory relation
 * @method     ChildSpyCategoryQuery innerJoinSpyProductCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductCategory relation
 *
 * @method     ChildSpyCategoryQuery joinWithSpyProductCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductCategory relation
 *
 * @method     ChildSpyCategoryQuery leftJoinWithSpyProductCategory() Adds a LEFT JOIN clause and with to the query using the SpyProductCategory relation
 * @method     ChildSpyCategoryQuery rightJoinWithSpyProductCategory() Adds a RIGHT JOIN clause and with to the query using the SpyProductCategory relation
 * @method     ChildSpyCategoryQuery innerJoinWithSpyProductCategory() Adds a INNER JOIN clause and with to the query using the SpyProductCategory relation
 *
 * @method     ChildSpyCategoryQuery leftJoinSpyProductCategoryFilter($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductCategoryFilter relation
 * @method     ChildSpyCategoryQuery rightJoinSpyProductCategoryFilter($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductCategoryFilter relation
 * @method     ChildSpyCategoryQuery innerJoinSpyProductCategoryFilter($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductCategoryFilter relation
 *
 * @method     ChildSpyCategoryQuery joinWithSpyProductCategoryFilter($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductCategoryFilter relation
 *
 * @method     ChildSpyCategoryQuery leftJoinWithSpyProductCategoryFilter() Adds a LEFT JOIN clause and with to the query using the SpyProductCategoryFilter relation
 * @method     ChildSpyCategoryQuery rightJoinWithSpyProductCategoryFilter() Adds a RIGHT JOIN clause and with to the query using the SpyProductCategoryFilter relation
 * @method     ChildSpyCategoryQuery innerJoinWithSpyProductCategoryFilter() Adds a INNER JOIN clause and with to the query using the SpyProductCategoryFilter relation
 *
 * @method     ChildSpyCategoryQuery leftJoinSpyProductListCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductListCategory relation
 * @method     ChildSpyCategoryQuery rightJoinSpyProductListCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductListCategory relation
 * @method     ChildSpyCategoryQuery innerJoinSpyProductListCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductListCategory relation
 *
 * @method     ChildSpyCategoryQuery joinWithSpyProductListCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductListCategory relation
 *
 * @method     ChildSpyCategoryQuery leftJoinWithSpyProductListCategory() Adds a LEFT JOIN clause and with to the query using the SpyProductListCategory relation
 * @method     ChildSpyCategoryQuery rightJoinWithSpyProductListCategory() Adds a RIGHT JOIN clause and with to the query using the SpyProductListCategory relation
 * @method     ChildSpyCategoryQuery innerJoinWithSpyProductListCategory() Adds a INNER JOIN clause and with to the query using the SpyProductListCategory relation
 *
 * @method     \Orm\Zed\Category\Persistence\SpyCategoryTemplateQuery|\Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery|\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery|\Orm\Zed\Category\Persistence\SpyCategoryStoreQuery|\Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetQuery|\Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery|\Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery|\Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery|\Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilterQuery|\Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyCategory|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyCategory matching the query
 * @method     ChildSpyCategory findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyCategory matching the query, or a new ChildSpyCategory object populated from the query conditions when no match is found
 *
 * @method     ChildSpyCategory|null findOneByIdCategory(int $id_category) Return the first ChildSpyCategory filtered by the id_category column
 * @method     ChildSpyCategory|null findOneByFkCategoryTemplate(int $fk_category_template) Return the first ChildSpyCategory filtered by the fk_category_template column
 * @method     ChildSpyCategory|null findOneByCategoryKey(string $category_key) Return the first ChildSpyCategory filtered by the category_key column
 * @method     ChildSpyCategory|null findOneByIsActive(boolean $is_active) Return the first ChildSpyCategory filtered by the is_active column
 * @method     ChildSpyCategory|null findOneByIsClickable(boolean $is_clickable) Return the first ChildSpyCategory filtered by the is_clickable column
 * @method     ChildSpyCategory|null findOneByIsInMenu(boolean $is_in_menu) Return the first ChildSpyCategory filtered by the is_in_menu column
 * @method     ChildSpyCategory|null findOneByIsSearchable(boolean $is_searchable) Return the first ChildSpyCategory filtered by the is_searchable column
 *
 * @method     ChildSpyCategory requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyCategory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategory requireOne(?ConnectionInterface $con = null) Return the first ChildSpyCategory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCategory requireOneByIdCategory(int $id_category) Return the first ChildSpyCategory filtered by the id_category column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategory requireOneByFkCategoryTemplate(int $fk_category_template) Return the first ChildSpyCategory filtered by the fk_category_template column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategory requireOneByCategoryKey(string $category_key) Return the first ChildSpyCategory filtered by the category_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategory requireOneByIsActive(boolean $is_active) Return the first ChildSpyCategory filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategory requireOneByIsClickable(boolean $is_clickable) Return the first ChildSpyCategory filtered by the is_clickable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategory requireOneByIsInMenu(boolean $is_in_menu) Return the first ChildSpyCategory filtered by the is_in_menu column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyCategory requireOneByIsSearchable(boolean $is_searchable) Return the first ChildSpyCategory filtered by the is_searchable column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyCategory[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyCategory objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyCategory> find(?ConnectionInterface $con = null) Return ChildSpyCategory objects based on current ModelCriteria
 *
 * @method     ChildSpyCategory[]|Collection findByIdCategory(int|array<int> $id_category) Return ChildSpyCategory objects filtered by the id_category column
 * @psalm-method Collection&\Traversable<ChildSpyCategory> findByIdCategory(int|array<int> $id_category) Return ChildSpyCategory objects filtered by the id_category column
 * @method     ChildSpyCategory[]|Collection findByFkCategoryTemplate(int|array<int> $fk_category_template) Return ChildSpyCategory objects filtered by the fk_category_template column
 * @psalm-method Collection&\Traversable<ChildSpyCategory> findByFkCategoryTemplate(int|array<int> $fk_category_template) Return ChildSpyCategory objects filtered by the fk_category_template column
 * @method     ChildSpyCategory[]|Collection findByCategoryKey(string|array<string> $category_key) Return ChildSpyCategory objects filtered by the category_key column
 * @psalm-method Collection&\Traversable<ChildSpyCategory> findByCategoryKey(string|array<string> $category_key) Return ChildSpyCategory objects filtered by the category_key column
 * @method     ChildSpyCategory[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyCategory objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyCategory> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyCategory objects filtered by the is_active column
 * @method     ChildSpyCategory[]|Collection findByIsClickable(boolean|array<boolean> $is_clickable) Return ChildSpyCategory objects filtered by the is_clickable column
 * @psalm-method Collection&\Traversable<ChildSpyCategory> findByIsClickable(boolean|array<boolean> $is_clickable) Return ChildSpyCategory objects filtered by the is_clickable column
 * @method     ChildSpyCategory[]|Collection findByIsInMenu(boolean|array<boolean> $is_in_menu) Return ChildSpyCategory objects filtered by the is_in_menu column
 * @psalm-method Collection&\Traversable<ChildSpyCategory> findByIsInMenu(boolean|array<boolean> $is_in_menu) Return ChildSpyCategory objects filtered by the is_in_menu column
 * @method     ChildSpyCategory[]|Collection findByIsSearchable(boolean|array<boolean> $is_searchable) Return ChildSpyCategory objects filtered by the is_searchable column
 * @psalm-method Collection&\Traversable<ChildSpyCategory> findByIsSearchable(boolean|array<boolean> $is_searchable) Return ChildSpyCategory objects filtered by the is_searchable column
 *
 * @method     ChildSpyCategory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyCategory> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyCategoryQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Category\Persistence\Base\SpyCategoryQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Category\\Persistence\\SpyCategory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyCategoryQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyCategoryQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyCategoryQuery) {
            return $criteria;
        }
        $query = new ChildSpyCategoryQuery();
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
     * @return ChildSpyCategory|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyCategoryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyCategory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_category, fk_category_template, category_key, is_active, is_clickable, is_in_menu, is_searchable FROM spy_category WHERE id_category = :p0';
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
            /** @var ChildSpyCategory $obj */
            $obj = new ChildSpyCategory();
            $obj->hydrate($row);
            SpyCategoryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyCategory|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyCategoryTableMap::COL_ID_CATEGORY, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyCategoryTableMap::COL_ID_CATEGORY, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idCategory Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCategory_Between(array $idCategory)
    {
        return $this->filterByIdCategory($idCategory, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idCategorys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdCategory_In(array $idCategorys)
    {
        return $this->filterByIdCategory($idCategorys, Criteria::IN);
    }

    /**
     * Filter the query on the id_category column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCategory(1234); // WHERE id_category = 1234
     * $query->filterByIdCategory(array(12, 34), Criteria::IN); // WHERE id_category IN (12, 34)
     * $query->filterByIdCategory(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_category > 12
     * </code>
     *
     * @param     mixed $idCategory The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdCategory($idCategory = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idCategory)) {
            $useMinMax = false;
            if (isset($idCategory['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryTableMap::COL_ID_CATEGORY, $idCategory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCategory['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryTableMap::COL_ID_CATEGORY, $idCategory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idCategory of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCategoryTableMap::COL_ID_CATEGORY, $idCategory, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCategoryTemplate Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCategoryTemplate_Between(array $fkCategoryTemplate)
    {
        return $this->filterByFkCategoryTemplate($fkCategoryTemplate, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCategoryTemplates Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCategoryTemplate_In(array $fkCategoryTemplates)
    {
        return $this->filterByFkCategoryTemplate($fkCategoryTemplates, Criteria::IN);
    }

    /**
     * Filter the query on the fk_category_template column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCategoryTemplate(1234); // WHERE fk_category_template = 1234
     * $query->filterByFkCategoryTemplate(array(12, 34), Criteria::IN); // WHERE fk_category_template IN (12, 34)
     * $query->filterByFkCategoryTemplate(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_category_template > 12
     * </code>
     *
     * @see       filterByCategoryTemplate()
     *
     * @param     mixed $fkCategoryTemplate The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCategoryTemplate($fkCategoryTemplate = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCategoryTemplate)) {
            $useMinMax = false;
            if (isset($fkCategoryTemplate['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryTableMap::COL_FK_CATEGORY_TEMPLATE, $fkCategoryTemplate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCategoryTemplate['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyCategoryTableMap::COL_FK_CATEGORY_TEMPLATE, $fkCategoryTemplate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCategoryTemplate of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyCategoryTableMap::COL_FK_CATEGORY_TEMPLATE, $fkCategoryTemplate, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $categoryKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategoryKey_In(array $categoryKeys)
    {
        return $this->filterByCategoryKey($categoryKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $categoryKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategoryKey_Like($categoryKey)
    {
        return $this->filterByCategoryKey($categoryKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the category_key column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoryKey('fooValue');   // WHERE category_key = 'fooValue'
     * $query->filterByCategoryKey('%fooValue%', Criteria::LIKE); // WHERE category_key LIKE '%fooValue%'
     * $query->filterByCategoryKey([1, 'foo'], Criteria::IN); // WHERE category_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $categoryKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCategoryKey($categoryKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $categoryKey = str_replace('*', '%', $categoryKey);
        }

        if (is_array($categoryKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$categoryKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyCategoryTableMap::COL_CATEGORY_KEY, $categoryKey, $comparison);

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

        $query = $this->addUsingAlias(SpyCategoryTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_clickable column
     *
     * Example usage:
     * <code>
     * $query->filterByIsClickable(true); // WHERE is_clickable = true
     * $query->filterByIsClickable('yes'); // WHERE is_clickable = true
     * </code>
     *
     * @param     bool|string $isClickable The value to use as filter.
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
    public function filterByIsClickable($isClickable = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isClickable)) {
            $isClickable = in_array(strtolower($isClickable), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyCategoryTableMap::COL_IS_CLICKABLE, $isClickable, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_in_menu column
     *
     * Example usage:
     * <code>
     * $query->filterByIsInMenu(true); // WHERE is_in_menu = true
     * $query->filterByIsInMenu('yes'); // WHERE is_in_menu = true
     * </code>
     *
     * @param     bool|string $isInMenu The value to use as filter.
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
    public function filterByIsInMenu($isInMenu = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isInMenu)) {
            $isInMenu = in_array(strtolower($isInMenu), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyCategoryTableMap::COL_IS_IN_MENU, $isInMenu, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_searchable column
     *
     * Example usage:
     * <code>
     * $query->filterByIsSearchable(true); // WHERE is_searchable = true
     * $query->filterByIsSearchable('yes'); // WHERE is_searchable = true
     * </code>
     *
     * @param     bool|string $isSearchable The value to use as filter.
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
    public function filterByIsSearchable($isSearchable = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isSearchable)) {
            $isSearchable = in_array(strtolower($isSearchable), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyCategoryTableMap::COL_IS_SEARCHABLE, $isSearchable, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Category\Persistence\SpyCategoryTemplate object
     *
     * @param \Orm\Zed\Category\Persistence\SpyCategoryTemplate|ObjectCollection $spyCategoryTemplate The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCategoryTemplate($spyCategoryTemplate, ?string $comparison = null)
    {
        if ($spyCategoryTemplate instanceof \Orm\Zed\Category\Persistence\SpyCategoryTemplate) {
            return $this
                ->addUsingAlias(SpyCategoryTableMap::COL_FK_CATEGORY_TEMPLATE, $spyCategoryTemplate->getIdCategoryTemplate(), $comparison);
        } elseif ($spyCategoryTemplate instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyCategoryTableMap::COL_FK_CATEGORY_TEMPLATE, $spyCategoryTemplate->toKeyValue('PrimaryKey', 'IdCategoryTemplate'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCategoryTemplate() only accepts arguments of type \Orm\Zed\Category\Persistence\SpyCategoryTemplate or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CategoryTemplate relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCategoryTemplate(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CategoryTemplate');

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
            $this->addJoinObject($join, 'CategoryTemplate');
        }

        return $this;
    }

    /**
     * Use the CategoryTemplate relation SpyCategoryTemplate object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryTemplateQuery A secondary query class using the current class as primary query
     */
    public function useCategoryTemplateQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategoryTemplate($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CategoryTemplate', '\Orm\Zed\Category\Persistence\SpyCategoryTemplateQuery');
    }

    /**
     * Use the CategoryTemplate relation SpyCategoryTemplate object
     *
     * @param callable(\Orm\Zed\Category\Persistence\SpyCategoryTemplateQuery):\Orm\Zed\Category\Persistence\SpyCategoryTemplateQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCategoryTemplateQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCategoryTemplateQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CategoryTemplate relation to the SpyCategoryTemplate table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryTemplateQuery The inner query object of the EXISTS statement
     */
    public function useCategoryTemplateExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryTemplateQuery */
        $q = $this->useExistsQuery('CategoryTemplate', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CategoryTemplate relation to the SpyCategoryTemplate table for a NOT EXISTS query.
     *
     * @see useCategoryTemplateExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryTemplateQuery The inner query object of the NOT EXISTS statement
     */
    public function useCategoryTemplateNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryTemplateQuery */
        $q = $this->useExistsQuery('CategoryTemplate', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CategoryTemplate relation to the SpyCategoryTemplate table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryTemplateQuery The inner query object of the IN statement
     */
    public function useInCategoryTemplateQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryTemplateQuery */
        $q = $this->useInQuery('CategoryTemplate', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CategoryTemplate relation to the SpyCategoryTemplate table for a NOT IN query.
     *
     * @see useCategoryTemplateInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryTemplateQuery The inner query object of the NOT IN statement
     */
    public function useNotInCategoryTemplateQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryTemplateQuery */
        $q = $this->useInQuery('CategoryTemplate', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Category\Persistence\SpyCategoryAttribute object
     *
     * @param \Orm\Zed\Category\Persistence\SpyCategoryAttribute|ObjectCollection $spyCategoryAttribute the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAttribute($spyCategoryAttribute, ?string $comparison = null)
    {
        if ($spyCategoryAttribute instanceof \Orm\Zed\Category\Persistence\SpyCategoryAttribute) {
            $this
                ->addUsingAlias(SpyCategoryTableMap::COL_ID_CATEGORY, $spyCategoryAttribute->getFkCategory(), $comparison);

            return $this;
        } elseif ($spyCategoryAttribute instanceof ObjectCollection) {
            $this
                ->useAttributeQuery()
                ->filterByPrimaryKeys($spyCategoryAttribute->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByAttribute() only accepts arguments of type \Orm\Zed\Category\Persistence\SpyCategoryAttribute or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Attribute relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinAttribute(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Attribute');

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
            $this->addJoinObject($join, 'Attribute');
        }

        return $this;
    }

    /**
     * Use the Attribute relation SpyCategoryAttribute object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery A secondary query class using the current class as primary query
     */
    public function useAttributeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAttribute($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Attribute', '\Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery');
    }

    /**
     * Use the Attribute relation SpyCategoryAttribute object
     *
     * @param callable(\Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery):\Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withAttributeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useAttributeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Attribute relation to the SpyCategoryAttribute table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery The inner query object of the EXISTS statement
     */
    public function useAttributeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery */
        $q = $this->useExistsQuery('Attribute', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Attribute relation to the SpyCategoryAttribute table for a NOT EXISTS query.
     *
     * @see useAttributeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery The inner query object of the NOT EXISTS statement
     */
    public function useAttributeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery */
        $q = $this->useExistsQuery('Attribute', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Attribute relation to the SpyCategoryAttribute table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery The inner query object of the IN statement
     */
    public function useInAttributeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery */
        $q = $this->useInQuery('Attribute', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Attribute relation to the SpyCategoryAttribute table for a NOT IN query.
     *
     * @see useAttributeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery The inner query object of the NOT IN statement
     */
    public function useNotInAttributeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery */
        $q = $this->useInQuery('Attribute', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Category\Persistence\SpyCategoryNode object
     *
     * @param \Orm\Zed\Category\Persistence\SpyCategoryNode|ObjectCollection $spyCategoryNode the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByNode($spyCategoryNode, ?string $comparison = null)
    {
        if ($spyCategoryNode instanceof \Orm\Zed\Category\Persistence\SpyCategoryNode) {
            $this
                ->addUsingAlias(SpyCategoryTableMap::COL_ID_CATEGORY, $spyCategoryNode->getFkCategory(), $comparison);

            return $this;
        } elseif ($spyCategoryNode instanceof ObjectCollection) {
            $this
                ->useNodeQuery()
                ->filterByPrimaryKeys($spyCategoryNode->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByNode() only accepts arguments of type \Orm\Zed\Category\Persistence\SpyCategoryNode or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Node relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinNode(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Node');

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
            $this->addJoinObject($join, 'Node');
        }

        return $this;
    }

    /**
     * Use the Node relation SpyCategoryNode object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery A secondary query class using the current class as primary query
     */
    public function useNodeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinNode($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Node', '\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery');
    }

    /**
     * Use the Node relation SpyCategoryNode object
     *
     * @param callable(\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery):\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withNodeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useNodeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Node relation to the SpyCategoryNode table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the EXISTS statement
     */
    public function useNodeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useExistsQuery('Node', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Node relation to the SpyCategoryNode table for a NOT EXISTS query.
     *
     * @see useNodeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the NOT EXISTS statement
     */
    public function useNodeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useExistsQuery('Node', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Node relation to the SpyCategoryNode table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the IN statement
     */
    public function useInNodeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useInQuery('Node', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Node relation to the SpyCategoryNode table for a NOT IN query.
     *
     * @see useNodeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the NOT IN statement
     */
    public function useNotInNodeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useInQuery('Node', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Category\Persistence\SpyCategoryStore object
     *
     * @param \Orm\Zed\Category\Persistence\SpyCategoryStore|ObjectCollection $spyCategoryStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCategoryStore($spyCategoryStore, ?string $comparison = null)
    {
        if ($spyCategoryStore instanceof \Orm\Zed\Category\Persistence\SpyCategoryStore) {
            $this
                ->addUsingAlias(SpyCategoryTableMap::COL_ID_CATEGORY, $spyCategoryStore->getFkCategory(), $comparison);

            return $this;
        } elseif ($spyCategoryStore instanceof ObjectCollection) {
            $this
                ->useSpyCategoryStoreQuery()
                ->filterByPrimaryKeys($spyCategoryStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCategoryStore() only accepts arguments of type \Orm\Zed\Category\Persistence\SpyCategoryStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCategoryStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCategoryStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCategoryStore');

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
            $this->addJoinObject($join, 'SpyCategoryStore');
        }

        return $this;
    }

    /**
     * Use the SpyCategoryStore relation SpyCategoryStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyCategoryStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCategoryStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCategoryStore', '\Orm\Zed\Category\Persistence\SpyCategoryStoreQuery');
    }

    /**
     * Use the SpyCategoryStore relation SpyCategoryStore object
     *
     * @param callable(\Orm\Zed\Category\Persistence\SpyCategoryStoreQuery):\Orm\Zed\Category\Persistence\SpyCategoryStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCategoryStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCategoryStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCategoryStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyCategoryStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery */
        $q = $this->useExistsQuery('SpyCategoryStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCategoryStore table for a NOT EXISTS query.
     *
     * @see useSpyCategoryStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCategoryStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery */
        $q = $this->useExistsQuery('SpyCategoryStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCategoryStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery The inner query object of the IN statement
     */
    public function useInSpyCategoryStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery */
        $q = $this->useInQuery('SpyCategoryStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCategoryStore table for a NOT IN query.
     *
     * @see useSpyCategoryStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCategoryStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryStoreQuery */
        $q = $this->useInQuery('SpyCategoryStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet object
     *
     * @param \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet|ObjectCollection $spyCategoryImageSet the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCategoryImageSet($spyCategoryImageSet, ?string $comparison = null)
    {
        if ($spyCategoryImageSet instanceof \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSet) {
            $this
                ->addUsingAlias(SpyCategoryTableMap::COL_ID_CATEGORY, $spyCategoryImageSet->getFkCategory(), $comparison);

            return $this;
        } elseif ($spyCategoryImageSet instanceof ObjectCollection) {
            $this
                ->useSpyCategoryImageSetQuery()
                ->filterByPrimaryKeys($spyCategoryImageSet->getPrimaryKeys())
                ->endUse();

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
    public function joinSpyCategoryImageSet(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useSpyCategoryImageSetQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector object
     *
     * @param \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector|ObjectCollection $spyCmsBlockCategoryConnector the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCmsBlockCategoryConnector($spyCmsBlockCategoryConnector, ?string $comparison = null)
    {
        if ($spyCmsBlockCategoryConnector instanceof \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector) {
            $this
                ->addUsingAlias(SpyCategoryTableMap::COL_ID_CATEGORY, $spyCmsBlockCategoryConnector->getFkCategory(), $comparison);

            return $this;
        } elseif ($spyCmsBlockCategoryConnector instanceof ObjectCollection) {
            $this
                ->useSpyCmsBlockCategoryConnectorQuery()
                ->filterByPrimaryKeys($spyCmsBlockCategoryConnector->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCmsBlockCategoryConnector() only accepts arguments of type \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCmsBlockCategoryConnector relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCmsBlockCategoryConnector(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCmsBlockCategoryConnector');

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
            $this->addJoinObject($join, 'SpyCmsBlockCategoryConnector');
        }

        return $this;
    }

    /**
     * Use the SpyCmsBlockCategoryConnector relation SpyCmsBlockCategoryConnector object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery A secondary query class using the current class as primary query
     */
    public function useSpyCmsBlockCategoryConnectorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCmsBlockCategoryConnector($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCmsBlockCategoryConnector', '\Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery');
    }

    /**
     * Use the SpyCmsBlockCategoryConnector relation SpyCmsBlockCategoryConnector object
     *
     * @param callable(\Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery):\Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCmsBlockCategoryConnectorQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCmsBlockCategoryConnectorQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCmsBlockCategoryConnector table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery The inner query object of the EXISTS statement
     */
    public function useSpyCmsBlockCategoryConnectorExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery */
        $q = $this->useExistsQuery('SpyCmsBlockCategoryConnector', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockCategoryConnector table for a NOT EXISTS query.
     *
     * @see useSpyCmsBlockCategoryConnectorExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCmsBlockCategoryConnectorNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery */
        $q = $this->useExistsQuery('SpyCmsBlockCategoryConnector', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockCategoryConnector table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery The inner query object of the IN statement
     */
    public function useInSpyCmsBlockCategoryConnectorQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery */
        $q = $this->useInQuery('SpyCmsBlockCategoryConnector', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCmsBlockCategoryConnector table for a NOT IN query.
     *
     * @see useSpyCmsBlockCategoryConnectorInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCmsBlockCategoryConnectorQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery */
        $q = $this->useInQuery('SpyCmsBlockCategoryConnector', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory object
     *
     * @param \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory|ObjectCollection $spyMerchantCategory the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyMerchantCategory($spyMerchantCategory, ?string $comparison = null)
    {
        if ($spyMerchantCategory instanceof \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory) {
            $this
                ->addUsingAlias(SpyCategoryTableMap::COL_ID_CATEGORY, $spyMerchantCategory->getFkCategory(), $comparison);

            return $this;
        } elseif ($spyMerchantCategory instanceof ObjectCollection) {
            $this
                ->useSpyMerchantCategoryQuery()
                ->filterByPrimaryKeys($spyMerchantCategory->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyMerchantCategory() only accepts arguments of type \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyMerchantCategory relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyMerchantCategory(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyMerchantCategory');

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
            $this->addJoinObject($join, 'SpyMerchantCategory');
        }

        return $this;
    }

    /**
     * Use the SpyMerchantCategory relation SpyMerchantCategory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery A secondary query class using the current class as primary query
     */
    public function useSpyMerchantCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyMerchantCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyMerchantCategory', '\Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery');
    }

    /**
     * Use the SpyMerchantCategory relation SpyMerchantCategory object
     *
     * @param callable(\Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery):\Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyMerchantCategoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyMerchantCategoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyMerchantCategory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery The inner query object of the EXISTS statement
     */
    public function useSpyMerchantCategoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery */
        $q = $this->useExistsQuery('SpyMerchantCategory', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantCategory table for a NOT EXISTS query.
     *
     * @see useSpyMerchantCategoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyMerchantCategoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery */
        $q = $this->useExistsQuery('SpyMerchantCategory', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyMerchantCategory table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery The inner query object of the IN statement
     */
    public function useInSpyMerchantCategoryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery */
        $q = $this->useInQuery('SpyMerchantCategory', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyMerchantCategory table for a NOT IN query.
     *
     * @see useSpyMerchantCategoryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyMerchantCategoryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCategory\Persistence\SpyMerchantCategoryQuery */
        $q = $this->useInQuery('SpyMerchantCategory', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductCategory\Persistence\SpyProductCategory object
     *
     * @param \Orm\Zed\ProductCategory\Persistence\SpyProductCategory|ObjectCollection $spyProductCategory the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductCategory($spyProductCategory, ?string $comparison = null)
    {
        if ($spyProductCategory instanceof \Orm\Zed\ProductCategory\Persistence\SpyProductCategory) {
            $this
                ->addUsingAlias(SpyCategoryTableMap::COL_ID_CATEGORY, $spyProductCategory->getFkCategory(), $comparison);

            return $this;
        } elseif ($spyProductCategory instanceof ObjectCollection) {
            $this
                ->useSpyProductCategoryQuery()
                ->filterByPrimaryKeys($spyProductCategory->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductCategory() only accepts arguments of type \Orm\Zed\ProductCategory\Persistence\SpyProductCategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductCategory relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductCategory(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductCategory');

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
            $this->addJoinObject($join, 'SpyProductCategory');
        }

        return $this;
    }

    /**
     * Use the SpyProductCategory relation SpyProductCategory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductCategory', '\Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery');
    }

    /**
     * Use the SpyProductCategory relation SpyProductCategory object
     *
     * @param callable(\Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery):\Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductCategoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductCategoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductCategory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductCategoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery */
        $q = $this->useExistsQuery('SpyProductCategory', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductCategory table for a NOT EXISTS query.
     *
     * @see useSpyProductCategoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductCategoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery */
        $q = $this->useExistsQuery('SpyProductCategory', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductCategory table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery The inner query object of the IN statement
     */
    public function useInSpyProductCategoryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery */
        $q = $this->useInQuery('SpyProductCategory', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductCategory table for a NOT IN query.
     *
     * @see useSpyProductCategoryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductCategoryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductCategory\Persistence\SpyProductCategoryQuery */
        $q = $this->useInQuery('SpyProductCategory', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilter object
     *
     * @param \Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilter|ObjectCollection $spyProductCategoryFilter the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductCategoryFilter($spyProductCategoryFilter, ?string $comparison = null)
    {
        if ($spyProductCategoryFilter instanceof \Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilter) {
            $this
                ->addUsingAlias(SpyCategoryTableMap::COL_ID_CATEGORY, $spyProductCategoryFilter->getFkCategory(), $comparison);

            return $this;
        } elseif ($spyProductCategoryFilter instanceof ObjectCollection) {
            $this
                ->useSpyProductCategoryFilterQuery()
                ->filterByPrimaryKeys($spyProductCategoryFilter->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductCategoryFilter() only accepts arguments of type \Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilter or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductCategoryFilter relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductCategoryFilter(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductCategoryFilter');

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
            $this->addJoinObject($join, 'SpyProductCategoryFilter');
        }

        return $this;
    }

    /**
     * Use the SpyProductCategoryFilter relation SpyProductCategoryFilter object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilterQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductCategoryFilterQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyProductCategoryFilter($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductCategoryFilter', '\Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilterQuery');
    }

    /**
     * Use the SpyProductCategoryFilter relation SpyProductCategoryFilter object
     *
     * @param callable(\Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilterQuery):\Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilterQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductCategoryFilterQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyProductCategoryFilterQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductCategoryFilter table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilterQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductCategoryFilterExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilterQuery */
        $q = $this->useExistsQuery('SpyProductCategoryFilter', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductCategoryFilter table for a NOT EXISTS query.
     *
     * @see useSpyProductCategoryFilterExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilterQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductCategoryFilterNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilterQuery */
        $q = $this->useExistsQuery('SpyProductCategoryFilter', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductCategoryFilter table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilterQuery The inner query object of the IN statement
     */
    public function useInSpyProductCategoryFilterQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilterQuery */
        $q = $this->useInQuery('SpyProductCategoryFilter', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductCategoryFilter table for a NOT IN query.
     *
     * @see useSpyProductCategoryFilterInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilterQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductCategoryFilterQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductCategoryFilter\Persistence\SpyProductCategoryFilterQuery */
        $q = $this->useInQuery('SpyProductCategoryFilter', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductList\Persistence\SpyProductListCategory object
     *
     * @param \Orm\Zed\ProductList\Persistence\SpyProductListCategory|ObjectCollection $spyProductListCategory the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductListCategory($spyProductListCategory, ?string $comparison = null)
    {
        if ($spyProductListCategory instanceof \Orm\Zed\ProductList\Persistence\SpyProductListCategory) {
            $this
                ->addUsingAlias(SpyCategoryTableMap::COL_ID_CATEGORY, $spyProductListCategory->getFkCategory(), $comparison);

            return $this;
        } elseif ($spyProductListCategory instanceof ObjectCollection) {
            $this
                ->useSpyProductListCategoryQuery()
                ->filterByPrimaryKeys($spyProductListCategory->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductListCategory() only accepts arguments of type \Orm\Zed\ProductList\Persistence\SpyProductListCategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductListCategory relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductListCategory(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductListCategory');

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
            $this->addJoinObject($join, 'SpyProductListCategory');
        }

        return $this;
    }

    /**
     * Use the SpyProductListCategory relation SpyProductListCategory object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductListCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductListCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductListCategory', '\Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery');
    }

    /**
     * Use the SpyProductListCategory relation SpyProductListCategory object
     *
     * @param callable(\Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery):\Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductListCategoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductListCategoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductListCategory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductListCategoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery */
        $q = $this->useExistsQuery('SpyProductListCategory', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductListCategory table for a NOT EXISTS query.
     *
     * @see useSpyProductListCategoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductListCategoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery */
        $q = $this->useExistsQuery('SpyProductListCategory', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductListCategory table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery The inner query object of the IN statement
     */
    public function useInSpyProductListCategoryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery */
        $q = $this->useInQuery('SpyProductListCategory', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductListCategory table for a NOT IN query.
     *
     * @see useSpyProductListCategoryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductListCategoryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductList\Persistence\SpyProductListCategoryQuery */
        $q = $this->useInQuery('SpyProductListCategory', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related SpyProductList object
     * using the spy_product_list_category table as cross reference
     *
     * @param SpyProductList $spyProductList the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL and Criteria::IN for queries
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductList($spyProductList, string $comparison = null)
    {
        $this
            ->useSpyProductListCategoryQuery()
            ->filterBySpyProductList($spyProductList, $comparison)
            ->endUse();

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyCategory $spyCategory Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyCategory = null)
    {
        if ($spyCategory) {
            $this->addUsingAlias(SpyCategoryTableMap::COL_ID_CATEGORY, $spyCategory->getIdCategory(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_category table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyCategoryTableMap::clearInstancePool();
            SpyCategoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyCategoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyCategoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyCategoryTableMap::clearRelatedInstancePool();

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
