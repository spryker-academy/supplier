<?php

namespace Orm\Zed\ShoppingList\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNote;
use Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOption;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListItem as ChildSpyShoppingListItem;
use Orm\Zed\ShoppingList\Persistence\SpyShoppingListItemQuery as ChildSpyShoppingListItemQuery;
use Orm\Zed\ShoppingList\Persistence\Map\SpyShoppingListItemTableMap;
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
 * Base class that represents a query for the `spy_shopping_list_item` table.
 *
 * @method     ChildSpyShoppingListItemQuery orderByIdShoppingListItem($order = Criteria::ASC) Order by the id_shopping_list_item column
 * @method     ChildSpyShoppingListItemQuery orderByFkShoppingList($order = Criteria::ASC) Order by the fk_shopping_list column
 * @method     ChildSpyShoppingListItemQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method     ChildSpyShoppingListItemQuery orderByProductConfigurationInstanceData($order = Criteria::ASC) Order by the product_configuration_instance_data column
 * @method     ChildSpyShoppingListItemQuery orderByProductOfferReference($order = Criteria::ASC) Order by the product_offer_reference column
 * @method     ChildSpyShoppingListItemQuery orderByQuantity($order = Criteria::ASC) Order by the quantity column
 * @method     ChildSpyShoppingListItemQuery orderBySku($order = Criteria::ASC) Order by the sku column
 * @method     ChildSpyShoppingListItemQuery orderByUuid($order = Criteria::ASC) Order by the uuid column
 * @method     ChildSpyShoppingListItemQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyShoppingListItemQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyShoppingListItemQuery groupByIdShoppingListItem() Group by the id_shopping_list_item column
 * @method     ChildSpyShoppingListItemQuery groupByFkShoppingList() Group by the fk_shopping_list column
 * @method     ChildSpyShoppingListItemQuery groupByKey() Group by the key column
 * @method     ChildSpyShoppingListItemQuery groupByProductConfigurationInstanceData() Group by the product_configuration_instance_data column
 * @method     ChildSpyShoppingListItemQuery groupByProductOfferReference() Group by the product_offer_reference column
 * @method     ChildSpyShoppingListItemQuery groupByQuantity() Group by the quantity column
 * @method     ChildSpyShoppingListItemQuery groupBySku() Group by the sku column
 * @method     ChildSpyShoppingListItemQuery groupByUuid() Group by the uuid column
 * @method     ChildSpyShoppingListItemQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyShoppingListItemQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyShoppingListItemQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyShoppingListItemQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyShoppingListItemQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyShoppingListItemQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyShoppingListItemQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyShoppingListItemQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyShoppingListItemQuery leftJoinSpyShoppingList($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyShoppingList relation
 * @method     ChildSpyShoppingListItemQuery rightJoinSpyShoppingList($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyShoppingList relation
 * @method     ChildSpyShoppingListItemQuery innerJoinSpyShoppingList($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyShoppingList relation
 *
 * @method     ChildSpyShoppingListItemQuery joinWithSpyShoppingList($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyShoppingList relation
 *
 * @method     ChildSpyShoppingListItemQuery leftJoinWithSpyShoppingList() Adds a LEFT JOIN clause and with to the query using the SpyShoppingList relation
 * @method     ChildSpyShoppingListItemQuery rightJoinWithSpyShoppingList() Adds a RIGHT JOIN clause and with to the query using the SpyShoppingList relation
 * @method     ChildSpyShoppingListItemQuery innerJoinWithSpyShoppingList() Adds a INNER JOIN clause and with to the query using the SpyShoppingList relation
 *
 * @method     ChildSpyShoppingListItemQuery leftJoinSpyShoppingListItemNote($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyShoppingListItemNote relation
 * @method     ChildSpyShoppingListItemQuery rightJoinSpyShoppingListItemNote($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyShoppingListItemNote relation
 * @method     ChildSpyShoppingListItemQuery innerJoinSpyShoppingListItemNote($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyShoppingListItemNote relation
 *
 * @method     ChildSpyShoppingListItemQuery joinWithSpyShoppingListItemNote($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyShoppingListItemNote relation
 *
 * @method     ChildSpyShoppingListItemQuery leftJoinWithSpyShoppingListItemNote() Adds a LEFT JOIN clause and with to the query using the SpyShoppingListItemNote relation
 * @method     ChildSpyShoppingListItemQuery rightJoinWithSpyShoppingListItemNote() Adds a RIGHT JOIN clause and with to the query using the SpyShoppingListItemNote relation
 * @method     ChildSpyShoppingListItemQuery innerJoinWithSpyShoppingListItemNote() Adds a INNER JOIN clause and with to the query using the SpyShoppingListItemNote relation
 *
 * @method     ChildSpyShoppingListItemQuery leftJoinSpyShoppingListProductOption($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyShoppingListProductOption relation
 * @method     ChildSpyShoppingListItemQuery rightJoinSpyShoppingListProductOption($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyShoppingListProductOption relation
 * @method     ChildSpyShoppingListItemQuery innerJoinSpyShoppingListProductOption($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyShoppingListProductOption relation
 *
 * @method     ChildSpyShoppingListItemQuery joinWithSpyShoppingListProductOption($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyShoppingListProductOption relation
 *
 * @method     ChildSpyShoppingListItemQuery leftJoinWithSpyShoppingListProductOption() Adds a LEFT JOIN clause and with to the query using the SpyShoppingListProductOption relation
 * @method     ChildSpyShoppingListItemQuery rightJoinWithSpyShoppingListProductOption() Adds a RIGHT JOIN clause and with to the query using the SpyShoppingListProductOption relation
 * @method     ChildSpyShoppingListItemQuery innerJoinWithSpyShoppingListProductOption() Adds a INNER JOIN clause and with to the query using the SpyShoppingListProductOption relation
 *
 * @method     \Orm\Zed\ShoppingList\Persistence\SpyShoppingListQuery|\Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNoteQuery|\Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyShoppingListItem|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyShoppingListItem matching the query
 * @method     ChildSpyShoppingListItem findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyShoppingListItem matching the query, or a new ChildSpyShoppingListItem object populated from the query conditions when no match is found
 *
 * @method     ChildSpyShoppingListItem|null findOneByIdShoppingListItem(int $id_shopping_list_item) Return the first ChildSpyShoppingListItem filtered by the id_shopping_list_item column
 * @method     ChildSpyShoppingListItem|null findOneByFkShoppingList(int $fk_shopping_list) Return the first ChildSpyShoppingListItem filtered by the fk_shopping_list column
 * @method     ChildSpyShoppingListItem|null findOneByKey(string $key) Return the first ChildSpyShoppingListItem filtered by the key column
 * @method     ChildSpyShoppingListItem|null findOneByProductConfigurationInstanceData(string $product_configuration_instance_data) Return the first ChildSpyShoppingListItem filtered by the product_configuration_instance_data column
 * @method     ChildSpyShoppingListItem|null findOneByProductOfferReference(string $product_offer_reference) Return the first ChildSpyShoppingListItem filtered by the product_offer_reference column
 * @method     ChildSpyShoppingListItem|null findOneByQuantity(int $quantity) Return the first ChildSpyShoppingListItem filtered by the quantity column
 * @method     ChildSpyShoppingListItem|null findOneBySku(string $sku) Return the first ChildSpyShoppingListItem filtered by the sku column
 * @method     ChildSpyShoppingListItem|null findOneByUuid(string $uuid) Return the first ChildSpyShoppingListItem filtered by the uuid column
 * @method     ChildSpyShoppingListItem|null findOneByCreatedAt(string $created_at) Return the first ChildSpyShoppingListItem filtered by the created_at column
 * @method     ChildSpyShoppingListItem|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyShoppingListItem filtered by the updated_at column
 *
 * @method     ChildSpyShoppingListItem requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyShoppingListItem by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShoppingListItem requireOne(?ConnectionInterface $con = null) Return the first ChildSpyShoppingListItem matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyShoppingListItem requireOneByIdShoppingListItem(int $id_shopping_list_item) Return the first ChildSpyShoppingListItem filtered by the id_shopping_list_item column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShoppingListItem requireOneByFkShoppingList(int $fk_shopping_list) Return the first ChildSpyShoppingListItem filtered by the fk_shopping_list column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShoppingListItem requireOneByKey(string $key) Return the first ChildSpyShoppingListItem filtered by the key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShoppingListItem requireOneByProductConfigurationInstanceData(string $product_configuration_instance_data) Return the first ChildSpyShoppingListItem filtered by the product_configuration_instance_data column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShoppingListItem requireOneByProductOfferReference(string $product_offer_reference) Return the first ChildSpyShoppingListItem filtered by the product_offer_reference column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShoppingListItem requireOneByQuantity(int $quantity) Return the first ChildSpyShoppingListItem filtered by the quantity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShoppingListItem requireOneBySku(string $sku) Return the first ChildSpyShoppingListItem filtered by the sku column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShoppingListItem requireOneByUuid(string $uuid) Return the first ChildSpyShoppingListItem filtered by the uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShoppingListItem requireOneByCreatedAt(string $created_at) Return the first ChildSpyShoppingListItem filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyShoppingListItem requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyShoppingListItem filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyShoppingListItem[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyShoppingListItem objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyShoppingListItem> find(?ConnectionInterface $con = null) Return ChildSpyShoppingListItem objects based on current ModelCriteria
 *
 * @method     ChildSpyShoppingListItem[]|Collection findByIdShoppingListItem(int|array<int> $id_shopping_list_item) Return ChildSpyShoppingListItem objects filtered by the id_shopping_list_item column
 * @psalm-method Collection&\Traversable<ChildSpyShoppingListItem> findByIdShoppingListItem(int|array<int> $id_shopping_list_item) Return ChildSpyShoppingListItem objects filtered by the id_shopping_list_item column
 * @method     ChildSpyShoppingListItem[]|Collection findByFkShoppingList(int|array<int> $fk_shopping_list) Return ChildSpyShoppingListItem objects filtered by the fk_shopping_list column
 * @psalm-method Collection&\Traversable<ChildSpyShoppingListItem> findByFkShoppingList(int|array<int> $fk_shopping_list) Return ChildSpyShoppingListItem objects filtered by the fk_shopping_list column
 * @method     ChildSpyShoppingListItem[]|Collection findByKey(string|array<string> $key) Return ChildSpyShoppingListItem objects filtered by the key column
 * @psalm-method Collection&\Traversable<ChildSpyShoppingListItem> findByKey(string|array<string> $key) Return ChildSpyShoppingListItem objects filtered by the key column
 * @method     ChildSpyShoppingListItem[]|Collection findByProductConfigurationInstanceData(string|array<string> $product_configuration_instance_data) Return ChildSpyShoppingListItem objects filtered by the product_configuration_instance_data column
 * @psalm-method Collection&\Traversable<ChildSpyShoppingListItem> findByProductConfigurationInstanceData(string|array<string> $product_configuration_instance_data) Return ChildSpyShoppingListItem objects filtered by the product_configuration_instance_data column
 * @method     ChildSpyShoppingListItem[]|Collection findByProductOfferReference(string|array<string> $product_offer_reference) Return ChildSpyShoppingListItem objects filtered by the product_offer_reference column
 * @psalm-method Collection&\Traversable<ChildSpyShoppingListItem> findByProductOfferReference(string|array<string> $product_offer_reference) Return ChildSpyShoppingListItem objects filtered by the product_offer_reference column
 * @method     ChildSpyShoppingListItem[]|Collection findByQuantity(int|array<int> $quantity) Return ChildSpyShoppingListItem objects filtered by the quantity column
 * @psalm-method Collection&\Traversable<ChildSpyShoppingListItem> findByQuantity(int|array<int> $quantity) Return ChildSpyShoppingListItem objects filtered by the quantity column
 * @method     ChildSpyShoppingListItem[]|Collection findBySku(string|array<string> $sku) Return ChildSpyShoppingListItem objects filtered by the sku column
 * @psalm-method Collection&\Traversable<ChildSpyShoppingListItem> findBySku(string|array<string> $sku) Return ChildSpyShoppingListItem objects filtered by the sku column
 * @method     ChildSpyShoppingListItem[]|Collection findByUuid(string|array<string> $uuid) Return ChildSpyShoppingListItem objects filtered by the uuid column
 * @psalm-method Collection&\Traversable<ChildSpyShoppingListItem> findByUuid(string|array<string> $uuid) Return ChildSpyShoppingListItem objects filtered by the uuid column
 * @method     ChildSpyShoppingListItem[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyShoppingListItem objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyShoppingListItem> findByCreatedAt(string|array<string> $created_at) Return ChildSpyShoppingListItem objects filtered by the created_at column
 * @method     ChildSpyShoppingListItem[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyShoppingListItem objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyShoppingListItem> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyShoppingListItem objects filtered by the updated_at column
 *
 * @method     ChildSpyShoppingListItem[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyShoppingListItem> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyShoppingListItemQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\ShoppingList\Persistence\Base\SpyShoppingListItemQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListItem', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyShoppingListItemQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyShoppingListItemQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyShoppingListItemQuery) {
            return $criteria;
        }
        $query = new ChildSpyShoppingListItemQuery();
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
     * @return ChildSpyShoppingListItem|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyShoppingListItemTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyShoppingListItem A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_shopping_list_item`, `fk_shopping_list`, `key`, `product_configuration_instance_data`, `product_offer_reference`, `quantity`, `sku`, `uuid`, `created_at`, `updated_at` FROM `spy_shopping_list_item` WHERE `id_shopping_list_item` = :p0';
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
            /** @var ChildSpyShoppingListItem $obj */
            $obj = new ChildSpyShoppingListItem();
            $obj->hydrate($row);
            SpyShoppingListItemTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyShoppingListItem|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyShoppingListItemTableMap::COL_ID_SHOPPING_LIST_ITEM, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyShoppingListItemTableMap::COL_ID_SHOPPING_LIST_ITEM, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idShoppingListItem Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdShoppingListItem_Between(array $idShoppingListItem)
    {
        return $this->filterByIdShoppingListItem($idShoppingListItem, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idShoppingListItems Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdShoppingListItem_In(array $idShoppingListItems)
    {
        return $this->filterByIdShoppingListItem($idShoppingListItems, Criteria::IN);
    }

    /**
     * Filter the query on the id_shopping_list_item column
     *
     * Example usage:
     * <code>
     * $query->filterByIdShoppingListItem(1234); // WHERE id_shopping_list_item = 1234
     * $query->filterByIdShoppingListItem(array(12, 34), Criteria::IN); // WHERE id_shopping_list_item IN (12, 34)
     * $query->filterByIdShoppingListItem(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_shopping_list_item > 12
     * </code>
     *
     * @param     mixed $idShoppingListItem The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdShoppingListItem($idShoppingListItem = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idShoppingListItem)) {
            $useMinMax = false;
            if (isset($idShoppingListItem['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShoppingListItemTableMap::COL_ID_SHOPPING_LIST_ITEM, $idShoppingListItem['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idShoppingListItem['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShoppingListItemTableMap::COL_ID_SHOPPING_LIST_ITEM, $idShoppingListItem['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idShoppingListItem of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyShoppingListItemTableMap::COL_ID_SHOPPING_LIST_ITEM, $idShoppingListItem, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkShoppingList Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkShoppingList_Between(array $fkShoppingList)
    {
        return $this->filterByFkShoppingList($fkShoppingList, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkShoppingLists Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkShoppingList_In(array $fkShoppingLists)
    {
        return $this->filterByFkShoppingList($fkShoppingLists, Criteria::IN);
    }

    /**
     * Filter the query on the fk_shopping_list column
     *
     * Example usage:
     * <code>
     * $query->filterByFkShoppingList(1234); // WHERE fk_shopping_list = 1234
     * $query->filterByFkShoppingList(array(12, 34), Criteria::IN); // WHERE fk_shopping_list IN (12, 34)
     * $query->filterByFkShoppingList(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_shopping_list > 12
     * </code>
     *
     * @see       filterBySpyShoppingList()
     *
     * @param     mixed $fkShoppingList The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkShoppingList($fkShoppingList = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkShoppingList)) {
            $useMinMax = false;
            if (isset($fkShoppingList['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShoppingListItemTableMap::COL_FK_SHOPPING_LIST, $fkShoppingList['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkShoppingList['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShoppingListItemTableMap::COL_FK_SHOPPING_LIST, $fkShoppingList['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkShoppingList of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyShoppingListItemTableMap::COL_FK_SHOPPING_LIST, $fkShoppingList, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $keys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByKey_In(array $keys)
    {
        return $this->filterByKey($keys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $key Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByKey_Like($key)
    {
        return $this->filterByKey($key, Criteria::LIKE);
    }

    /**
     * Filter the query on the key column
     *
     * Example usage:
     * <code>
     * $query->filterByKey('fooValue');   // WHERE key = 'fooValue'
     * $query->filterByKey('%fooValue%', Criteria::LIKE); // WHERE key LIKE '%fooValue%'
     * $query->filterByKey([1, 'foo'], Criteria::IN); // WHERE key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $key The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByKey($key = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $key = str_replace('*', '%', $key);
        }

        if (is_array($key) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$key of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyShoppingListItemTableMap::COL_KEY, $key, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $productConfigurationInstanceDatas Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductConfigurationInstanceData_In(array $productConfigurationInstanceDatas)
    {
        return $this->filterByProductConfigurationInstanceData($productConfigurationInstanceDatas, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $productConfigurationInstanceData Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByProductConfigurationInstanceData_Like($productConfigurationInstanceData)
    {
        return $this->filterByProductConfigurationInstanceData($productConfigurationInstanceData, Criteria::LIKE);
    }

    /**
     * Filter the query on the product_configuration_instance_data column
     *
     * Example usage:
     * <code>
     * $query->filterByProductConfigurationInstanceData('fooValue');   // WHERE product_configuration_instance_data = 'fooValue'
     * $query->filterByProductConfigurationInstanceData('%fooValue%', Criteria::LIKE); // WHERE product_configuration_instance_data LIKE '%fooValue%'
     * $query->filterByProductConfigurationInstanceData([1, 'foo'], Criteria::IN); // WHERE product_configuration_instance_data IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $productConfigurationInstanceData The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByProductConfigurationInstanceData($productConfigurationInstanceData = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $productConfigurationInstanceData = str_replace('*', '%', $productConfigurationInstanceData);
        }

        if (is_array($productConfigurationInstanceData) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$productConfigurationInstanceData of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyShoppingListItemTableMap::COL_PRODUCT_CONFIGURATION_INSTANCE_DATA, $productConfigurationInstanceData, $comparison);

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

        $query = $this->addUsingAlias(SpyShoppingListItemTableMap::COL_PRODUCT_OFFER_REFERENCE, $productOfferReference, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $quantity Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuantity_Between(array $quantity)
    {
        return $this->filterByQuantity($quantity, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $quantitys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByQuantity_In(array $quantitys)
    {
        return $this->filterByQuantity($quantitys, Criteria::IN);
    }

    /**
     * Filter the query on the quantity column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantity(1234); // WHERE quantity = 1234
     * $query->filterByQuantity(array(12, 34), Criteria::IN); // WHERE quantity IN (12, 34)
     * $query->filterByQuantity(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE quantity > 12
     * </code>
     *
     * @param     mixed $quantity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByQuantity($quantity = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($quantity)) {
            $useMinMax = false;
            if (isset($quantity['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShoppingListItemTableMap::COL_QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantity['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShoppingListItemTableMap::COL_QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$quantity of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyShoppingListItemTableMap::COL_QUANTITY, $quantity, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $skus Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySku_In(array $skus)
    {
        return $this->filterBySku($skus, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $sku Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySku_Like($sku)
    {
        return $this->filterBySku($sku, Criteria::LIKE);
    }

    /**
     * Filter the query on the sku column
     *
     * Example usage:
     * <code>
     * $query->filterBySku('fooValue');   // WHERE sku = 'fooValue'
     * $query->filterBySku('%fooValue%', Criteria::LIKE); // WHERE sku LIKE '%fooValue%'
     * $query->filterBySku([1, 'foo'], Criteria::IN); // WHERE sku IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $sku The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterBySku($sku = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $sku = str_replace('*', '%', $sku);
        }

        if (is_array($sku) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$sku of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyShoppingListItemTableMap::COL_SKU, $sku, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $uuids Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUuid_In(array $uuids)
    {
        return $this->filterByUuid($uuids, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $uuid Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUuid_Like($uuid)
    {
        return $this->filterByUuid($uuid, Criteria::LIKE);
    }

    /**
     * Filter the query on the uuid column
     *
     * Example usage:
     * <code>
     * $query->filterByUuid('fooValue');   // WHERE uuid = 'fooValue'
     * $query->filterByUuid('%fooValue%', Criteria::LIKE); // WHERE uuid LIKE '%fooValue%'
     * $query->filterByUuid([1, 'foo'], Criteria::IN); // WHERE uuid IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $uuid The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByUuid($uuid = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $uuid = str_replace('*', '%', $uuid);
        }

        if (is_array($uuid) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$uuid of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyShoppingListItemTableMap::COL_UUID, $uuid, $comparison);

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
                $this->addUsingAlias(SpyShoppingListItemTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShoppingListItemTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyShoppingListItemTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyShoppingListItemTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyShoppingListItemTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyShoppingListItemTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\ShoppingList\Persistence\SpyShoppingList object
     *
     * @param \Orm\Zed\ShoppingList\Persistence\SpyShoppingList|ObjectCollection $spyShoppingList The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyShoppingList($spyShoppingList, ?string $comparison = null)
    {
        if ($spyShoppingList instanceof \Orm\Zed\ShoppingList\Persistence\SpyShoppingList) {
            return $this
                ->addUsingAlias(SpyShoppingListItemTableMap::COL_FK_SHOPPING_LIST, $spyShoppingList->getIdShoppingList(), $comparison);
        } elseif ($spyShoppingList instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyShoppingListItemTableMap::COL_FK_SHOPPING_LIST, $spyShoppingList->toKeyValue('PrimaryKey', 'IdShoppingList'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySpyShoppingList() only accepts arguments of type \Orm\Zed\ShoppingList\Persistence\SpyShoppingList or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyShoppingList relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyShoppingList(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyShoppingList');

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
            $this->addJoinObject($join, 'SpyShoppingList');
        }

        return $this;
    }

    /**
     * Use the SpyShoppingList relation SpyShoppingList object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListQuery A secondary query class using the current class as primary query
     */
    public function useSpyShoppingListQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyShoppingList($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyShoppingList', '\Orm\Zed\ShoppingList\Persistence\SpyShoppingListQuery');
    }

    /**
     * Use the SpyShoppingList relation SpyShoppingList object
     *
     * @param callable(\Orm\Zed\ShoppingList\Persistence\SpyShoppingListQuery):\Orm\Zed\ShoppingList\Persistence\SpyShoppingListQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyShoppingListQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyShoppingListQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyShoppingList table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListQuery The inner query object of the EXISTS statement
     */
    public function useSpyShoppingListExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListQuery */
        $q = $this->useExistsQuery('SpyShoppingList', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyShoppingList table for a NOT EXISTS query.
     *
     * @see useSpyShoppingListExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyShoppingListNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListQuery */
        $q = $this->useExistsQuery('SpyShoppingList', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyShoppingList table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListQuery The inner query object of the IN statement
     */
    public function useInSpyShoppingListQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListQuery */
        $q = $this->useInQuery('SpyShoppingList', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyShoppingList table for a NOT IN query.
     *
     * @see useSpyShoppingListInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShoppingList\Persistence\SpyShoppingListQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyShoppingListQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShoppingList\Persistence\SpyShoppingListQuery */
        $q = $this->useInQuery('SpyShoppingList', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNote object
     *
     * @param \Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNote|ObjectCollection $spyShoppingListItemNote the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyShoppingListItemNote($spyShoppingListItemNote, ?string $comparison = null)
    {
        if ($spyShoppingListItemNote instanceof \Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNote) {
            $this
                ->addUsingAlias(SpyShoppingListItemTableMap::COL_ID_SHOPPING_LIST_ITEM, $spyShoppingListItemNote->getFkShoppingListItem(), $comparison);

            return $this;
        } elseif ($spyShoppingListItemNote instanceof ObjectCollection) {
            $this
                ->useSpyShoppingListItemNoteQuery()
                ->filterByPrimaryKeys($spyShoppingListItemNote->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyShoppingListItemNote() only accepts arguments of type \Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNote or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyShoppingListItemNote relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyShoppingListItemNote(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyShoppingListItemNote');

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
            $this->addJoinObject($join, 'SpyShoppingListItemNote');
        }

        return $this;
    }

    /**
     * Use the SpyShoppingListItemNote relation SpyShoppingListItemNote object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNoteQuery A secondary query class using the current class as primary query
     */
    public function useSpyShoppingListItemNoteQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyShoppingListItemNote($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyShoppingListItemNote', '\Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNoteQuery');
    }

    /**
     * Use the SpyShoppingListItemNote relation SpyShoppingListItemNote object
     *
     * @param callable(\Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNoteQuery):\Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNoteQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyShoppingListItemNoteQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyShoppingListItemNoteQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyShoppingListItemNote table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNoteQuery The inner query object of the EXISTS statement
     */
    public function useSpyShoppingListItemNoteExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNoteQuery */
        $q = $this->useExistsQuery('SpyShoppingListItemNote', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListItemNote table for a NOT EXISTS query.
     *
     * @see useSpyShoppingListItemNoteExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNoteQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyShoppingListItemNoteNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNoteQuery */
        $q = $this->useExistsQuery('SpyShoppingListItemNote', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListItemNote table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNoteQuery The inner query object of the IN statement
     */
    public function useInSpyShoppingListItemNoteQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNoteQuery */
        $q = $this->useInQuery('SpyShoppingListItemNote', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListItemNote table for a NOT IN query.
     *
     * @see useSpyShoppingListItemNoteInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNoteQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyShoppingListItemNoteQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNoteQuery */
        $q = $this->useInQuery('SpyShoppingListItemNote', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOption object
     *
     * @param \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOption|ObjectCollection $spyShoppingListProductOption the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyShoppingListProductOption($spyShoppingListProductOption, ?string $comparison = null)
    {
        if ($spyShoppingListProductOption instanceof \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOption) {
            $this
                ->addUsingAlias(SpyShoppingListItemTableMap::COL_ID_SHOPPING_LIST_ITEM, $spyShoppingListProductOption->getFkShoppingListItem(), $comparison);

            return $this;
        } elseif ($spyShoppingListProductOption instanceof ObjectCollection) {
            $this
                ->useSpyShoppingListProductOptionQuery()
                ->filterByPrimaryKeys($spyShoppingListProductOption->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyShoppingListProductOption() only accepts arguments of type \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOption or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyShoppingListProductOption relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyShoppingListProductOption(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyShoppingListProductOption');

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
            $this->addJoinObject($join, 'SpyShoppingListProductOption');
        }

        return $this;
    }

    /**
     * Use the SpyShoppingListProductOption relation SpyShoppingListProductOption object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery A secondary query class using the current class as primary query
     */
    public function useSpyShoppingListProductOptionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyShoppingListProductOption($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyShoppingListProductOption', '\Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery');
    }

    /**
     * Use the SpyShoppingListProductOption relation SpyShoppingListProductOption object
     *
     * @param callable(\Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery):\Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyShoppingListProductOptionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyShoppingListProductOptionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyShoppingListProductOption table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery The inner query object of the EXISTS statement
     */
    public function useSpyShoppingListProductOptionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery */
        $q = $this->useExistsQuery('SpyShoppingListProductOption', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListProductOption table for a NOT EXISTS query.
     *
     * @see useSpyShoppingListProductOptionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyShoppingListProductOptionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery */
        $q = $this->useExistsQuery('SpyShoppingListProductOption', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListProductOption table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery The inner query object of the IN statement
     */
    public function useInSpyShoppingListProductOptionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery */
        $q = $this->useInQuery('SpyShoppingListProductOption', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyShoppingListProductOption table for a NOT IN query.
     *
     * @see useSpyShoppingListProductOptionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyShoppingListProductOptionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\ShoppingListProductOptionConnector\Persistence\SpyShoppingListProductOptionQuery */
        $q = $this->useInQuery('SpyShoppingListProductOption', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyShoppingListItem $spyShoppingListItem Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyShoppingListItem = null)
    {
        if ($spyShoppingListItem) {
            $this->addUsingAlias(SpyShoppingListItemTableMap::COL_ID_SHOPPING_LIST_ITEM, $spyShoppingListItem->getIdShoppingListItem(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_shopping_list_item table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListItemTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyShoppingListItemTableMap::clearInstancePool();
            SpyShoppingListItemTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListItemTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyShoppingListItemTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyShoppingListItemTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyShoppingListItemTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyShoppingListItemTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyShoppingListItemTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyShoppingListItemTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyShoppingListItemTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyShoppingListItemTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyShoppingListItemTableMap::COL_CREATED_AT);

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
