<?php

namespace Orm\Zed\Url\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Category\Persistence\SpyCategoryNode;
use Orm\Zed\Cms\Persistence\SpyCmsPage;
use Orm\Zed\Locale\Persistence\SpyLocale;
use Orm\Zed\Merchant\Persistence\SpyMerchant;
use Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes;
use Orm\Zed\ProductSet\Persistence\SpyProductSet;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\Url\Persistence\SpyUrl as ChildSpyUrl;
use Orm\Zed\Url\Persistence\SpyUrlQuery as ChildSpyUrlQuery;
use Orm\Zed\Url\Persistence\Map\SpyUrlTableMap;
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
 * Base class that represents a query for the `spy_url` table.
 *
 * @method     ChildSpyUrlQuery orderByIdUrl($order = Criteria::ASC) Order by the id_url column
 * @method     ChildSpyUrlQuery orderByFkLocale($order = Criteria::ASC) Order by the fk_locale column
 * @method     ChildSpyUrlQuery orderByFkResourceCategorynode($order = Criteria::ASC) Order by the fk_resource_categorynode column
 * @method     ChildSpyUrlQuery orderByFkResourceMerchant($order = Criteria::ASC) Order by the fk_resource_merchant column
 * @method     ChildSpyUrlQuery orderByFkResourcePage($order = Criteria::ASC) Order by the fk_resource_page column
 * @method     ChildSpyUrlQuery orderByFkResourceProductAbstract($order = Criteria::ASC) Order by the fk_resource_product_abstract column
 * @method     ChildSpyUrlQuery orderByFkResourceProductSet($order = Criteria::ASC) Order by the fk_resource_product_set column
 * @method     ChildSpyUrlQuery orderByFkResourceRedirect($order = Criteria::ASC) Order by the fk_resource_redirect column
 * @method     ChildSpyUrlQuery orderByUrl($order = Criteria::ASC) Order by the url column
 *
 * @method     ChildSpyUrlQuery groupByIdUrl() Group by the id_url column
 * @method     ChildSpyUrlQuery groupByFkLocale() Group by the fk_locale column
 * @method     ChildSpyUrlQuery groupByFkResourceCategorynode() Group by the fk_resource_categorynode column
 * @method     ChildSpyUrlQuery groupByFkResourceMerchant() Group by the fk_resource_merchant column
 * @method     ChildSpyUrlQuery groupByFkResourcePage() Group by the fk_resource_page column
 * @method     ChildSpyUrlQuery groupByFkResourceProductAbstract() Group by the fk_resource_product_abstract column
 * @method     ChildSpyUrlQuery groupByFkResourceProductSet() Group by the fk_resource_product_set column
 * @method     ChildSpyUrlQuery groupByFkResourceRedirect() Group by the fk_resource_redirect column
 * @method     ChildSpyUrlQuery groupByUrl() Group by the url column
 *
 * @method     ChildSpyUrlQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyUrlQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyUrlQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyUrlQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyUrlQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyUrlQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyUrlQuery leftJoinSpyCategoryNode($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCategoryNode relation
 * @method     ChildSpyUrlQuery rightJoinSpyCategoryNode($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCategoryNode relation
 * @method     ChildSpyUrlQuery innerJoinSpyCategoryNode($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCategoryNode relation
 *
 * @method     ChildSpyUrlQuery joinWithSpyCategoryNode($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCategoryNode relation
 *
 * @method     ChildSpyUrlQuery leftJoinWithSpyCategoryNode() Adds a LEFT JOIN clause and with to the query using the SpyCategoryNode relation
 * @method     ChildSpyUrlQuery rightJoinWithSpyCategoryNode() Adds a RIGHT JOIN clause and with to the query using the SpyCategoryNode relation
 * @method     ChildSpyUrlQuery innerJoinWithSpyCategoryNode() Adds a INNER JOIN clause and with to the query using the SpyCategoryNode relation
 *
 * @method     ChildSpyUrlQuery leftJoinCmsPage($relationAlias = null) Adds a LEFT JOIN clause to the query using the CmsPage relation
 * @method     ChildSpyUrlQuery rightJoinCmsPage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CmsPage relation
 * @method     ChildSpyUrlQuery innerJoinCmsPage($relationAlias = null) Adds a INNER JOIN clause to the query using the CmsPage relation
 *
 * @method     ChildSpyUrlQuery joinWithCmsPage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the CmsPage relation
 *
 * @method     ChildSpyUrlQuery leftJoinWithCmsPage() Adds a LEFT JOIN clause and with to the query using the CmsPage relation
 * @method     ChildSpyUrlQuery rightJoinWithCmsPage() Adds a RIGHT JOIN clause and with to the query using the CmsPage relation
 * @method     ChildSpyUrlQuery innerJoinWithCmsPage() Adds a INNER JOIN clause and with to the query using the CmsPage relation
 *
 * @method     ChildSpyUrlQuery leftJoinSpyMerchant($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyMerchant relation
 * @method     ChildSpyUrlQuery rightJoinSpyMerchant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyMerchant relation
 * @method     ChildSpyUrlQuery innerJoinSpyMerchant($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyMerchant relation
 *
 * @method     ChildSpyUrlQuery joinWithSpyMerchant($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyMerchant relation
 *
 * @method     ChildSpyUrlQuery leftJoinWithSpyMerchant() Adds a LEFT JOIN clause and with to the query using the SpyMerchant relation
 * @method     ChildSpyUrlQuery rightJoinWithSpyMerchant() Adds a RIGHT JOIN clause and with to the query using the SpyMerchant relation
 * @method     ChildSpyUrlQuery innerJoinWithSpyMerchant() Adds a INNER JOIN clause and with to the query using the SpyMerchant relation
 *
 * @method     ChildSpyUrlQuery leftJoinSpyProductSet($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductSet relation
 * @method     ChildSpyUrlQuery rightJoinSpyProductSet($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductSet relation
 * @method     ChildSpyUrlQuery innerJoinSpyProductSet($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductSet relation
 *
 * @method     ChildSpyUrlQuery joinWithSpyProductSet($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductSet relation
 *
 * @method     ChildSpyUrlQuery leftJoinWithSpyProductSet() Adds a LEFT JOIN clause and with to the query using the SpyProductSet relation
 * @method     ChildSpyUrlQuery rightJoinWithSpyProductSet() Adds a RIGHT JOIN clause and with to the query using the SpyProductSet relation
 * @method     ChildSpyUrlQuery innerJoinWithSpyProductSet() Adds a INNER JOIN clause and with to the query using the SpyProductSet relation
 *
 * @method     ChildSpyUrlQuery leftJoinSpyProduct($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProduct relation
 * @method     ChildSpyUrlQuery rightJoinSpyProduct($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProduct relation
 * @method     ChildSpyUrlQuery innerJoinSpyProduct($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProduct relation
 *
 * @method     ChildSpyUrlQuery joinWithSpyProduct($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProduct relation
 *
 * @method     ChildSpyUrlQuery leftJoinWithSpyProduct() Adds a LEFT JOIN clause and with to the query using the SpyProduct relation
 * @method     ChildSpyUrlQuery rightJoinWithSpyProduct() Adds a RIGHT JOIN clause and with to the query using the SpyProduct relation
 * @method     ChildSpyUrlQuery innerJoinWithSpyProduct() Adds a INNER JOIN clause and with to the query using the SpyProduct relation
 *
 * @method     ChildSpyUrlQuery leftJoinSpyLocale($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyLocale relation
 * @method     ChildSpyUrlQuery rightJoinSpyLocale($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyLocale relation
 * @method     ChildSpyUrlQuery innerJoinSpyLocale($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyLocale relation
 *
 * @method     ChildSpyUrlQuery joinWithSpyLocale($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyLocale relation
 *
 * @method     ChildSpyUrlQuery leftJoinWithSpyLocale() Adds a LEFT JOIN clause and with to the query using the SpyLocale relation
 * @method     ChildSpyUrlQuery rightJoinWithSpyLocale() Adds a RIGHT JOIN clause and with to the query using the SpyLocale relation
 * @method     ChildSpyUrlQuery innerJoinWithSpyLocale() Adds a INNER JOIN clause and with to the query using the SpyLocale relation
 *
 * @method     ChildSpyUrlQuery leftJoinSpyUrlRedirect($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyUrlRedirect relation
 * @method     ChildSpyUrlQuery rightJoinSpyUrlRedirect($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyUrlRedirect relation
 * @method     ChildSpyUrlQuery innerJoinSpyUrlRedirect($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyUrlRedirect relation
 *
 * @method     ChildSpyUrlQuery joinWithSpyUrlRedirect($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyUrlRedirect relation
 *
 * @method     ChildSpyUrlQuery leftJoinWithSpyUrlRedirect() Adds a LEFT JOIN clause and with to the query using the SpyUrlRedirect relation
 * @method     ChildSpyUrlQuery rightJoinWithSpyUrlRedirect() Adds a RIGHT JOIN clause and with to the query using the SpyUrlRedirect relation
 * @method     ChildSpyUrlQuery innerJoinWithSpyUrlRedirect() Adds a INNER JOIN clause and with to the query using the SpyUrlRedirect relation
 *
 * @method     ChildSpyUrlQuery leftJoinSpyNavigationNodeLocalizedAttributes($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyNavigationNodeLocalizedAttributes relation
 * @method     ChildSpyUrlQuery rightJoinSpyNavigationNodeLocalizedAttributes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyNavigationNodeLocalizedAttributes relation
 * @method     ChildSpyUrlQuery innerJoinSpyNavigationNodeLocalizedAttributes($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyNavigationNodeLocalizedAttributes relation
 *
 * @method     ChildSpyUrlQuery joinWithSpyNavigationNodeLocalizedAttributes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyNavigationNodeLocalizedAttributes relation
 *
 * @method     ChildSpyUrlQuery leftJoinWithSpyNavigationNodeLocalizedAttributes() Adds a LEFT JOIN clause and with to the query using the SpyNavigationNodeLocalizedAttributes relation
 * @method     ChildSpyUrlQuery rightJoinWithSpyNavigationNodeLocalizedAttributes() Adds a RIGHT JOIN clause and with to the query using the SpyNavigationNodeLocalizedAttributes relation
 * @method     ChildSpyUrlQuery innerJoinWithSpyNavigationNodeLocalizedAttributes() Adds a INNER JOIN clause and with to the query using the SpyNavigationNodeLocalizedAttributes relation
 *
 * @method     \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery|\Orm\Zed\Cms\Persistence\SpyCmsPageQuery|\Orm\Zed\Merchant\Persistence\SpyMerchantQuery|\Orm\Zed\ProductSet\Persistence\SpyProductSetQuery|\Orm\Zed\Product\Persistence\SpyProductAbstractQuery|\Orm\Zed\Locale\Persistence\SpyLocaleQuery|\Orm\Zed\Url\Persistence\SpyUrlRedirectQuery|\Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyUrl|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyUrl matching the query
 * @method     ChildSpyUrl findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyUrl matching the query, or a new ChildSpyUrl object populated from the query conditions when no match is found
 *
 * @method     ChildSpyUrl|null findOneByIdUrl(int $id_url) Return the first ChildSpyUrl filtered by the id_url column
 * @method     ChildSpyUrl|null findOneByFkLocale(int $fk_locale) Return the first ChildSpyUrl filtered by the fk_locale column
 * @method     ChildSpyUrl|null findOneByFkResourceCategorynode(int $fk_resource_categorynode) Return the first ChildSpyUrl filtered by the fk_resource_categorynode column
 * @method     ChildSpyUrl|null findOneByFkResourceMerchant(int $fk_resource_merchant) Return the first ChildSpyUrl filtered by the fk_resource_merchant column
 * @method     ChildSpyUrl|null findOneByFkResourcePage(int $fk_resource_page) Return the first ChildSpyUrl filtered by the fk_resource_page column
 * @method     ChildSpyUrl|null findOneByFkResourceProductAbstract(int $fk_resource_product_abstract) Return the first ChildSpyUrl filtered by the fk_resource_product_abstract column
 * @method     ChildSpyUrl|null findOneByFkResourceProductSet(int $fk_resource_product_set) Return the first ChildSpyUrl filtered by the fk_resource_product_set column
 * @method     ChildSpyUrl|null findOneByFkResourceRedirect(int $fk_resource_redirect) Return the first ChildSpyUrl filtered by the fk_resource_redirect column
 * @method     ChildSpyUrl|null findOneByUrl(string $url) Return the first ChildSpyUrl filtered by the url column
 *
 * @method     ChildSpyUrl requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyUrl by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUrl requireOne(?ConnectionInterface $con = null) Return the first ChildSpyUrl matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyUrl requireOneByIdUrl(int $id_url) Return the first ChildSpyUrl filtered by the id_url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUrl requireOneByFkLocale(int $fk_locale) Return the first ChildSpyUrl filtered by the fk_locale column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUrl requireOneByFkResourceCategorynode(int $fk_resource_categorynode) Return the first ChildSpyUrl filtered by the fk_resource_categorynode column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUrl requireOneByFkResourceMerchant(int $fk_resource_merchant) Return the first ChildSpyUrl filtered by the fk_resource_merchant column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUrl requireOneByFkResourcePage(int $fk_resource_page) Return the first ChildSpyUrl filtered by the fk_resource_page column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUrl requireOneByFkResourceProductAbstract(int $fk_resource_product_abstract) Return the first ChildSpyUrl filtered by the fk_resource_product_abstract column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUrl requireOneByFkResourceProductSet(int $fk_resource_product_set) Return the first ChildSpyUrl filtered by the fk_resource_product_set column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUrl requireOneByFkResourceRedirect(int $fk_resource_redirect) Return the first ChildSpyUrl filtered by the fk_resource_redirect column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyUrl requireOneByUrl(string $url) Return the first ChildSpyUrl filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyUrl[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyUrl objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyUrl> find(?ConnectionInterface $con = null) Return ChildSpyUrl objects based on current ModelCriteria
 *
 * @method     ChildSpyUrl[]|Collection findByIdUrl(int|array<int> $id_url) Return ChildSpyUrl objects filtered by the id_url column
 * @psalm-method Collection&\Traversable<ChildSpyUrl> findByIdUrl(int|array<int> $id_url) Return ChildSpyUrl objects filtered by the id_url column
 * @method     ChildSpyUrl[]|Collection findByFkLocale(int|array<int> $fk_locale) Return ChildSpyUrl objects filtered by the fk_locale column
 * @psalm-method Collection&\Traversable<ChildSpyUrl> findByFkLocale(int|array<int> $fk_locale) Return ChildSpyUrl objects filtered by the fk_locale column
 * @method     ChildSpyUrl[]|Collection findByFkResourceCategorynode(int|array<int> $fk_resource_categorynode) Return ChildSpyUrl objects filtered by the fk_resource_categorynode column
 * @psalm-method Collection&\Traversable<ChildSpyUrl> findByFkResourceCategorynode(int|array<int> $fk_resource_categorynode) Return ChildSpyUrl objects filtered by the fk_resource_categorynode column
 * @method     ChildSpyUrl[]|Collection findByFkResourceMerchant(int|array<int> $fk_resource_merchant) Return ChildSpyUrl objects filtered by the fk_resource_merchant column
 * @psalm-method Collection&\Traversable<ChildSpyUrl> findByFkResourceMerchant(int|array<int> $fk_resource_merchant) Return ChildSpyUrl objects filtered by the fk_resource_merchant column
 * @method     ChildSpyUrl[]|Collection findByFkResourcePage(int|array<int> $fk_resource_page) Return ChildSpyUrl objects filtered by the fk_resource_page column
 * @psalm-method Collection&\Traversable<ChildSpyUrl> findByFkResourcePage(int|array<int> $fk_resource_page) Return ChildSpyUrl objects filtered by the fk_resource_page column
 * @method     ChildSpyUrl[]|Collection findByFkResourceProductAbstract(int|array<int> $fk_resource_product_abstract) Return ChildSpyUrl objects filtered by the fk_resource_product_abstract column
 * @psalm-method Collection&\Traversable<ChildSpyUrl> findByFkResourceProductAbstract(int|array<int> $fk_resource_product_abstract) Return ChildSpyUrl objects filtered by the fk_resource_product_abstract column
 * @method     ChildSpyUrl[]|Collection findByFkResourceProductSet(int|array<int> $fk_resource_product_set) Return ChildSpyUrl objects filtered by the fk_resource_product_set column
 * @psalm-method Collection&\Traversable<ChildSpyUrl> findByFkResourceProductSet(int|array<int> $fk_resource_product_set) Return ChildSpyUrl objects filtered by the fk_resource_product_set column
 * @method     ChildSpyUrl[]|Collection findByFkResourceRedirect(int|array<int> $fk_resource_redirect) Return ChildSpyUrl objects filtered by the fk_resource_redirect column
 * @psalm-method Collection&\Traversable<ChildSpyUrl> findByFkResourceRedirect(int|array<int> $fk_resource_redirect) Return ChildSpyUrl objects filtered by the fk_resource_redirect column
 * @method     ChildSpyUrl[]|Collection findByUrl(string|array<string> $url) Return ChildSpyUrl objects filtered by the url column
 * @psalm-method Collection&\Traversable<ChildSpyUrl> findByUrl(string|array<string> $url) Return ChildSpyUrl objects filtered by the url column
 *
 * @method     ChildSpyUrl[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyUrl> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyUrlQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Url\Persistence\Base\SpyUrlQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Url\\Persistence\\SpyUrl', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyUrlQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyUrlQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyUrlQuery) {
            return $criteria;
        }
        $query = new ChildSpyUrlQuery();
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
     * @return ChildSpyUrl|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyUrlTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyUrl A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_url, fk_locale, fk_resource_categorynode, fk_resource_merchant, fk_resource_page, fk_resource_product_abstract, fk_resource_product_set, fk_resource_redirect, url FROM spy_url WHERE id_url = :p0';
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
            /** @var ChildSpyUrl $obj */
            $obj = new ChildSpyUrl();
            $obj->hydrate($row);
            SpyUrlTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyUrl|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyUrlTableMap::COL_ID_URL, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyUrlTableMap::COL_ID_URL, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idUrl Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdUrl_Between(array $idUrl)
    {
        return $this->filterByIdUrl($idUrl, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idUrls Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdUrl_In(array $idUrls)
    {
        return $this->filterByIdUrl($idUrls, Criteria::IN);
    }

    /**
     * Filter the query on the id_url column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUrl(1234); // WHERE id_url = 1234
     * $query->filterByIdUrl(array(12, 34), Criteria::IN); // WHERE id_url IN (12, 34)
     * $query->filterByIdUrl(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_url > 12
     * </code>
     *
     * @param     mixed $idUrl The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdUrl($idUrl = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idUrl)) {
            $useMinMax = false;
            if (isset($idUrl['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUrlTableMap::COL_ID_URL, $idUrl['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUrl['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUrlTableMap::COL_ID_URL, $idUrl['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idUrl of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyUrlTableMap::COL_ID_URL, $idUrl, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkLocale Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkLocale_Between(array $fkLocale)
    {
        return $this->filterByFkLocale($fkLocale, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkLocales Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkLocale_In(array $fkLocales)
    {
        return $this->filterByFkLocale($fkLocales, Criteria::IN);
    }

    /**
     * Filter the query on the fk_locale column
     *
     * Example usage:
     * <code>
     * $query->filterByFkLocale(1234); // WHERE fk_locale = 1234
     * $query->filterByFkLocale(array(12, 34), Criteria::IN); // WHERE fk_locale IN (12, 34)
     * $query->filterByFkLocale(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_locale > 12
     * </code>
     *
     * @see       filterBySpyLocale()
     *
     * @param     mixed $fkLocale The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkLocale($fkLocale = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkLocale)) {
            $useMinMax = false;
            if (isset($fkLocale['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUrlTableMap::COL_FK_LOCALE, $fkLocale['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkLocale['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUrlTableMap::COL_FK_LOCALE, $fkLocale['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkLocale of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyUrlTableMap::COL_FK_LOCALE, $fkLocale, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkResourceCategorynode Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkResourceCategorynode_Between(array $fkResourceCategorynode)
    {
        return $this->filterByFkResourceCategorynode($fkResourceCategorynode, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkResourceCategorynodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkResourceCategorynode_In(array $fkResourceCategorynodes)
    {
        return $this->filterByFkResourceCategorynode($fkResourceCategorynodes, Criteria::IN);
    }

    /**
     * Filter the query on the fk_resource_categorynode column
     *
     * Example usage:
     * <code>
     * $query->filterByFkResourceCategorynode(1234); // WHERE fk_resource_categorynode = 1234
     * $query->filterByFkResourceCategorynode(array(12, 34), Criteria::IN); // WHERE fk_resource_categorynode IN (12, 34)
     * $query->filterByFkResourceCategorynode(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_resource_categorynode > 12
     * </code>
     *
     * @see       filterBySpyCategoryNode()
     *
     * @param     mixed $fkResourceCategorynode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkResourceCategorynode($fkResourceCategorynode = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkResourceCategorynode)) {
            $useMinMax = false;
            if (isset($fkResourceCategorynode['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_CATEGORYNODE, $fkResourceCategorynode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkResourceCategorynode['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_CATEGORYNODE, $fkResourceCategorynode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkResourceCategorynode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_CATEGORYNODE, $fkResourceCategorynode, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkResourceMerchant Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkResourceMerchant_Between(array $fkResourceMerchant)
    {
        return $this->filterByFkResourceMerchant($fkResourceMerchant, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkResourceMerchants Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkResourceMerchant_In(array $fkResourceMerchants)
    {
        return $this->filterByFkResourceMerchant($fkResourceMerchants, Criteria::IN);
    }

    /**
     * Filter the query on the fk_resource_merchant column
     *
     * Example usage:
     * <code>
     * $query->filterByFkResourceMerchant(1234); // WHERE fk_resource_merchant = 1234
     * $query->filterByFkResourceMerchant(array(12, 34), Criteria::IN); // WHERE fk_resource_merchant IN (12, 34)
     * $query->filterByFkResourceMerchant(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_resource_merchant > 12
     * </code>
     *
     * @see       filterBySpyMerchant()
     *
     * @param     mixed $fkResourceMerchant The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkResourceMerchant($fkResourceMerchant = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkResourceMerchant)) {
            $useMinMax = false;
            if (isset($fkResourceMerchant['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_MERCHANT, $fkResourceMerchant['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkResourceMerchant['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_MERCHANT, $fkResourceMerchant['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkResourceMerchant of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_MERCHANT, $fkResourceMerchant, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkResourcePage Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkResourcePage_Between(array $fkResourcePage)
    {
        return $this->filterByFkResourcePage($fkResourcePage, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkResourcePages Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkResourcePage_In(array $fkResourcePages)
    {
        return $this->filterByFkResourcePage($fkResourcePages, Criteria::IN);
    }

    /**
     * Filter the query on the fk_resource_page column
     *
     * Example usage:
     * <code>
     * $query->filterByFkResourcePage(1234); // WHERE fk_resource_page = 1234
     * $query->filterByFkResourcePage(array(12, 34), Criteria::IN); // WHERE fk_resource_page IN (12, 34)
     * $query->filterByFkResourcePage(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_resource_page > 12
     * </code>
     *
     * @see       filterByCmsPage()
     *
     * @param     mixed $fkResourcePage The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkResourcePage($fkResourcePage = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkResourcePage)) {
            $useMinMax = false;
            if (isset($fkResourcePage['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_PAGE, $fkResourcePage['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkResourcePage['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_PAGE, $fkResourcePage['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkResourcePage of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_PAGE, $fkResourcePage, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkResourceProductAbstract Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkResourceProductAbstract_Between(array $fkResourceProductAbstract)
    {
        return $this->filterByFkResourceProductAbstract($fkResourceProductAbstract, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkResourceProductAbstracts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkResourceProductAbstract_In(array $fkResourceProductAbstracts)
    {
        return $this->filterByFkResourceProductAbstract($fkResourceProductAbstracts, Criteria::IN);
    }

    /**
     * Filter the query on the fk_resource_product_abstract column
     *
     * Example usage:
     * <code>
     * $query->filterByFkResourceProductAbstract(1234); // WHERE fk_resource_product_abstract = 1234
     * $query->filterByFkResourceProductAbstract(array(12, 34), Criteria::IN); // WHERE fk_resource_product_abstract IN (12, 34)
     * $query->filterByFkResourceProductAbstract(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_resource_product_abstract > 12
     * </code>
     *
     * @see       filterBySpyProduct()
     *
     * @param     mixed $fkResourceProductAbstract The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkResourceProductAbstract($fkResourceProductAbstract = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkResourceProductAbstract)) {
            $useMinMax = false;
            if (isset($fkResourceProductAbstract['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_ABSTRACT, $fkResourceProductAbstract['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkResourceProductAbstract['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_ABSTRACT, $fkResourceProductAbstract['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkResourceProductAbstract of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_ABSTRACT, $fkResourceProductAbstract, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkResourceProductSet Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkResourceProductSet_Between(array $fkResourceProductSet)
    {
        return $this->filterByFkResourceProductSet($fkResourceProductSet, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkResourceProductSets Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkResourceProductSet_In(array $fkResourceProductSets)
    {
        return $this->filterByFkResourceProductSet($fkResourceProductSets, Criteria::IN);
    }

    /**
     * Filter the query on the fk_resource_product_set column
     *
     * Example usage:
     * <code>
     * $query->filterByFkResourceProductSet(1234); // WHERE fk_resource_product_set = 1234
     * $query->filterByFkResourceProductSet(array(12, 34), Criteria::IN); // WHERE fk_resource_product_set IN (12, 34)
     * $query->filterByFkResourceProductSet(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_resource_product_set > 12
     * </code>
     *
     * @see       filterBySpyProductSet()
     *
     * @param     mixed $fkResourceProductSet The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkResourceProductSet($fkResourceProductSet = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkResourceProductSet)) {
            $useMinMax = false;
            if (isset($fkResourceProductSet['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_SET, $fkResourceProductSet['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkResourceProductSet['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_SET, $fkResourceProductSet['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkResourceProductSet of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_SET, $fkResourceProductSet, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkResourceRedirect Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkResourceRedirect_Between(array $fkResourceRedirect)
    {
        return $this->filterByFkResourceRedirect($fkResourceRedirect, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkResourceRedirects Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkResourceRedirect_In(array $fkResourceRedirects)
    {
        return $this->filterByFkResourceRedirect($fkResourceRedirects, Criteria::IN);
    }

    /**
     * Filter the query on the fk_resource_redirect column
     *
     * Example usage:
     * <code>
     * $query->filterByFkResourceRedirect(1234); // WHERE fk_resource_redirect = 1234
     * $query->filterByFkResourceRedirect(array(12, 34), Criteria::IN); // WHERE fk_resource_redirect IN (12, 34)
     * $query->filterByFkResourceRedirect(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_resource_redirect > 12
     * </code>
     *
     * @see       filterBySpyUrlRedirect()
     *
     * @param     mixed $fkResourceRedirect The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkResourceRedirect($fkResourceRedirect = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkResourceRedirect)) {
            $useMinMax = false;
            if (isset($fkResourceRedirect['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_REDIRECT, $fkResourceRedirect['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkResourceRedirect['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_REDIRECT, $fkResourceRedirect['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkResourceRedirect of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_REDIRECT, $fkResourceRedirect, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $urls Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUrl_In(array $urls)
    {
        return $this->filterByUrl($urls, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $url Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUrl_Like($url)
    {
        return $this->filterByUrl($url, Criteria::LIKE);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%', Criteria::LIKE); // WHERE url LIKE '%fooValue%'
     * $query->filterByUrl([1, 'foo'], Criteria::IN); // WHERE url IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $url The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByUrl($url = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $url = str_replace('*', '%', $url);
        }

        if (is_array($url) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$url of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyUrlTableMap::COL_URL, $url, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Category\Persistence\SpyCategoryNode object
     *
     * @param \Orm\Zed\Category\Persistence\SpyCategoryNode|ObjectCollection $spyCategoryNode The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCategoryNode($spyCategoryNode, ?string $comparison = null)
    {
        if ($spyCategoryNode instanceof \Orm\Zed\Category\Persistence\SpyCategoryNode) {
            return $this
                ->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_CATEGORYNODE, $spyCategoryNode->getIdCategoryNode(), $comparison);
        } elseif ($spyCategoryNode instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_CATEGORYNODE, $spyCategoryNode->toKeyValue('PrimaryKey', 'IdCategoryNode'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyCategoryNode() only accepts arguments of type \Orm\Zed\Category\Persistence\SpyCategoryNode or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCategoryNode relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCategoryNode(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCategoryNode');

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
            $this->addJoinObject($join, 'SpyCategoryNode');
        }

        return $this;
    }

    /**
     * Use the SpyCategoryNode relation SpyCategoryNode object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery A secondary query class using the current class as primary query
     */
    public function useSpyCategoryNodeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyCategoryNode($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCategoryNode', '\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery');
    }

    /**
     * Use the SpyCategoryNode relation SpyCategoryNode object
     *
     * @param callable(\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery):\Orm\Zed\Category\Persistence\SpyCategoryNodeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCategoryNodeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyCategoryNodeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCategoryNode table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the EXISTS statement
     */
    public function useSpyCategoryNodeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useExistsQuery('SpyCategoryNode', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCategoryNode table for a NOT EXISTS query.
     *
     * @see useSpyCategoryNodeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCategoryNodeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useExistsQuery('SpyCategoryNode', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCategoryNode table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the IN statement
     */
    public function useInSpyCategoryNodeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useInQuery('SpyCategoryNode', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCategoryNode table for a NOT IN query.
     *
     * @see useSpyCategoryNodeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCategoryNodeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Category\Persistence\SpyCategoryNodeQuery */
        $q = $this->useInQuery('SpyCategoryNode', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Cms\Persistence\SpyCmsPage object
     *
     * @param \Orm\Zed\Cms\Persistence\SpyCmsPage|ObjectCollection $spyCmsPage The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCmsPage($spyCmsPage, ?string $comparison = null)
    {
        if ($spyCmsPage instanceof \Orm\Zed\Cms\Persistence\SpyCmsPage) {
            return $this
                ->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_PAGE, $spyCmsPage->getIdCmsPage(), $comparison);
        } elseif ($spyCmsPage instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_PAGE, $spyCmsPage->toKeyValue('PrimaryKey', 'IdCmsPage'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCmsPage() only accepts arguments of type \Orm\Zed\Cms\Persistence\SpyCmsPage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CmsPage relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCmsPage(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CmsPage');

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
            $this->addJoinObject($join, 'CmsPage');
        }

        return $this;
    }

    /**
     * Use the CmsPage relation SpyCmsPage object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Cms\Persistence\SpyCmsPageQuery A secondary query class using the current class as primary query
     */
    public function useCmsPageQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCmsPage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CmsPage', '\Orm\Zed\Cms\Persistence\SpyCmsPageQuery');
    }

    /**
     * Use the CmsPage relation SpyCmsPage object
     *
     * @param callable(\Orm\Zed\Cms\Persistence\SpyCmsPageQuery):\Orm\Zed\Cms\Persistence\SpyCmsPageQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCmsPageQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useCmsPageQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the CmsPage relation to the SpyCmsPage table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Cms\Persistence\SpyCmsPageQuery The inner query object of the EXISTS statement
     */
    public function useCmsPageExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Cms\Persistence\SpyCmsPageQuery */
        $q = $this->useExistsQuery('CmsPage', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the CmsPage relation to the SpyCmsPage table for a NOT EXISTS query.
     *
     * @see useCmsPageExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Cms\Persistence\SpyCmsPageQuery The inner query object of the NOT EXISTS statement
     */
    public function useCmsPageNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Cms\Persistence\SpyCmsPageQuery */
        $q = $this->useExistsQuery('CmsPage', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the CmsPage relation to the SpyCmsPage table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Cms\Persistence\SpyCmsPageQuery The inner query object of the IN statement
     */
    public function useInCmsPageQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Cms\Persistence\SpyCmsPageQuery */
        $q = $this->useInQuery('CmsPage', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the CmsPage relation to the SpyCmsPage table for a NOT IN query.
     *
     * @see useCmsPageInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Cms\Persistence\SpyCmsPageQuery The inner query object of the NOT IN statement
     */
    public function useNotInCmsPageQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Cms\Persistence\SpyCmsPageQuery */
        $q = $this->useInQuery('CmsPage', $modelAlias, $queryClass, 'NOT IN');
        return $q;
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
                ->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_MERCHANT, $spyMerchant->getIdMerchant(), $comparison);
        } elseif ($spyMerchant instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_MERCHANT, $spyMerchant->toKeyValue('PrimaryKey', 'IdMerchant'), $comparison);

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
    public function joinSpyMerchant(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
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
    public function useSpyMerchantQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \Orm\Zed\ProductSet\Persistence\SpyProductSet object
     *
     * @param \Orm\Zed\ProductSet\Persistence\SpyProductSet|ObjectCollection $spyProductSet The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductSet($spyProductSet, ?string $comparison = null)
    {
        if ($spyProductSet instanceof \Orm\Zed\ProductSet\Persistence\SpyProductSet) {
            return $this
                ->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_SET, $spyProductSet->getIdProductSet(), $comparison);
        } elseif ($spyProductSet instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_SET, $spyProductSet->toKeyValue('PrimaryKey', 'IdProductSet'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyProductSet() only accepts arguments of type \Orm\Zed\ProductSet\Persistence\SpyProductSet or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductSet relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductSet(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductSet');

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
            $this->addJoinObject($join, 'SpyProductSet');
        }

        return $this;
    }

    /**
     * Use the SpyProductSet relation SpyProductSet object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductSet\Persistence\SpyProductSetQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductSetQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyProductSet($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductSet', '\Orm\Zed\ProductSet\Persistence\SpyProductSetQuery');
    }

    /**
     * Use the SpyProductSet relation SpyProductSet object
     *
     * @param callable(\Orm\Zed\ProductSet\Persistence\SpyProductSetQuery):\Orm\Zed\ProductSet\Persistence\SpyProductSetQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductSetQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyProductSetQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductSet table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductSet\Persistence\SpyProductSetQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductSetExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductSet\Persistence\SpyProductSetQuery */
        $q = $this->useExistsQuery('SpyProductSet', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductSet table for a NOT EXISTS query.
     *
     * @see useSpyProductSetExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductSet\Persistence\SpyProductSetQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductSetNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductSet\Persistence\SpyProductSetQuery */
        $q = $this->useExistsQuery('SpyProductSet', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductSet table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductSet\Persistence\SpyProductSetQuery The inner query object of the IN statement
     */
    public function useInSpyProductSetQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductSet\Persistence\SpyProductSetQuery */
        $q = $this->useInQuery('SpyProductSet', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductSet table for a NOT IN query.
     *
     * @see useSpyProductSetInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductSet\Persistence\SpyProductSetQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductSetQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductSet\Persistence\SpyProductSetQuery */
        $q = $this->useInQuery('SpyProductSet', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Product\Persistence\SpyProductAbstract object
     *
     * @param \Orm\Zed\Product\Persistence\SpyProductAbstract|ObjectCollection $spyProductAbstract The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProduct($spyProductAbstract, ?string $comparison = null)
    {
        if ($spyProductAbstract instanceof \Orm\Zed\Product\Persistence\SpyProductAbstract) {
            return $this
                ->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_ABSTRACT, $spyProductAbstract->getIdProductAbstract(), $comparison);
        } elseif ($spyProductAbstract instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_ABSTRACT, $spyProductAbstract->toKeyValue('PrimaryKey', 'IdProductAbstract'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyProduct() only accepts arguments of type \Orm\Zed\Product\Persistence\SpyProductAbstract or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProduct relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProduct(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProduct');

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
            $this->addJoinObject($join, 'SpyProduct');
        }

        return $this;
    }

    /**
     * Use the SpyProduct relation SpyProductAbstract object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyProduct($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProduct', '\Orm\Zed\Product\Persistence\SpyProductAbstractQuery');
    }

    /**
     * Use the SpyProduct relation SpyProductAbstract object
     *
     * @param callable(\Orm\Zed\Product\Persistence\SpyProductAbstractQuery):\Orm\Zed\Product\Persistence\SpyProductAbstractQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyProductQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SpyProduct relation to the SpyProductAbstract table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractQuery */
        $q = $this->useExistsQuery('SpyProduct', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SpyProduct relation to the SpyProductAbstract table for a NOT EXISTS query.
     *
     * @see useSpyProductExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractQuery */
        $q = $this->useExistsQuery('SpyProduct', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SpyProduct relation to the SpyProductAbstract table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery The inner query object of the IN statement
     */
    public function useInSpyProductQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractQuery */
        $q = $this->useInQuery('SpyProduct', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SpyProduct relation to the SpyProductAbstract table for a NOT IN query.
     *
     * @see useSpyProductInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductAbstractQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Product\Persistence\SpyProductAbstractQuery */
        $q = $this->useInQuery('SpyProduct', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Locale\Persistence\SpyLocale object
     *
     * @param \Orm\Zed\Locale\Persistence\SpyLocale|ObjectCollection $spyLocale The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyLocale($spyLocale, ?string $comparison = null)
    {
        if ($spyLocale instanceof \Orm\Zed\Locale\Persistence\SpyLocale) {
            return $this
                ->addUsingAlias(SpyUrlTableMap::COL_FK_LOCALE, $spyLocale->getIdLocale(), $comparison);
        } elseif ($spyLocale instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyUrlTableMap::COL_FK_LOCALE, $spyLocale->toKeyValue('PrimaryKey', 'IdLocale'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyLocale() only accepts arguments of type \Orm\Zed\Locale\Persistence\SpyLocale or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyLocale relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyLocale(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyLocale');

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
            $this->addJoinObject($join, 'SpyLocale');
        }

        return $this;
    }

    /**
     * Use the SpyLocale relation SpyLocale object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery A secondary query class using the current class as primary query
     */
    public function useSpyLocaleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyLocale($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyLocale', '\Orm\Zed\Locale\Persistence\SpyLocaleQuery');
    }

    /**
     * Use the SpyLocale relation SpyLocale object
     *
     * @param callable(\Orm\Zed\Locale\Persistence\SpyLocaleQuery):\Orm\Zed\Locale\Persistence\SpyLocaleQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyLocaleQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyLocaleQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyLocale table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the EXISTS statement
     */
    public function useSpyLocaleExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleQuery */
        $q = $this->useExistsQuery('SpyLocale', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyLocale table for a NOT EXISTS query.
     *
     * @see useSpyLocaleExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyLocaleNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleQuery */
        $q = $this->useExistsQuery('SpyLocale', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyLocale table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the IN statement
     */
    public function useInSpyLocaleQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleQuery */
        $q = $this->useInQuery('SpyLocale', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyLocale table for a NOT IN query.
     *
     * @see useSpyLocaleInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Locale\Persistence\SpyLocaleQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyLocaleQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Locale\Persistence\SpyLocaleQuery */
        $q = $this->useInQuery('SpyLocale', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Url\Persistence\SpyUrlRedirect object
     *
     * @param \Orm\Zed\Url\Persistence\SpyUrlRedirect|ObjectCollection $spyUrlRedirect The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyUrlRedirect($spyUrlRedirect, ?string $comparison = null)
    {
        if ($spyUrlRedirect instanceof \Orm\Zed\Url\Persistence\SpyUrlRedirect) {
            return $this
                ->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_REDIRECT, $spyUrlRedirect->getIdUrlRedirect(), $comparison);
        } elseif ($spyUrlRedirect instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyUrlTableMap::COL_FK_RESOURCE_REDIRECT, $spyUrlRedirect->toKeyValue('PrimaryKey', 'IdUrlRedirect'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyUrlRedirect() only accepts arguments of type \Orm\Zed\Url\Persistence\SpyUrlRedirect or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyUrlRedirect relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyUrlRedirect(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyUrlRedirect');

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
            $this->addJoinObject($join, 'SpyUrlRedirect');
        }

        return $this;
    }

    /**
     * Use the SpyUrlRedirect relation SpyUrlRedirect object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlRedirectQuery A secondary query class using the current class as primary query
     */
    public function useSpyUrlRedirectQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyUrlRedirect($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyUrlRedirect', '\Orm\Zed\Url\Persistence\SpyUrlRedirectQuery');
    }

    /**
     * Use the SpyUrlRedirect relation SpyUrlRedirect object
     *
     * @param callable(\Orm\Zed\Url\Persistence\SpyUrlRedirectQuery):\Orm\Zed\Url\Persistence\SpyUrlRedirectQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyUrlRedirectQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyUrlRedirectQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyUrlRedirect table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlRedirectQuery The inner query object of the EXISTS statement
     */
    public function useSpyUrlRedirectExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Url\Persistence\SpyUrlRedirectQuery */
        $q = $this->useExistsQuery('SpyUrlRedirect', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyUrlRedirect table for a NOT EXISTS query.
     *
     * @see useSpyUrlRedirectExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlRedirectQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyUrlRedirectNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Url\Persistence\SpyUrlRedirectQuery */
        $q = $this->useExistsQuery('SpyUrlRedirect', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyUrlRedirect table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlRedirectQuery The inner query object of the IN statement
     */
    public function useInSpyUrlRedirectQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Url\Persistence\SpyUrlRedirectQuery */
        $q = $this->useInQuery('SpyUrlRedirect', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyUrlRedirect table for a NOT IN query.
     *
     * @see useSpyUrlRedirectInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrlRedirectQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyUrlRedirectQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Url\Persistence\SpyUrlRedirectQuery */
        $q = $this->useInQuery('SpyUrlRedirect', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes object
     *
     * @param \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes|ObjectCollection $spyNavigationNodeLocalizedAttributes the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyNavigationNodeLocalizedAttributes($spyNavigationNodeLocalizedAttributes, ?string $comparison = null)
    {
        if ($spyNavigationNodeLocalizedAttributes instanceof \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes) {
            $this
                ->addUsingAlias(SpyUrlTableMap::COL_ID_URL, $spyNavigationNodeLocalizedAttributes->getFkUrl(), $comparison);

            return $this;
        } elseif ($spyNavigationNodeLocalizedAttributes instanceof ObjectCollection) {
            $this
                ->useSpyNavigationNodeLocalizedAttributesQuery()
                ->filterByPrimaryKeys($spyNavigationNodeLocalizedAttributes->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyNavigationNodeLocalizedAttributes() only accepts arguments of type \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyNavigationNodeLocalizedAttributes relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyNavigationNodeLocalizedAttributes(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyNavigationNodeLocalizedAttributes');

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
            $this->addJoinObject($join, 'SpyNavigationNodeLocalizedAttributes');
        }

        return $this;
    }

    /**
     * Use the SpyNavigationNodeLocalizedAttributes relation SpyNavigationNodeLocalizedAttributes object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery A secondary query class using the current class as primary query
     */
    public function useSpyNavigationNodeLocalizedAttributesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSpyNavigationNodeLocalizedAttributes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyNavigationNodeLocalizedAttributes', '\Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery');
    }

    /**
     * Use the SpyNavigationNodeLocalizedAttributes relation SpyNavigationNodeLocalizedAttributes object
     *
     * @param callable(\Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery):\Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyNavigationNodeLocalizedAttributesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useSpyNavigationNodeLocalizedAttributesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyNavigationNodeLocalizedAttributes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery The inner query object of the EXISTS statement
     */
    public function useSpyNavigationNodeLocalizedAttributesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyNavigationNodeLocalizedAttributes', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyNavigationNodeLocalizedAttributes table for a NOT EXISTS query.
     *
     * @see useSpyNavigationNodeLocalizedAttributesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyNavigationNodeLocalizedAttributesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery */
        $q = $this->useExistsQuery('SpyNavigationNodeLocalizedAttributes', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyNavigationNodeLocalizedAttributes table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery The inner query object of the IN statement
     */
    public function useInSpyNavigationNodeLocalizedAttributesQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyNavigationNodeLocalizedAttributes', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyNavigationNodeLocalizedAttributes table for a NOT IN query.
     *
     * @see useSpyNavigationNodeLocalizedAttributesInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyNavigationNodeLocalizedAttributesQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery */
        $q = $this->useInQuery('SpyNavigationNodeLocalizedAttributes', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyUrl $spyUrl Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyUrl = null)
    {
        if ($spyUrl) {
            $this->addUsingAlias(SpyUrlTableMap::COL_ID_URL, $spyUrl->getIdUrl(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_url table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyUrlTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyUrlTableMap::clearInstancePool();
            SpyUrlTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyUrlTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyUrlTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyUrlTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyUrlTableMap::clearRelatedInstancePool();

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
