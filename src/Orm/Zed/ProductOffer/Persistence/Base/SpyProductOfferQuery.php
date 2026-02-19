<?php

namespace Orm\Zed\ProductOffer\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Merchant\Persistence\SpyMerchant;
use Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOffer;
use Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferService;
use Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentType;
use Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStock;
use Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidity;
use Orm\Zed\ProductOffer\Persistence\SpyProductOffer as ChildSpyProductOffer;
use Orm\Zed\ProductOffer\Persistence\SpyProductOfferQuery as ChildSpyProductOfferQuery;
use Orm\Zed\ProductOffer\Persistence\Map\SpyProductOfferTableMap;
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
 * Base class that represents a query for the `spy_product_offer` table.
 *
 * @method     ChildSpyProductOfferQuery orderByIdProductOffer($order = Criteria::ASC) Order by the id_product_offer column
 * @method     ChildSpyProductOfferQuery orderByApprovalStatus($order = Criteria::ASC) Order by the approval_status column
 * @method     ChildSpyProductOfferQuery orderByConcreteSku($order = Criteria::ASC) Order by the concrete_sku column
 * @method     ChildSpyProductOfferQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyProductOfferQuery orderByMerchantReference($order = Criteria::ASC) Order by the merchant_reference column
 * @method     ChildSpyProductOfferQuery orderByMerchantSku($order = Criteria::ASC) Order by the merchant_sku column
 * @method     ChildSpyProductOfferQuery orderByProductOfferReference($order = Criteria::ASC) Order by the product_offer_reference column
 * @method     ChildSpyProductOfferQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyProductOfferQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyProductOfferQuery groupByIdProductOffer() Group by the id_product_offer column
 * @method     ChildSpyProductOfferQuery groupByApprovalStatus() Group by the approval_status column
 * @method     ChildSpyProductOfferQuery groupByConcreteSku() Group by the concrete_sku column
 * @method     ChildSpyProductOfferQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyProductOfferQuery groupByMerchantReference() Group by the merchant_reference column
 * @method     ChildSpyProductOfferQuery groupByMerchantSku() Group by the merchant_sku column
 * @method     ChildSpyProductOfferQuery groupByProductOfferReference() Group by the product_offer_reference column
 * @method     ChildSpyProductOfferQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyProductOfferQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyProductOfferQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyProductOfferQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyProductOfferQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyProductOfferQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyProductOfferQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyProductOfferQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyProductOfferQuery leftJoinMerchant($relationAlias = null) Adds a LEFT JOIN clause to the query using the Merchant relation
 * @method     ChildSpyProductOfferQuery rightJoinMerchant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Merchant relation
 * @method     ChildSpyProductOfferQuery innerJoinMerchant($relationAlias = null) Adds a INNER JOIN clause to the query using the Merchant relation
 *
 * @method     ChildSpyProductOfferQuery joinWithMerchant($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Merchant relation
 *
 * @method     ChildSpyProductOfferQuery leftJoinWithMerchant() Adds a LEFT JOIN clause and with to the query using the Merchant relation
 * @method     ChildSpyProductOfferQuery rightJoinWithMerchant() Adds a RIGHT JOIN clause and with to the query using the Merchant relation
 * @method     ChildSpyProductOfferQuery innerJoinWithMerchant() Adds a INNER JOIN clause and with to the query using the Merchant relation
 *
 * @method     ChildSpyProductOfferQuery leftJoinSpyPriceProductOffer($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyPriceProductOffer relation
 * @method     ChildSpyProductOfferQuery rightJoinSpyPriceProductOffer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyPriceProductOffer relation
 * @method     ChildSpyProductOfferQuery innerJoinSpyPriceProductOffer($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyPriceProductOffer relation
 *
 * @method     ChildSpyProductOfferQuery joinWithSpyPriceProductOffer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyPriceProductOffer relation
 *
 * @method     ChildSpyProductOfferQuery leftJoinWithSpyPriceProductOffer() Adds a LEFT JOIN clause and with to the query using the SpyPriceProductOffer relation
 * @method     ChildSpyProductOfferQuery rightJoinWithSpyPriceProductOffer() Adds a RIGHT JOIN clause and with to the query using the SpyPriceProductOffer relation
 * @method     ChildSpyProductOfferQuery innerJoinWithSpyPriceProductOffer() Adds a INNER JOIN clause and with to the query using the SpyPriceProductOffer relation
 *
 * @method     ChildSpyProductOfferQuery leftJoinSpyProductOfferStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductOfferStore relation
 * @method     ChildSpyProductOfferQuery rightJoinSpyProductOfferStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductOfferStore relation
 * @method     ChildSpyProductOfferQuery innerJoinSpyProductOfferStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductOfferStore relation
 *
 * @method     ChildSpyProductOfferQuery joinWithSpyProductOfferStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductOfferStore relation
 *
 * @method     ChildSpyProductOfferQuery leftJoinWithSpyProductOfferStore() Adds a LEFT JOIN clause and with to the query using the SpyProductOfferStore relation
 * @method     ChildSpyProductOfferQuery rightJoinWithSpyProductOfferStore() Adds a RIGHT JOIN clause and with to the query using the SpyProductOfferStore relation
 * @method     ChildSpyProductOfferQuery innerJoinWithSpyProductOfferStore() Adds a INNER JOIN clause and with to the query using the SpyProductOfferStore relation
 *
 * @method     ChildSpyProductOfferQuery leftJoinProductOfferService($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductOfferService relation
 * @method     ChildSpyProductOfferQuery rightJoinProductOfferService($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductOfferService relation
 * @method     ChildSpyProductOfferQuery innerJoinProductOfferService($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductOfferService relation
 *
 * @method     ChildSpyProductOfferQuery joinWithProductOfferService($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductOfferService relation
 *
 * @method     ChildSpyProductOfferQuery leftJoinWithProductOfferService() Adds a LEFT JOIN clause and with to the query using the ProductOfferService relation
 * @method     ChildSpyProductOfferQuery rightJoinWithProductOfferService() Adds a RIGHT JOIN clause and with to the query using the ProductOfferService relation
 * @method     ChildSpyProductOfferQuery innerJoinWithProductOfferService() Adds a INNER JOIN clause and with to the query using the ProductOfferService relation
 *
 * @method     ChildSpyProductOfferQuery leftJoinProductOfferShipmentType($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductOfferShipmentType relation
 * @method     ChildSpyProductOfferQuery rightJoinProductOfferShipmentType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductOfferShipmentType relation
 * @method     ChildSpyProductOfferQuery innerJoinProductOfferShipmentType($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductOfferShipmentType relation
 *
 * @method     ChildSpyProductOfferQuery joinWithProductOfferShipmentType($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductOfferShipmentType relation
 *
 * @method     ChildSpyProductOfferQuery leftJoinWithProductOfferShipmentType() Adds a LEFT JOIN clause and with to the query using the ProductOfferShipmentType relation
 * @method     ChildSpyProductOfferQuery rightJoinWithProductOfferShipmentType() Adds a RIGHT JOIN clause and with to the query using the ProductOfferShipmentType relation
 * @method     ChildSpyProductOfferQuery innerJoinWithProductOfferShipmentType() Adds a INNER JOIN clause and with to the query using the ProductOfferShipmentType relation
 *
 * @method     ChildSpyProductOfferQuery leftJoinProductOfferStock($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProductOfferStock relation
 * @method     ChildSpyProductOfferQuery rightJoinProductOfferStock($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProductOfferStock relation
 * @method     ChildSpyProductOfferQuery innerJoinProductOfferStock($relationAlias = null) Adds a INNER JOIN clause to the query using the ProductOfferStock relation
 *
 * @method     ChildSpyProductOfferQuery joinWithProductOfferStock($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProductOfferStock relation
 *
 * @method     ChildSpyProductOfferQuery leftJoinWithProductOfferStock() Adds a LEFT JOIN clause and with to the query using the ProductOfferStock relation
 * @method     ChildSpyProductOfferQuery rightJoinWithProductOfferStock() Adds a RIGHT JOIN clause and with to the query using the ProductOfferStock relation
 * @method     ChildSpyProductOfferQuery innerJoinWithProductOfferStock() Adds a INNER JOIN clause and with to the query using the ProductOfferStock relation
 *
 * @method     ChildSpyProductOfferQuery leftJoinSpyProductOfferValidity($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyProductOfferValidity relation
 * @method     ChildSpyProductOfferQuery rightJoinSpyProductOfferValidity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyProductOfferValidity relation
 * @method     ChildSpyProductOfferQuery innerJoinSpyProductOfferValidity($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyProductOfferValidity relation
 *
 * @method     ChildSpyProductOfferQuery joinWithSpyProductOfferValidity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyProductOfferValidity relation
 *
 * @method     ChildSpyProductOfferQuery leftJoinWithSpyProductOfferValidity() Adds a LEFT JOIN clause and with to the query using the SpyProductOfferValidity relation
 * @method     ChildSpyProductOfferQuery rightJoinWithSpyProductOfferValidity() Adds a RIGHT JOIN clause and with to the query using the SpyProductOfferValidity relation
 * @method     ChildSpyProductOfferQuery innerJoinWithSpyProductOfferValidity() Adds a INNER JOIN clause and with to the query using the SpyProductOfferValidity relation
 *
 * @method     \Orm\Zed\Merchant\Persistence\SpyMerchantQuery|\Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOfferQuery|\Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery|\Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferServiceQuery|\Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery|\Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStockQuery|\Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyProductOffer|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyProductOffer matching the query
 * @method     ChildSpyProductOffer findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyProductOffer matching the query, or a new ChildSpyProductOffer object populated from the query conditions when no match is found
 *
 * @method     ChildSpyProductOffer|null findOneByIdProductOffer(int $id_product_offer) Return the first ChildSpyProductOffer filtered by the id_product_offer column
 * @method     ChildSpyProductOffer|null findOneByApprovalStatus(string $approval_status) Return the first ChildSpyProductOffer filtered by the approval_status column
 * @method     ChildSpyProductOffer|null findOneByConcreteSku(string $concrete_sku) Return the first ChildSpyProductOffer filtered by the concrete_sku column
 * @method     ChildSpyProductOffer|null findOneByIsActive(boolean $is_active) Return the first ChildSpyProductOffer filtered by the is_active column
 * @method     ChildSpyProductOffer|null findOneByMerchantReference(string $merchant_reference) Return the first ChildSpyProductOffer filtered by the merchant_reference column
 * @method     ChildSpyProductOffer|null findOneByMerchantSku(string $merchant_sku) Return the first ChildSpyProductOffer filtered by the merchant_sku column
 * @method     ChildSpyProductOffer|null findOneByProductOfferReference(string $product_offer_reference) Return the first ChildSpyProductOffer filtered by the product_offer_reference column
 * @method     ChildSpyProductOffer|null findOneByCreatedAt(string $created_at) Return the first ChildSpyProductOffer filtered by the created_at column
 * @method     ChildSpyProductOffer|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductOffer filtered by the updated_at column
 *
 * @method     ChildSpyProductOffer requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyProductOffer by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOffer requireOne(?ConnectionInterface $con = null) Return the first ChildSpyProductOffer matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductOffer requireOneByIdProductOffer(int $id_product_offer) Return the first ChildSpyProductOffer filtered by the id_product_offer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOffer requireOneByApprovalStatus(string $approval_status) Return the first ChildSpyProductOffer filtered by the approval_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOffer requireOneByConcreteSku(string $concrete_sku) Return the first ChildSpyProductOffer filtered by the concrete_sku column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOffer requireOneByIsActive(boolean $is_active) Return the first ChildSpyProductOffer filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOffer requireOneByMerchantReference(string $merchant_reference) Return the first ChildSpyProductOffer filtered by the merchant_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOffer requireOneByMerchantSku(string $merchant_sku) Return the first ChildSpyProductOffer filtered by the merchant_sku column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOffer requireOneByProductOfferReference(string $product_offer_reference) Return the first ChildSpyProductOffer filtered by the product_offer_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOffer requireOneByCreatedAt(string $created_at) Return the first ChildSpyProductOffer filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyProductOffer requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyProductOffer filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyProductOffer[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyProductOffer objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyProductOffer> find(?ConnectionInterface $con = null) Return ChildSpyProductOffer objects based on current ModelCriteria
 *
 * @method     ChildSpyProductOffer[]|Collection findByIdProductOffer(int|array<int> $id_product_offer) Return ChildSpyProductOffer objects filtered by the id_product_offer column
 * @psalm-method Collection&\Traversable<ChildSpyProductOffer> findByIdProductOffer(int|array<int> $id_product_offer) Return ChildSpyProductOffer objects filtered by the id_product_offer column
 * @method     ChildSpyProductOffer[]|Collection findByApprovalStatus(string|array<string> $approval_status) Return ChildSpyProductOffer objects filtered by the approval_status column
 * @psalm-method Collection&\Traversable<ChildSpyProductOffer> findByApprovalStatus(string|array<string> $approval_status) Return ChildSpyProductOffer objects filtered by the approval_status column
 * @method     ChildSpyProductOffer[]|Collection findByConcreteSku(string|array<string> $concrete_sku) Return ChildSpyProductOffer objects filtered by the concrete_sku column
 * @psalm-method Collection&\Traversable<ChildSpyProductOffer> findByConcreteSku(string|array<string> $concrete_sku) Return ChildSpyProductOffer objects filtered by the concrete_sku column
 * @method     ChildSpyProductOffer[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyProductOffer objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyProductOffer> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyProductOffer objects filtered by the is_active column
 * @method     ChildSpyProductOffer[]|Collection findByMerchantReference(string|array<string> $merchant_reference) Return ChildSpyProductOffer objects filtered by the merchant_reference column
 * @psalm-method Collection&\Traversable<ChildSpyProductOffer> findByMerchantReference(string|array<string> $merchant_reference) Return ChildSpyProductOffer objects filtered by the merchant_reference column
 * @method     ChildSpyProductOffer[]|Collection findByMerchantSku(string|array<string> $merchant_sku) Return ChildSpyProductOffer objects filtered by the merchant_sku column
 * @psalm-method Collection&\Traversable<ChildSpyProductOffer> findByMerchantSku(string|array<string> $merchant_sku) Return ChildSpyProductOffer objects filtered by the merchant_sku column
 * @method     ChildSpyProductOffer[]|Collection findByProductOfferReference(string|array<string> $product_offer_reference) Return ChildSpyProductOffer objects filtered by the product_offer_reference column
 * @psalm-method Collection&\Traversable<ChildSpyProductOffer> findByProductOfferReference(string|array<string> $product_offer_reference) Return ChildSpyProductOffer objects filtered by the product_offer_reference column
 * @method     ChildSpyProductOffer[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductOffer objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductOffer> findByCreatedAt(string|array<string> $created_at) Return ChildSpyProductOffer objects filtered by the created_at column
 * @method     ChildSpyProductOffer[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductOffer objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyProductOffer> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyProductOffer objects filtered by the updated_at column
 *
 * @method     ChildSpyProductOffer[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyProductOffer> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyProductOfferQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\ProductOffer\Persistence\Base\SpyProductOfferQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\ProductOffer\\Persistence\\SpyProductOffer', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyProductOfferQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyProductOfferQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyProductOfferQuery) {
            return $criteria;
        }
        $query = new ChildSpyProductOfferQuery();
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
     * @return ChildSpyProductOffer|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyProductOfferTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyProductOffer A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_product_offer, approval_status, concrete_sku, is_active, merchant_reference, merchant_sku, product_offer_reference, created_at, updated_at FROM spy_product_offer WHERE id_product_offer = :p0';
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
            /** @var ChildSpyProductOffer $obj */
            $obj = new ChildSpyProductOffer();
            $obj->hydrate($row);
            SpyProductOfferTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyProductOffer|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idProductOffer Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductOffer_Between(array $idProductOffer)
    {
        return $this->filterByIdProductOffer($idProductOffer, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idProductOffers Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdProductOffer_In(array $idProductOffers)
    {
        return $this->filterByIdProductOffer($idProductOffers, Criteria::IN);
    }

    /**
     * Filter the query on the id_product_offer column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProductOffer(1234); // WHERE id_product_offer = 1234
     * $query->filterByIdProductOffer(array(12, 34), Criteria::IN); // WHERE id_product_offer IN (12, 34)
     * $query->filterByIdProductOffer(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_product_offer > 12
     * </code>
     *
     * @param     mixed $idProductOffer The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdProductOffer($idProductOffer = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idProductOffer)) {
            $useMinMax = false;
            if (isset($idProductOffer['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER, $idProductOffer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProductOffer['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER, $idProductOffer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idProductOffer of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER, $idProductOffer, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $approvalStatuss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApprovalStatus_In(array $approvalStatuss)
    {
        return $this->filterByApprovalStatus($approvalStatuss, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $approvalStatus Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByApprovalStatus_Like($approvalStatus)
    {
        return $this->filterByApprovalStatus($approvalStatus, Criteria::LIKE);
    }

    /**
     * Filter the query on the approval_status column
     *
     * Example usage:
     * <code>
     * $query->filterByApprovalStatus('fooValue');   // WHERE approval_status = 'fooValue'
     * $query->filterByApprovalStatus('%fooValue%', Criteria::LIKE); // WHERE approval_status LIKE '%fooValue%'
     * $query->filterByApprovalStatus([1, 'foo'], Criteria::IN); // WHERE approval_status IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $approvalStatus The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByApprovalStatus($approvalStatus = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $approvalStatus = str_replace('*', '%', $approvalStatus);
        }

        if (is_array($approvalStatus) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$approvalStatus of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductOfferTableMap::COL_APPROVAL_STATUS, $approvalStatus, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $concreteSkus Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConcreteSku_In(array $concreteSkus)
    {
        return $this->filterByConcreteSku($concreteSkus, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $concreteSku Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByConcreteSku_Like($concreteSku)
    {
        return $this->filterByConcreteSku($concreteSku, Criteria::LIKE);
    }

    /**
     * Filter the query on the concrete_sku column
     *
     * Example usage:
     * <code>
     * $query->filterByConcreteSku('fooValue');   // WHERE concrete_sku = 'fooValue'
     * $query->filterByConcreteSku('%fooValue%', Criteria::LIKE); // WHERE concrete_sku LIKE '%fooValue%'
     * $query->filterByConcreteSku([1, 'foo'], Criteria::IN); // WHERE concrete_sku IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $concreteSku The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByConcreteSku($concreteSku = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $concreteSku = str_replace('*', '%', $concreteSku);
        }

        if (is_array($concreteSku) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$concreteSku of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductOfferTableMap::COL_CONCRETE_SKU, $concreteSku, $comparison);

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

        $query = $this->addUsingAlias(SpyProductOfferTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $merchantReferences Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantReference_In(array $merchantReferences)
    {
        return $this->filterByMerchantReference($merchantReferences, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $merchantReference Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantReference_Like($merchantReference)
    {
        return $this->filterByMerchantReference($merchantReference, Criteria::LIKE);
    }

    /**
     * Filter the query on the merchant_reference column
     *
     * Example usage:
     * <code>
     * $query->filterByMerchantReference('fooValue');   // WHERE merchant_reference = 'fooValue'
     * $query->filterByMerchantReference('%fooValue%', Criteria::LIKE); // WHERE merchant_reference LIKE '%fooValue%'
     * $query->filterByMerchantReference([1, 'foo'], Criteria::IN); // WHERE merchant_reference IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $merchantReference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByMerchantReference($merchantReference = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $merchantReference = str_replace('*', '%', $merchantReference);
        }

        if (is_array($merchantReference) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$merchantReference of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductOfferTableMap::COL_MERCHANT_REFERENCE, $merchantReference, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $merchantSkus Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantSku_In(array $merchantSkus)
    {
        return $this->filterByMerchantSku($merchantSkus, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $merchantSku Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantSku_Like($merchantSku)
    {
        return $this->filterByMerchantSku($merchantSku, Criteria::LIKE);
    }

    /**
     * Filter the query on the merchant_sku column
     *
     * Example usage:
     * <code>
     * $query->filterByMerchantSku('fooValue');   // WHERE merchant_sku = 'fooValue'
     * $query->filterByMerchantSku('%fooValue%', Criteria::LIKE); // WHERE merchant_sku LIKE '%fooValue%'
     * $query->filterByMerchantSku([1, 'foo'], Criteria::IN); // WHERE merchant_sku IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $merchantSku The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByMerchantSku($merchantSku = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $merchantSku = str_replace('*', '%', $merchantSku);
        }

        if (is_array($merchantSku) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$merchantSku of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductOfferTableMap::COL_MERCHANT_SKU, $merchantSku, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $productOfferReferences Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductOfferReference_In(array $productOfferReferences)
    {
        return $this->filterByProductOfferReference($productOfferReferences, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $productOfferReference Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductOfferReference_Like($productOfferReference)
    {
        return $this->filterByProductOfferReference($productOfferReference, Criteria::LIKE);
    }

    /**
     * Filter the query on the product_offer_reference column
     *
     * Example usage:
     * <code>
     * $query->filterByProductOfferReference('fooValue');   // WHERE product_offer_reference = 'fooValue'
     * $query->filterByProductOfferReference('%fooValue%', Criteria::LIKE); // WHERE product_offer_reference LIKE '%fooValue%'
     * $query->filterByProductOfferReference([1, 'foo'], Criteria::IN); // WHERE product_offer_reference IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $productOfferReference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByProductOfferReference($productOfferReference = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $productOfferReference = str_replace('*', '%', $productOfferReference);
        }

        if (is_array($productOfferReference) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$productOfferReference of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyProductOfferTableMap::COL_PRODUCT_OFFER_REFERENCE, $productOfferReference, $comparison);

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
                $this->addUsingAlias(SpyProductOfferTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOfferTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductOfferTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyProductOfferTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyProductOfferTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyProductOfferTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

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
    public function filterByMerchant($spyMerchant, ?string $comparison = null)
    {
        if ($spyMerchant instanceof \Orm\Zed\Merchant\Persistence\SpyMerchant) {
            return $this
                ->addUsingAlias(SpyProductOfferTableMap::COL_MERCHANT_REFERENCE, $spyMerchant->getMerchantReference(), $comparison);
        } elseif ($spyMerchant instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyProductOfferTableMap::COL_MERCHANT_REFERENCE, $spyMerchant->toKeyValue('PrimaryKey', 'MerchantReference'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByMerchant() only accepts arguments of type \Orm\Zed\Merchant\Persistence\SpyMerchant or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Merchant relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMerchant(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Merchant');

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
            $this->addJoinObject($join, 'Merchant');
        }

        return $this;
    }

    /**
     * Use the Merchant relation SpyMerchant object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery A secondary query class using the current class as primary query
     */
    public function useMerchantQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinMerchant($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Merchant', '\Orm\Zed\Merchant\Persistence\SpyMerchantQuery');
    }

    /**
     * Use the Merchant relation SpyMerchant object
     *
     * @param callable(\Orm\Zed\Merchant\Persistence\SpyMerchantQuery):\Orm\Zed\Merchant\Persistence\SpyMerchantQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMerchantQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useMerchantQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Merchant relation to the SpyMerchant table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the EXISTS statement
     */
    public function useMerchantExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useExistsQuery('Merchant', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Merchant relation to the SpyMerchant table for a NOT EXISTS query.
     *
     * @see useMerchantExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the NOT EXISTS statement
     */
    public function useMerchantNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useExistsQuery('Merchant', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Merchant relation to the SpyMerchant table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the IN statement
     */
    public function useInMerchantQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useInQuery('Merchant', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Merchant relation to the SpyMerchant table for a NOT IN query.
     *
     * @see useMerchantInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Merchant\Persistence\SpyMerchantQuery The inner query object of the NOT IN statement
     */
    public function useNotInMerchantQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Merchant\Persistence\SpyMerchantQuery */
        $q = $this->useInQuery('Merchant', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOffer object
     *
     * @param \Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOffer|ObjectCollection $spyPriceProductOffer the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyPriceProductOffer($spyPriceProductOffer, ?string $comparison = null)
    {
        if ($spyPriceProductOffer instanceof \Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOffer) {
            $this
                ->addUsingAlias(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER, $spyPriceProductOffer->getFkProductOffer(), $comparison);

            return $this;
        } elseif ($spyPriceProductOffer instanceof ObjectCollection) {
            $this
                ->useSpyPriceProductOfferQuery()
                ->filterByPrimaryKeys($spyPriceProductOffer->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyPriceProductOffer() only accepts arguments of type \Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOffer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyPriceProductOffer relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyPriceProductOffer(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyPriceProductOffer');

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
            $this->addJoinObject($join, 'SpyPriceProductOffer');
        }

        return $this;
    }

    /**
     * Use the SpyPriceProductOffer relation SpyPriceProductOffer object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOfferQuery A secondary query class using the current class as primary query
     */
    public function useSpyPriceProductOfferQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyPriceProductOffer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyPriceProductOffer', '\Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOfferQuery');
    }

    /**
     * Use the SpyPriceProductOffer relation SpyPriceProductOffer object
     *
     * @param callable(\Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOfferQuery):\Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOfferQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyPriceProductOfferQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyPriceProductOfferQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyPriceProductOffer table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOfferQuery The inner query object of the EXISTS statement
     */
    public function useSpyPriceProductOfferExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOfferQuery */
        $q = $this->useExistsQuery('SpyPriceProductOffer', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyPriceProductOffer table for a NOT EXISTS query.
     *
     * @see useSpyPriceProductOfferExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOfferQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyPriceProductOfferNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOfferQuery */
        $q = $this->useExistsQuery('SpyPriceProductOffer', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyPriceProductOffer table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOfferQuery The inner query object of the IN statement
     */
    public function useInSpyPriceProductOfferQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOfferQuery */
        $q = $this->useInQuery('SpyPriceProductOffer', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyPriceProductOffer table for a NOT IN query.
     *
     * @see useSpyPriceProductOfferInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOfferQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyPriceProductOfferQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\PriceProductOffer\Persistence\SpyPriceProductOfferQuery */
        $q = $this->useInQuery('SpyPriceProductOffer', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStore object
     *
     * @param \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStore|ObjectCollection $spyProductOfferStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductOfferStore($spyProductOfferStore, ?string $comparison = null)
    {
        if ($spyProductOfferStore instanceof \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStore) {
            $this
                ->addUsingAlias(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER, $spyProductOfferStore->getFkProductOffer(), $comparison);

            return $this;
        } elseif ($spyProductOfferStore instanceof ObjectCollection) {
            $this
                ->useSpyProductOfferStoreQuery()
                ->filterByPrimaryKeys($spyProductOfferStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductOfferStore() only accepts arguments of type \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductOfferStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductOfferStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductOfferStore');

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
            $this->addJoinObject($join, 'SpyProductOfferStore');
        }

        return $this;
    }

    /**
     * Use the SpyProductOfferStore relation SpyProductOfferStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductOfferStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductOfferStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductOfferStore', '\Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery');
    }

    /**
     * Use the SpyProductOfferStore relation SpyProductOfferStore object
     *
     * @param callable(\Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery):\Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductOfferStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductOfferStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductOfferStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductOfferStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery */
        $q = $this->useExistsQuery('SpyProductOfferStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductOfferStore table for a NOT EXISTS query.
     *
     * @see useSpyProductOfferStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductOfferStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery */
        $q = $this->useExistsQuery('SpyProductOfferStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductOfferStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery The inner query object of the IN statement
     */
    public function useInSpyProductOfferStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery */
        $q = $this->useInQuery('SpyProductOfferStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductOfferStore table for a NOT IN query.
     *
     * @see useSpyProductOfferStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductOfferStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOffer\Persistence\SpyProductOfferStoreQuery */
        $q = $this->useInQuery('SpyProductOfferStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferService object
     *
     * @param \Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferService|ObjectCollection $spyProductOfferService the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductOfferService($spyProductOfferService, ?string $comparison = null)
    {
        if ($spyProductOfferService instanceof \Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferService) {
            $this
                ->addUsingAlias(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER, $spyProductOfferService->getFkProductOffer(), $comparison);

            return $this;
        } elseif ($spyProductOfferService instanceof ObjectCollection) {
            $this
                ->useProductOfferServiceQuery()
                ->filterByPrimaryKeys($spyProductOfferService->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProductOfferService() only accepts arguments of type \Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferService or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductOfferService relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductOfferService(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductOfferService');

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
            $this->addJoinObject($join, 'ProductOfferService');
        }

        return $this;
    }

    /**
     * Use the ProductOfferService relation SpyProductOfferService object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferServiceQuery A secondary query class using the current class as primary query
     */
    public function useProductOfferServiceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductOfferService($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductOfferService', '\Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferServiceQuery');
    }

    /**
     * Use the ProductOfferService relation SpyProductOfferService object
     *
     * @param callable(\Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferServiceQuery):\Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferServiceQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductOfferServiceQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductOfferServiceQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ProductOfferService relation to the SpyProductOfferService table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferServiceQuery The inner query object of the EXISTS statement
     */
    public function useProductOfferServiceExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferServiceQuery */
        $q = $this->useExistsQuery('ProductOfferService', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ProductOfferService relation to the SpyProductOfferService table for a NOT EXISTS query.
     *
     * @see useProductOfferServiceExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferServiceQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductOfferServiceNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferServiceQuery */
        $q = $this->useExistsQuery('ProductOfferService', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ProductOfferService relation to the SpyProductOfferService table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferServiceQuery The inner query object of the IN statement
     */
    public function useInProductOfferServiceQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferServiceQuery */
        $q = $this->useInQuery('ProductOfferService', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ProductOfferService relation to the SpyProductOfferService table for a NOT IN query.
     *
     * @see useProductOfferServiceInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferServiceQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductOfferServiceQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOfferServicePoint\Persistence\SpyProductOfferServiceQuery */
        $q = $this->useInQuery('ProductOfferService', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentType object
     *
     * @param \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentType|ObjectCollection $spyProductOfferShipmentType the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductOfferShipmentType($spyProductOfferShipmentType, ?string $comparison = null)
    {
        if ($spyProductOfferShipmentType instanceof \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentType) {
            $this
                ->addUsingAlias(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER, $spyProductOfferShipmentType->getFkProductOffer(), $comparison);

            return $this;
        } elseif ($spyProductOfferShipmentType instanceof ObjectCollection) {
            $this
                ->useProductOfferShipmentTypeQuery()
                ->filterByPrimaryKeys($spyProductOfferShipmentType->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProductOfferShipmentType() only accepts arguments of type \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentType or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductOfferShipmentType relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductOfferShipmentType(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductOfferShipmentType');

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
            $this->addJoinObject($join, 'ProductOfferShipmentType');
        }

        return $this;
    }

    /**
     * Use the ProductOfferShipmentType relation SpyProductOfferShipmentType object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery A secondary query class using the current class as primary query
     */
    public function useProductOfferShipmentTypeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductOfferShipmentType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductOfferShipmentType', '\Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery');
    }

    /**
     * Use the ProductOfferShipmentType relation SpyProductOfferShipmentType object
     *
     * @param callable(\Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery):\Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductOfferShipmentTypeQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductOfferShipmentTypeQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ProductOfferShipmentType relation to the SpyProductOfferShipmentType table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery The inner query object of the EXISTS statement
     */
    public function useProductOfferShipmentTypeExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery */
        $q = $this->useExistsQuery('ProductOfferShipmentType', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ProductOfferShipmentType relation to the SpyProductOfferShipmentType table for a NOT EXISTS query.
     *
     * @see useProductOfferShipmentTypeExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductOfferShipmentTypeNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery */
        $q = $this->useExistsQuery('ProductOfferShipmentType', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ProductOfferShipmentType relation to the SpyProductOfferShipmentType table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery The inner query object of the IN statement
     */
    public function useInProductOfferShipmentTypeQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery */
        $q = $this->useInQuery('ProductOfferShipmentType', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ProductOfferShipmentType relation to the SpyProductOfferShipmentType table for a NOT IN query.
     *
     * @see useProductOfferShipmentTypeInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductOfferShipmentTypeQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOfferShipmentType\Persistence\SpyProductOfferShipmentTypeQuery */
        $q = $this->useInQuery('ProductOfferShipmentType', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStock object
     *
     * @param \Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStock|ObjectCollection $spyProductOfferStock the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductOfferStock($spyProductOfferStock, ?string $comparison = null)
    {
        if ($spyProductOfferStock instanceof \Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStock) {
            $this
                ->addUsingAlias(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER, $spyProductOfferStock->getFkProductOffer(), $comparison);

            return $this;
        } elseif ($spyProductOfferStock instanceof ObjectCollection) {
            $this
                ->useProductOfferStockQuery()
                ->filterByPrimaryKeys($spyProductOfferStock->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByProductOfferStock() only accepts arguments of type \Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStock or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProductOfferStock relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinProductOfferStock(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProductOfferStock');

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
            $this->addJoinObject($join, 'ProductOfferStock');
        }

        return $this;
    }

    /**
     * Use the ProductOfferStock relation SpyProductOfferStock object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStockQuery A secondary query class using the current class as primary query
     */
    public function useProductOfferStockQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProductOfferStock($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProductOfferStock', '\Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStockQuery');
    }

    /**
     * Use the ProductOfferStock relation SpyProductOfferStock object
     *
     * @param callable(\Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStockQuery):\Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStockQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProductOfferStockQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProductOfferStockQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the ProductOfferStock relation to the SpyProductOfferStock table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStockQuery The inner query object of the EXISTS statement
     */
    public function useProductOfferStockExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStockQuery */
        $q = $this->useExistsQuery('ProductOfferStock', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the ProductOfferStock relation to the SpyProductOfferStock table for a NOT EXISTS query.
     *
     * @see useProductOfferStockExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStockQuery The inner query object of the NOT EXISTS statement
     */
    public function useProductOfferStockNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStockQuery */
        $q = $this->useExistsQuery('ProductOfferStock', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the ProductOfferStock relation to the SpyProductOfferStock table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStockQuery The inner query object of the IN statement
     */
    public function useInProductOfferStockQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStockQuery */
        $q = $this->useInQuery('ProductOfferStock', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the ProductOfferStock relation to the SpyProductOfferStock table for a NOT IN query.
     *
     * @see useProductOfferStockInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStockQuery The inner query object of the NOT IN statement
     */
    public function useNotInProductOfferStockQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOfferStock\Persistence\SpyProductOfferStockQuery */
        $q = $this->useInQuery('ProductOfferStock', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidity object
     *
     * @param \Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidity|ObjectCollection $spyProductOfferValidity the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyProductOfferValidity($spyProductOfferValidity, ?string $comparison = null)
    {
        if ($spyProductOfferValidity instanceof \Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidity) {
            $this
                ->addUsingAlias(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER, $spyProductOfferValidity->getFkProductOffer(), $comparison);

            return $this;
        } elseif ($spyProductOfferValidity instanceof ObjectCollection) {
            $this
                ->useSpyProductOfferValidityQuery()
                ->filterByPrimaryKeys($spyProductOfferValidity->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyProductOfferValidity() only accepts arguments of type \Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidity or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyProductOfferValidity relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyProductOfferValidity(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyProductOfferValidity');

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
            $this->addJoinObject($join, 'SpyProductOfferValidity');
        }

        return $this;
    }

    /**
     * Use the SpyProductOfferValidity relation SpyProductOfferValidity object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery A secondary query class using the current class as primary query
     */
    public function useSpyProductOfferValidityQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyProductOfferValidity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyProductOfferValidity', '\Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery');
    }

    /**
     * Use the SpyProductOfferValidity relation SpyProductOfferValidity object
     *
     * @param callable(\Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery):\Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyProductOfferValidityQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyProductOfferValidityQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyProductOfferValidity table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery The inner query object of the EXISTS statement
     */
    public function useSpyProductOfferValidityExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery */
        $q = $this->useExistsQuery('SpyProductOfferValidity', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyProductOfferValidity table for a NOT EXISTS query.
     *
     * @see useSpyProductOfferValidityExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyProductOfferValidityNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery */
        $q = $this->useExistsQuery('SpyProductOfferValidity', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyProductOfferValidity table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery The inner query object of the IN statement
     */
    public function useInSpyProductOfferValidityQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery */
        $q = $this->useInQuery('SpyProductOfferValidity', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyProductOfferValidity table for a NOT IN query.
     *
     * @see useSpyProductOfferValidityInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyProductOfferValidityQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery */
        $q = $this->useInQuery('SpyProductOfferValidity', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related SpyStore object
     * using the spy_product_offer_store table as cross reference
     *
     * @param SpyStore $spyStore the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL and Criteria::IN for queries
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyStore($spyStore, string $comparison = null)
    {
        $this
            ->useSpyProductOfferStoreQuery()
            ->filterBySpyStore($spyStore, $comparison)
            ->endUse();

        return $this;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyProductOffer $spyProductOffer Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyProductOffer = null)
    {
        if ($spyProductOffer) {
            $this->addUsingAlias(SpyProductOfferTableMap::COL_ID_PRODUCT_OFFER, $spyProductOffer->getIdProductOffer(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_product_offer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOfferTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyProductOfferTableMap::clearInstancePool();
            SpyProductOfferTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOfferTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyProductOfferTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyProductOfferTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyProductOfferTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyProductOfferTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductOfferTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductOfferTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyProductOfferTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyProductOfferTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyProductOfferTableMap::COL_CREATED_AT);

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
