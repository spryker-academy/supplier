<?php

namespace Orm\Zed\MerchantCommission\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommission as ChildSpyMerchantCommission;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionQuery as ChildSpyMerchantCommissionQuery;
use Orm\Zed\MerchantCommission\Persistence\Map\SpyMerchantCommissionTableMap;
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
 * Base class that represents a query for the `spy_merchant_commission` table.
 *
 * @method     ChildSpyMerchantCommissionQuery orderByIdMerchantCommission($order = Criteria::ASC) Order by the id_merchant_commission column
 * @method     ChildSpyMerchantCommissionQuery orderByFkMerchantCommissionGroup($order = Criteria::ASC) Order by the fk_merchant_commission_group column
 * @method     ChildSpyMerchantCommissionQuery orderByUuid($order = Criteria::ASC) Order by the uuid column
 * @method     ChildSpyMerchantCommissionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildSpyMerchantCommissionQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildSpyMerchantCommissionQuery orderByKey($order = Criteria::ASC) Order by the key column
 * @method     ChildSpyMerchantCommissionQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildSpyMerchantCommissionQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyMerchantCommissionQuery orderByValidFrom($order = Criteria::ASC) Order by the valid_from column
 * @method     ChildSpyMerchantCommissionQuery orderByValidTo($order = Criteria::ASC) Order by the valid_to column
 * @method     ChildSpyMerchantCommissionQuery orderByPriority($order = Criteria::ASC) Order by the priority column
 * @method     ChildSpyMerchantCommissionQuery orderByItemCondition($order = Criteria::ASC) Order by the item_condition column
 * @method     ChildSpyMerchantCommissionQuery orderByOrderCondition($order = Criteria::ASC) Order by the order_condition column
 * @method     ChildSpyMerchantCommissionQuery orderByCalculatorTypePlugin($order = Criteria::ASC) Order by the calculator_type_plugin column
 * @method     ChildSpyMerchantCommissionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyMerchantCommissionQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyMerchantCommissionQuery groupByIdMerchantCommission() Group by the id_merchant_commission column
 * @method     ChildSpyMerchantCommissionQuery groupByFkMerchantCommissionGroup() Group by the fk_merchant_commission_group column
 * @method     ChildSpyMerchantCommissionQuery groupByUuid() Group by the uuid column
 * @method     ChildSpyMerchantCommissionQuery groupByName() Group by the name column
 * @method     ChildSpyMerchantCommissionQuery groupByDescription() Group by the description column
 * @method     ChildSpyMerchantCommissionQuery groupByKey() Group by the key column
 * @method     ChildSpyMerchantCommissionQuery groupByAmount() Group by the amount column
 * @method     ChildSpyMerchantCommissionQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyMerchantCommissionQuery groupByValidFrom() Group by the valid_from column
 * @method     ChildSpyMerchantCommissionQuery groupByValidTo() Group by the valid_to column
 * @method     ChildSpyMerchantCommissionQuery groupByPriority() Group by the priority column
 * @method     ChildSpyMerchantCommissionQuery groupByItemCondition() Group by the item_condition column
 * @method     ChildSpyMerchantCommissionQuery groupByOrderCondition() Group by the order_condition column
 * @method     ChildSpyMerchantCommissionQuery groupByCalculatorTypePlugin() Group by the calculator_type_plugin column
 * @method     ChildSpyMerchantCommissionQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyMerchantCommissionQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyMerchantCommissionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyMerchantCommissionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyMerchantCommissionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyMerchantCommissionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyMerchantCommissionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyMerchantCommissionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyMerchantCommissionQuery leftJoinMerchantCommissionGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the MerchantCommissionGroup relation
 * @method     ChildSpyMerchantCommissionQuery rightJoinMerchantCommissionGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MerchantCommissionGroup relation
 * @method     ChildSpyMerchantCommissionQuery innerJoinMerchantCommissionGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the MerchantCommissionGroup relation
 *
 * @method     ChildSpyMerchantCommissionQuery joinWithMerchantCommissionGroup($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MerchantCommissionGroup relation
 *
 * @method     ChildSpyMerchantCommissionQuery leftJoinWithMerchantCommissionGroup() Adds a LEFT JOIN clause and with to the query using the MerchantCommissionGroup relation
 * @method     ChildSpyMerchantCommissionQuery rightJoinWithMerchantCommissionGroup() Adds a RIGHT JOIN clause and with to the query using the MerchantCommissionGroup relation
 * @method     ChildSpyMerchantCommissionQuery innerJoinWithMerchantCommissionGroup() Adds a INNER JOIN clause and with to the query using the MerchantCommissionGroup relation
 *
 * @method     ChildSpyMerchantCommissionQuery leftJoinMerchantCommissionAmount($relationAlias = null) Adds a LEFT JOIN clause to the query using the MerchantCommissionAmount relation
 * @method     ChildSpyMerchantCommissionQuery rightJoinMerchantCommissionAmount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MerchantCommissionAmount relation
 * @method     ChildSpyMerchantCommissionQuery innerJoinMerchantCommissionAmount($relationAlias = null) Adds a INNER JOIN clause to the query using the MerchantCommissionAmount relation
 *
 * @method     ChildSpyMerchantCommissionQuery joinWithMerchantCommissionAmount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MerchantCommissionAmount relation
 *
 * @method     ChildSpyMerchantCommissionQuery leftJoinWithMerchantCommissionAmount() Adds a LEFT JOIN clause and with to the query using the MerchantCommissionAmount relation
 * @method     ChildSpyMerchantCommissionQuery rightJoinWithMerchantCommissionAmount() Adds a RIGHT JOIN clause and with to the query using the MerchantCommissionAmount relation
 * @method     ChildSpyMerchantCommissionQuery innerJoinWithMerchantCommissionAmount() Adds a INNER JOIN clause and with to the query using the MerchantCommissionAmount relation
 *
 * @method     ChildSpyMerchantCommissionQuery leftJoinMerchantCommissionStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the MerchantCommissionStore relation
 * @method     ChildSpyMerchantCommissionQuery rightJoinMerchantCommissionStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MerchantCommissionStore relation
 * @method     ChildSpyMerchantCommissionQuery innerJoinMerchantCommissionStore($relationAlias = null) Adds a INNER JOIN clause to the query using the MerchantCommissionStore relation
 *
 * @method     ChildSpyMerchantCommissionQuery joinWithMerchantCommissionStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MerchantCommissionStore relation
 *
 * @method     ChildSpyMerchantCommissionQuery leftJoinWithMerchantCommissionStore() Adds a LEFT JOIN clause and with to the query using the MerchantCommissionStore relation
 * @method     ChildSpyMerchantCommissionQuery rightJoinWithMerchantCommissionStore() Adds a RIGHT JOIN clause and with to the query using the MerchantCommissionStore relation
 * @method     ChildSpyMerchantCommissionQuery innerJoinWithMerchantCommissionStore() Adds a INNER JOIN clause and with to the query using the MerchantCommissionStore relation
 *
 * @method     ChildSpyMerchantCommissionQuery leftJoinMerchantCommissionMerchant($relationAlias = null) Adds a LEFT JOIN clause to the query using the MerchantCommissionMerchant relation
 * @method     ChildSpyMerchantCommissionQuery rightJoinMerchantCommissionMerchant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MerchantCommissionMerchant relation
 * @method     ChildSpyMerchantCommissionQuery innerJoinMerchantCommissionMerchant($relationAlias = null) Adds a INNER JOIN clause to the query using the MerchantCommissionMerchant relation
 *
 * @method     ChildSpyMerchantCommissionQuery joinWithMerchantCommissionMerchant($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the MerchantCommissionMerchant relation
 *
 * @method     ChildSpyMerchantCommissionQuery leftJoinWithMerchantCommissionMerchant() Adds a LEFT JOIN clause and with to the query using the MerchantCommissionMerchant relation
 * @method     ChildSpyMerchantCommissionQuery rightJoinWithMerchantCommissionMerchant() Adds a RIGHT JOIN clause and with to the query using the MerchantCommissionMerchant relation
 * @method     ChildSpyMerchantCommissionQuery innerJoinWithMerchantCommissionMerchant() Adds a INNER JOIN clause and with to the query using the MerchantCommissionMerchant relation
 *
 * @method     \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroupQuery|\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmountQuery|\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery|\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyMerchantCommission|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyMerchantCommission matching the query
 * @method     ChildSpyMerchantCommission findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyMerchantCommission matching the query, or a new ChildSpyMerchantCommission object populated from the query conditions when no match is found
 *
 * @method     ChildSpyMerchantCommission|null findOneByIdMerchantCommission(int $id_merchant_commission) Return the first ChildSpyMerchantCommission filtered by the id_merchant_commission column
 * @method     ChildSpyMerchantCommission|null findOneByFkMerchantCommissionGroup(int $fk_merchant_commission_group) Return the first ChildSpyMerchantCommission filtered by the fk_merchant_commission_group column
 * @method     ChildSpyMerchantCommission|null findOneByUuid(string $uuid) Return the first ChildSpyMerchantCommission filtered by the uuid column
 * @method     ChildSpyMerchantCommission|null findOneByName(string $name) Return the first ChildSpyMerchantCommission filtered by the name column
 * @method     ChildSpyMerchantCommission|null findOneByDescription(string $description) Return the first ChildSpyMerchantCommission filtered by the description column
 * @method     ChildSpyMerchantCommission|null findOneByKey(string $key) Return the first ChildSpyMerchantCommission filtered by the key column
 * @method     ChildSpyMerchantCommission|null findOneByAmount(int $amount) Return the first ChildSpyMerchantCommission filtered by the amount column
 * @method     ChildSpyMerchantCommission|null findOneByIsActive(boolean $is_active) Return the first ChildSpyMerchantCommission filtered by the is_active column
 * @method     ChildSpyMerchantCommission|null findOneByValidFrom(string $valid_from) Return the first ChildSpyMerchantCommission filtered by the valid_from column
 * @method     ChildSpyMerchantCommission|null findOneByValidTo(string $valid_to) Return the first ChildSpyMerchantCommission filtered by the valid_to column
 * @method     ChildSpyMerchantCommission|null findOneByPriority(int $priority) Return the first ChildSpyMerchantCommission filtered by the priority column
 * @method     ChildSpyMerchantCommission|null findOneByItemCondition(string $item_condition) Return the first ChildSpyMerchantCommission filtered by the item_condition column
 * @method     ChildSpyMerchantCommission|null findOneByOrderCondition(string $order_condition) Return the first ChildSpyMerchantCommission filtered by the order_condition column
 * @method     ChildSpyMerchantCommission|null findOneByCalculatorTypePlugin(string $calculator_type_plugin) Return the first ChildSpyMerchantCommission filtered by the calculator_type_plugin column
 * @method     ChildSpyMerchantCommission|null findOneByCreatedAt(string $created_at) Return the first ChildSpyMerchantCommission filtered by the created_at column
 * @method     ChildSpyMerchantCommission|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyMerchantCommission filtered by the updated_at column
 *
 * @method     ChildSpyMerchantCommission requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyMerchantCommission by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommission requireOne(?ConnectionInterface $con = null) Return the first ChildSpyMerchantCommission matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyMerchantCommission requireOneByIdMerchantCommission(int $id_merchant_commission) Return the first ChildSpyMerchantCommission filtered by the id_merchant_commission column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommission requireOneByFkMerchantCommissionGroup(int $fk_merchant_commission_group) Return the first ChildSpyMerchantCommission filtered by the fk_merchant_commission_group column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommission requireOneByUuid(string $uuid) Return the first ChildSpyMerchantCommission filtered by the uuid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommission requireOneByName(string $name) Return the first ChildSpyMerchantCommission filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommission requireOneByDescription(string $description) Return the first ChildSpyMerchantCommission filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommission requireOneByKey(string $key) Return the first ChildSpyMerchantCommission filtered by the key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommission requireOneByAmount(int $amount) Return the first ChildSpyMerchantCommission filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommission requireOneByIsActive(boolean $is_active) Return the first ChildSpyMerchantCommission filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommission requireOneByValidFrom(string $valid_from) Return the first ChildSpyMerchantCommission filtered by the valid_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommission requireOneByValidTo(string $valid_to) Return the first ChildSpyMerchantCommission filtered by the valid_to column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommission requireOneByPriority(int $priority) Return the first ChildSpyMerchantCommission filtered by the priority column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommission requireOneByItemCondition(string $item_condition) Return the first ChildSpyMerchantCommission filtered by the item_condition column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommission requireOneByOrderCondition(string $order_condition) Return the first ChildSpyMerchantCommission filtered by the order_condition column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommission requireOneByCalculatorTypePlugin(string $calculator_type_plugin) Return the first ChildSpyMerchantCommission filtered by the calculator_type_plugin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommission requireOneByCreatedAt(string $created_at) Return the first ChildSpyMerchantCommission filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyMerchantCommission requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyMerchantCommission filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyMerchantCommission[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyMerchantCommission objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommission> find(?ConnectionInterface $con = null) Return ChildSpyMerchantCommission objects based on current ModelCriteria
 *
 * @method     ChildSpyMerchantCommission[]|Collection findByIdMerchantCommission(int|array<int> $id_merchant_commission) Return ChildSpyMerchantCommission objects filtered by the id_merchant_commission column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommission> findByIdMerchantCommission(int|array<int> $id_merchant_commission) Return ChildSpyMerchantCommission objects filtered by the id_merchant_commission column
 * @method     ChildSpyMerchantCommission[]|Collection findByFkMerchantCommissionGroup(int|array<int> $fk_merchant_commission_group) Return ChildSpyMerchantCommission objects filtered by the fk_merchant_commission_group column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommission> findByFkMerchantCommissionGroup(int|array<int> $fk_merchant_commission_group) Return ChildSpyMerchantCommission objects filtered by the fk_merchant_commission_group column
 * @method     ChildSpyMerchantCommission[]|Collection findByUuid(string|array<string> $uuid) Return ChildSpyMerchantCommission objects filtered by the uuid column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommission> findByUuid(string|array<string> $uuid) Return ChildSpyMerchantCommission objects filtered by the uuid column
 * @method     ChildSpyMerchantCommission[]|Collection findByName(string|array<string> $name) Return ChildSpyMerchantCommission objects filtered by the name column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommission> findByName(string|array<string> $name) Return ChildSpyMerchantCommission objects filtered by the name column
 * @method     ChildSpyMerchantCommission[]|Collection findByDescription(string|array<string> $description) Return ChildSpyMerchantCommission objects filtered by the description column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommission> findByDescription(string|array<string> $description) Return ChildSpyMerchantCommission objects filtered by the description column
 * @method     ChildSpyMerchantCommission[]|Collection findByKey(string|array<string> $key) Return ChildSpyMerchantCommission objects filtered by the key column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommission> findByKey(string|array<string> $key) Return ChildSpyMerchantCommission objects filtered by the key column
 * @method     ChildSpyMerchantCommission[]|Collection findByAmount(int|array<int> $amount) Return ChildSpyMerchantCommission objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommission> findByAmount(int|array<int> $amount) Return ChildSpyMerchantCommission objects filtered by the amount column
 * @method     ChildSpyMerchantCommission[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyMerchantCommission objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommission> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyMerchantCommission objects filtered by the is_active column
 * @method     ChildSpyMerchantCommission[]|Collection findByValidFrom(string|array<string> $valid_from) Return ChildSpyMerchantCommission objects filtered by the valid_from column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommission> findByValidFrom(string|array<string> $valid_from) Return ChildSpyMerchantCommission objects filtered by the valid_from column
 * @method     ChildSpyMerchantCommission[]|Collection findByValidTo(string|array<string> $valid_to) Return ChildSpyMerchantCommission objects filtered by the valid_to column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommission> findByValidTo(string|array<string> $valid_to) Return ChildSpyMerchantCommission objects filtered by the valid_to column
 * @method     ChildSpyMerchantCommission[]|Collection findByPriority(int|array<int> $priority) Return ChildSpyMerchantCommission objects filtered by the priority column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommission> findByPriority(int|array<int> $priority) Return ChildSpyMerchantCommission objects filtered by the priority column
 * @method     ChildSpyMerchantCommission[]|Collection findByItemCondition(string|array<string> $item_condition) Return ChildSpyMerchantCommission objects filtered by the item_condition column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommission> findByItemCondition(string|array<string> $item_condition) Return ChildSpyMerchantCommission objects filtered by the item_condition column
 * @method     ChildSpyMerchantCommission[]|Collection findByOrderCondition(string|array<string> $order_condition) Return ChildSpyMerchantCommission objects filtered by the order_condition column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommission> findByOrderCondition(string|array<string> $order_condition) Return ChildSpyMerchantCommission objects filtered by the order_condition column
 * @method     ChildSpyMerchantCommission[]|Collection findByCalculatorTypePlugin(string|array<string> $calculator_type_plugin) Return ChildSpyMerchantCommission objects filtered by the calculator_type_plugin column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommission> findByCalculatorTypePlugin(string|array<string> $calculator_type_plugin) Return ChildSpyMerchantCommission objects filtered by the calculator_type_plugin column
 * @method     ChildSpyMerchantCommission[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyMerchantCommission objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommission> findByCreatedAt(string|array<string> $created_at) Return ChildSpyMerchantCommission objects filtered by the created_at column
 * @method     ChildSpyMerchantCommission[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyMerchantCommission objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyMerchantCommission> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyMerchantCommission objects filtered by the updated_at column
 *
 * @method     ChildSpyMerchantCommission[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyMerchantCommission> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyMerchantCommissionQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\MerchantCommission\Persistence\Base\SpyMerchantCommissionQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\MerchantCommission\\Persistence\\SpyMerchantCommission', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyMerchantCommissionQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyMerchantCommissionQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyMerchantCommissionQuery) {
            return $criteria;
        }
        $query = new ChildSpyMerchantCommissionQuery();
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
     * @return ChildSpyMerchantCommission|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyMerchantCommissionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyMerchantCommission A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT `id_merchant_commission`, `fk_merchant_commission_group`, `uuid`, `name`, `description`, `key`, `amount`, `is_active`, `valid_from`, `valid_to`, `priority`, `item_condition`, `order_condition`, `calculator_type_plugin`, `created_at`, `updated_at` FROM `spy_merchant_commission` WHERE `id_merchant_commission` = :p0';
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
            /** @var ChildSpyMerchantCommission $obj */
            $obj = new ChildSpyMerchantCommission();
            $obj->hydrate($row);
            SpyMerchantCommissionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyMerchantCommission|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idMerchantCommission Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdMerchantCommission_Between(array $idMerchantCommission)
    {
        return $this->filterByIdMerchantCommission($idMerchantCommission, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idMerchantCommissions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdMerchantCommission_In(array $idMerchantCommissions)
    {
        return $this->filterByIdMerchantCommission($idMerchantCommissions, Criteria::IN);
    }

    /**
     * Filter the query on the id_merchant_commission column
     *
     * Example usage:
     * <code>
     * $query->filterByIdMerchantCommission(1234); // WHERE id_merchant_commission = 1234
     * $query->filterByIdMerchantCommission(array(12, 34), Criteria::IN); // WHERE id_merchant_commission IN (12, 34)
     * $query->filterByIdMerchantCommission(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_merchant_commission > 12
     * </code>
     *
     * @param     mixed $idMerchantCommission The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdMerchantCommission($idMerchantCommission = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idMerchantCommission)) {
            $useMinMax = false;
            if (isset($idMerchantCommission['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION, $idMerchantCommission['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idMerchantCommission['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION, $idMerchantCommission['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idMerchantCommission of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION, $idMerchantCommission, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkMerchantCommissionGroup Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkMerchantCommissionGroup_Between(array $fkMerchantCommissionGroup)
    {
        return $this->filterByFkMerchantCommissionGroup($fkMerchantCommissionGroup, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkMerchantCommissionGroups Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkMerchantCommissionGroup_In(array $fkMerchantCommissionGroups)
    {
        return $this->filterByFkMerchantCommissionGroup($fkMerchantCommissionGroups, Criteria::IN);
    }

    /**
     * Filter the query on the fk_merchant_commission_group column
     *
     * Example usage:
     * <code>
     * $query->filterByFkMerchantCommissionGroup(1234); // WHERE fk_merchant_commission_group = 1234
     * $query->filterByFkMerchantCommissionGroup(array(12, 34), Criteria::IN); // WHERE fk_merchant_commission_group IN (12, 34)
     * $query->filterByFkMerchantCommissionGroup(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_merchant_commission_group > 12
     * </code>
     *
     * @see       filterByMerchantCommissionGroup()
     *
     * @param     mixed $fkMerchantCommissionGroup The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkMerchantCommissionGroup($fkMerchantCommissionGroup = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkMerchantCommissionGroup)) {
            $useMinMax = false;
            if (isset($fkMerchantCommissionGroup['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_FK_MERCHANT_COMMISSION_GROUP, $fkMerchantCommissionGroup['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkMerchantCommissionGroup['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_FK_MERCHANT_COMMISSION_GROUP, $fkMerchantCommissionGroup['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkMerchantCommissionGroup of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_FK_MERCHANT_COMMISSION_GROUP, $fkMerchantCommissionGroup, $comparison);

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

        $query = $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_UUID, $uuid, $comparison);

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

        $query = $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_NAME, $name, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $descriptions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescription_In(array $descriptions)
    {
        return $this->filterByDescription($descriptions, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $description Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDescription_Like($description)
    {
        return $this->filterByDescription($description, Criteria::LIKE);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * $query->filterByDescription([1, 'foo'], Criteria::IN); // WHERE description IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDescription($description = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $description = str_replace('*', '%', $description);
        }

        if (is_array($description) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$description of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_DESCRIPTION, $description, $comparison);

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

        $query = $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_KEY, $key, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $amount Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmount_Between(array $amount)
    {
        return $this->filterByAmount($amount, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $amounts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAmount_In(array $amounts)
    {
        return $this->filterByAmount($amounts, Criteria::IN);
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34), Criteria::IN); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE amount > 12
     * </code>
     *
     * @param     mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAmount($amount = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$amount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_AMOUNT, $amount, $comparison);

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

        $query = $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $validFrom Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValidFrom_Between(array $validFrom)
    {
        return $this->filterByValidFrom($validFrom, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $validFroms Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValidFrom_In(array $validFroms)
    {
        return $this->filterByValidFrom($validFroms, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $validFrom Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValidFrom_Like($validFrom)
    {
        return $this->filterByValidFrom($validFrom, Criteria::LIKE);
    }

    /**
     * Filter the query on the valid_from column
     *
     * Example usage:
     * <code>
     * $query->filterByValidFrom('2011-03-14'); // WHERE valid_from = '2011-03-14'
     * $query->filterByValidFrom('now'); // WHERE valid_from = '2011-03-14'
     * $query->filterByValidFrom(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE valid_from > '2011-03-13'
     * </code>
     *
     * @param     mixed $validFrom The value to use as filter.
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
    public function filterByValidFrom($validFrom = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($validFrom)) {
            $useMinMax = false;
            if (isset($validFrom['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_VALID_FROM, $validFrom['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($validFrom['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_VALID_FROM, $validFrom['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$validFrom of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_VALID_FROM, $validFrom, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $validTo Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValidTo_Between(array $validTo)
    {
        return $this->filterByValidTo($validTo, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $validTos Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValidTo_In(array $validTos)
    {
        return $this->filterByValidTo($validTos, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $validTo Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByValidTo_Like($validTo)
    {
        return $this->filterByValidTo($validTo, Criteria::LIKE);
    }

    /**
     * Filter the query on the valid_to column
     *
     * Example usage:
     * <code>
     * $query->filterByValidTo('2011-03-14'); // WHERE valid_to = '2011-03-14'
     * $query->filterByValidTo('now'); // WHERE valid_to = '2011-03-14'
     * $query->filterByValidTo(array('max' => 'yesterday'), SprykerCriteria::BETWEEN); // WHERE valid_to > '2011-03-13'
     * </code>
     *
     * @param     mixed $validTo The value to use as filter.
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
    public function filterByValidTo($validTo = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($validTo)) {
            $useMinMax = false;
            if (isset($validTo['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_VALID_TO, $validTo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($validTo['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_VALID_TO, $validTo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$validTo of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_VALID_TO, $validTo, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $priority Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPriority_Between(array $priority)
    {
        return $this->filterByPriority($priority, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $prioritys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPriority_In(array $prioritys)
    {
        return $this->filterByPriority($prioritys, Criteria::IN);
    }

    /**
     * Filter the query on the priority column
     *
     * Example usage:
     * <code>
     * $query->filterByPriority(1234); // WHERE priority = 1234
     * $query->filterByPriority(array(12, 34), Criteria::IN); // WHERE priority IN (12, 34)
     * $query->filterByPriority(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE priority > 12
     * </code>
     *
     * @param     mixed $priority The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPriority($priority = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($priority)) {
            $useMinMax = false;
            if (isset($priority['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_PRIORITY, $priority['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($priority['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_PRIORITY, $priority['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$priority of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_PRIORITY, $priority, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $itemConditions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByItemCondition_In(array $itemConditions)
    {
        return $this->filterByItemCondition($itemConditions, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $itemCondition Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByItemCondition_Like($itemCondition)
    {
        return $this->filterByItemCondition($itemCondition, Criteria::LIKE);
    }

    /**
     * Filter the query on the item_condition column
     *
     * Example usage:
     * <code>
     * $query->filterByItemCondition('fooValue');   // WHERE item_condition = 'fooValue'
     * $query->filterByItemCondition('%fooValue%', Criteria::LIKE); // WHERE item_condition LIKE '%fooValue%'
     * $query->filterByItemCondition([1, 'foo'], Criteria::IN); // WHERE item_condition IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $itemCondition The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByItemCondition($itemCondition = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $itemCondition = str_replace('*', '%', $itemCondition);
        }

        if (is_array($itemCondition) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$itemCondition of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_ITEM_CONDITION, $itemCondition, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $orderConditions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderCondition_In(array $orderConditions)
    {
        return $this->filterByOrderCondition($orderConditions, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $orderCondition Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByOrderCondition_Like($orderCondition)
    {
        return $this->filterByOrderCondition($orderCondition, Criteria::LIKE);
    }

    /**
     * Filter the query on the order_condition column
     *
     * Example usage:
     * <code>
     * $query->filterByOrderCondition('fooValue');   // WHERE order_condition = 'fooValue'
     * $query->filterByOrderCondition('%fooValue%', Criteria::LIKE); // WHERE order_condition LIKE '%fooValue%'
     * $query->filterByOrderCondition([1, 'foo'], Criteria::IN); // WHERE order_condition IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $orderCondition The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByOrderCondition($orderCondition = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $orderCondition = str_replace('*', '%', $orderCondition);
        }

        if (is_array($orderCondition) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$orderCondition of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_ORDER_CONDITION, $orderCondition, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $calculatorTypePlugins Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCalculatorTypePlugin_In(array $calculatorTypePlugins)
    {
        return $this->filterByCalculatorTypePlugin($calculatorTypePlugins, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $calculatorTypePlugin Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCalculatorTypePlugin_Like($calculatorTypePlugin)
    {
        return $this->filterByCalculatorTypePlugin($calculatorTypePlugin, Criteria::LIKE);
    }

    /**
     * Filter the query on the calculator_type_plugin column
     *
     * Example usage:
     * <code>
     * $query->filterByCalculatorTypePlugin('fooValue');   // WHERE calculator_type_plugin = 'fooValue'
     * $query->filterByCalculatorTypePlugin('%fooValue%', Criteria::LIKE); // WHERE calculator_type_plugin LIKE '%fooValue%'
     * $query->filterByCalculatorTypePlugin([1, 'foo'], Criteria::IN); // WHERE calculator_type_plugin IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $calculatorTypePlugin The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCalculatorTypePlugin($calculatorTypePlugin = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $calculatorTypePlugin = str_replace('*', '%', $calculatorTypePlugin);
        }

        if (is_array($calculatorTypePlugin) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$calculatorTypePlugin of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_CALCULATOR_TYPE_PLUGIN, $calculatorTypePlugin, $comparison);

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
                $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroup object
     *
     * @param \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroup|ObjectCollection $spyMerchantCommissionGroup The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantCommissionGroup($spyMerchantCommissionGroup, ?string $comparison = null)
    {
        if ($spyMerchantCommissionGroup instanceof \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroup) {
            return $this
                ->addUsingAlias(SpyMerchantCommissionTableMap::COL_FK_MERCHANT_COMMISSION_GROUP, $spyMerchantCommissionGroup->getIdMerchantCommissionGroup(), $comparison);
        } elseif ($spyMerchantCommissionGroup instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyMerchantCommissionTableMap::COL_FK_MERCHANT_COMMISSION_GROUP, $spyMerchantCommissionGroup->toKeyValue('PrimaryKey', 'IdMerchantCommissionGroup'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByMerchantCommissionGroup() only accepts arguments of type \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroup or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MerchantCommissionGroup relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMerchantCommissionGroup(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MerchantCommissionGroup');

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
            $this->addJoinObject($join, 'MerchantCommissionGroup');
        }

        return $this;
    }

    /**
     * Use the MerchantCommissionGroup relation SpyMerchantCommissionGroup object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroupQuery A secondary query class using the current class as primary query
     */
    public function useMerchantCommissionGroupQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMerchantCommissionGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MerchantCommissionGroup', '\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroupQuery');
    }

    /**
     * Use the MerchantCommissionGroup relation SpyMerchantCommissionGroup object
     *
     * @param callable(\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroupQuery):\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroupQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMerchantCommissionGroupQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMerchantCommissionGroupQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the MerchantCommissionGroup relation to the SpyMerchantCommissionGroup table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroupQuery The inner query object of the EXISTS statement
     */
    public function useMerchantCommissionGroupExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroupQuery */
        $q = $this->useExistsQuery('MerchantCommissionGroup', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the MerchantCommissionGroup relation to the SpyMerchantCommissionGroup table for a NOT EXISTS query.
     *
     * @see useMerchantCommissionGroupExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroupQuery The inner query object of the NOT EXISTS statement
     */
    public function useMerchantCommissionGroupNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroupQuery */
        $q = $this->useExistsQuery('MerchantCommissionGroup', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the MerchantCommissionGroup relation to the SpyMerchantCommissionGroup table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroupQuery The inner query object of the IN statement
     */
    public function useInMerchantCommissionGroupQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroupQuery */
        $q = $this->useInQuery('MerchantCommissionGroup', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the MerchantCommissionGroup relation to the SpyMerchantCommissionGroup table for a NOT IN query.
     *
     * @see useMerchantCommissionGroupInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroupQuery The inner query object of the NOT IN statement
     */
    public function useNotInMerchantCommissionGroupQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionGroupQuery */
        $q = $this->useInQuery('MerchantCommissionGroup', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmount object
     *
     * @param \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmount|ObjectCollection $spyMerchantCommissionAmount the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantCommissionAmount($spyMerchantCommissionAmount, ?string $comparison = null)
    {
        if ($spyMerchantCommissionAmount instanceof \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmount) {
            $this
                ->addUsingAlias(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION, $spyMerchantCommissionAmount->getFkMerchantCommission(), $comparison);

            return $this;
        } elseif ($spyMerchantCommissionAmount instanceof ObjectCollection) {
            $this
                ->useMerchantCommissionAmountQuery()
                ->filterByPrimaryKeys($spyMerchantCommissionAmount->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByMerchantCommissionAmount() only accepts arguments of type \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmount or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MerchantCommissionAmount relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMerchantCommissionAmount(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MerchantCommissionAmount');

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
            $this->addJoinObject($join, 'MerchantCommissionAmount');
        }

        return $this;
    }

    /**
     * Use the MerchantCommissionAmount relation SpyMerchantCommissionAmount object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmountQuery A secondary query class using the current class as primary query
     */
    public function useMerchantCommissionAmountQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMerchantCommissionAmount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MerchantCommissionAmount', '\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmountQuery');
    }

    /**
     * Use the MerchantCommissionAmount relation SpyMerchantCommissionAmount object
     *
     * @param callable(\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmountQuery):\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmountQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMerchantCommissionAmountQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMerchantCommissionAmountQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the MerchantCommissionAmount relation to the SpyMerchantCommissionAmount table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmountQuery The inner query object of the EXISTS statement
     */
    public function useMerchantCommissionAmountExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmountQuery */
        $q = $this->useExistsQuery('MerchantCommissionAmount', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the MerchantCommissionAmount relation to the SpyMerchantCommissionAmount table for a NOT EXISTS query.
     *
     * @see useMerchantCommissionAmountExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmountQuery The inner query object of the NOT EXISTS statement
     */
    public function useMerchantCommissionAmountNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmountQuery */
        $q = $this->useExistsQuery('MerchantCommissionAmount', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the MerchantCommissionAmount relation to the SpyMerchantCommissionAmount table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmountQuery The inner query object of the IN statement
     */
    public function useInMerchantCommissionAmountQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmountQuery */
        $q = $this->useInQuery('MerchantCommissionAmount', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the MerchantCommissionAmount relation to the SpyMerchantCommissionAmount table for a NOT IN query.
     *
     * @see useMerchantCommissionAmountInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmountQuery The inner query object of the NOT IN statement
     */
    public function useNotInMerchantCommissionAmountQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmountQuery */
        $q = $this->useInQuery('MerchantCommissionAmount', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStore object
     *
     * @param \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStore|ObjectCollection $spyMerchantCommissionStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantCommissionStore($spyMerchantCommissionStore, ?string $comparison = null)
    {
        if ($spyMerchantCommissionStore instanceof \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStore) {
            $this
                ->addUsingAlias(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION, $spyMerchantCommissionStore->getFkMerchantCommission(), $comparison);

            return $this;
        } elseif ($spyMerchantCommissionStore instanceof ObjectCollection) {
            $this
                ->useMerchantCommissionStoreQuery()
                ->filterByPrimaryKeys($spyMerchantCommissionStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByMerchantCommissionStore() only accepts arguments of type \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MerchantCommissionStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMerchantCommissionStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MerchantCommissionStore');

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
            $this->addJoinObject($join, 'MerchantCommissionStore');
        }

        return $this;
    }

    /**
     * Use the MerchantCommissionStore relation SpyMerchantCommissionStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery A secondary query class using the current class as primary query
     */
    public function useMerchantCommissionStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMerchantCommissionStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MerchantCommissionStore', '\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery');
    }

    /**
     * Use the MerchantCommissionStore relation SpyMerchantCommissionStore object
     *
     * @param callable(\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery):\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMerchantCommissionStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMerchantCommissionStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the MerchantCommissionStore relation to the SpyMerchantCommissionStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery The inner query object of the EXISTS statement
     */
    public function useMerchantCommissionStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery */
        $q = $this->useExistsQuery('MerchantCommissionStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the MerchantCommissionStore relation to the SpyMerchantCommissionStore table for a NOT EXISTS query.
     *
     * @see useMerchantCommissionStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useMerchantCommissionStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery */
        $q = $this->useExistsQuery('MerchantCommissionStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the MerchantCommissionStore relation to the SpyMerchantCommissionStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery The inner query object of the IN statement
     */
    public function useInMerchantCommissionStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery */
        $q = $this->useInQuery('MerchantCommissionStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the MerchantCommissionStore relation to the SpyMerchantCommissionStore table for a NOT IN query.
     *
     * @see useMerchantCommissionStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInMerchantCommissionStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionStoreQuery */
        $q = $this->useInQuery('MerchantCommissionStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchant object
     *
     * @param \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchant|ObjectCollection $spyMerchantCommissionMerchant the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMerchantCommissionMerchant($spyMerchantCommissionMerchant, ?string $comparison = null)
    {
        if ($spyMerchantCommissionMerchant instanceof \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchant) {
            $this
                ->addUsingAlias(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION, $spyMerchantCommissionMerchant->getFkMerchantCommission(), $comparison);

            return $this;
        } elseif ($spyMerchantCommissionMerchant instanceof ObjectCollection) {
            $this
                ->useMerchantCommissionMerchantQuery()
                ->filterByPrimaryKeys($spyMerchantCommissionMerchant->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByMerchantCommissionMerchant() only accepts arguments of type \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchant or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MerchantCommissionMerchant relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinMerchantCommissionMerchant(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MerchantCommissionMerchant');

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
            $this->addJoinObject($join, 'MerchantCommissionMerchant');
        }

        return $this;
    }

    /**
     * Use the MerchantCommissionMerchant relation SpyMerchantCommissionMerchant object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery A secondary query class using the current class as primary query
     */
    public function useMerchantCommissionMerchantQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMerchantCommissionMerchant($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MerchantCommissionMerchant', '\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery');
    }

    /**
     * Use the MerchantCommissionMerchant relation SpyMerchantCommissionMerchant object
     *
     * @param callable(\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery):\Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withMerchantCommissionMerchantQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useMerchantCommissionMerchantQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the MerchantCommissionMerchant relation to the SpyMerchantCommissionMerchant table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery The inner query object of the EXISTS statement
     */
    public function useMerchantCommissionMerchantExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery */
        $q = $this->useExistsQuery('MerchantCommissionMerchant', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the MerchantCommissionMerchant relation to the SpyMerchantCommissionMerchant table for a NOT EXISTS query.
     *
     * @see useMerchantCommissionMerchantExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery The inner query object of the NOT EXISTS statement
     */
    public function useMerchantCommissionMerchantNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery */
        $q = $this->useExistsQuery('MerchantCommissionMerchant', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the MerchantCommissionMerchant relation to the SpyMerchantCommissionMerchant table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery The inner query object of the IN statement
     */
    public function useInMerchantCommissionMerchantQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery */
        $q = $this->useInQuery('MerchantCommissionMerchant', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the MerchantCommissionMerchant relation to the SpyMerchantCommissionMerchant table for a NOT IN query.
     *
     * @see useMerchantCommissionMerchantInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery The inner query object of the NOT IN statement
     */
    public function useNotInMerchantCommissionMerchantQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionMerchantQuery */
        $q = $this->useInQuery('MerchantCommissionMerchant', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyMerchantCommission $spyMerchantCommission Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyMerchantCommission = null)
    {
        if ($spyMerchantCommission) {
            $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_ID_MERCHANT_COMMISSION, $spyMerchantCommission->getIdMerchantCommission(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_merchant_commission table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantCommissionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyMerchantCommissionTableMap::clearInstancePool();
            SpyMerchantCommissionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantCommissionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyMerchantCommissionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyMerchantCommissionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyMerchantCommissionTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyMerchantCommissionTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyMerchantCommissionTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyMerchantCommissionTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyMerchantCommissionTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyMerchantCommissionTableMap::COL_CREATED_AT);

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
