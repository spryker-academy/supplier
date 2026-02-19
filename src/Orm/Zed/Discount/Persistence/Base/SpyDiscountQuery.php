<?php

namespace Orm\Zed\Discount\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscount;
use Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotion;
use Orm\Zed\Discount\Persistence\SpyDiscount as ChildSpyDiscount;
use Orm\Zed\Discount\Persistence\SpyDiscountQuery as ChildSpyDiscountQuery;
use Orm\Zed\Discount\Persistence\Map\SpyDiscountTableMap;
use Orm\Zed\Store\Persistence\SpyStore;
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
 * Base class that represents a query for the `spy_discount` table.
 *
 * @method     ChildSpyDiscountQuery orderByIdDiscount($order = Criteria::ASC) Order by the id_discount column
 * @method     ChildSpyDiscountQuery orderByFkDiscountVoucherPool($order = Criteria::ASC) Order by the fk_discount_voucher_pool column
 * @method     ChildSpyDiscountQuery orderByFkStore($order = Criteria::ASC) Order by the fk_store column
 * @method     ChildSpyDiscountQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildSpyDiscountQuery orderByCalculatorPlugin($order = Criteria::ASC) Order by the calculator_plugin column
 * @method     ChildSpyDiscountQuery orderByCollectorQueryString($order = Criteria::ASC) Order by the collector_query_string column
 * @method     ChildSpyDiscountQuery orderByDecisionRuleQueryString($order = Criteria::ASC) Order by the decision_rule_query_string column
 * @method     ChildSpyDiscountQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildSpyDiscountQuery orderByDiscountKey($order = Criteria::ASC) Order by the discount_key column
 * @method     ChildSpyDiscountQuery orderByDiscountType($order = Criteria::ASC) Order by the discount_type column
 * @method     ChildSpyDiscountQuery orderByDisplayName($order = Criteria::ASC) Order by the display_name column
 * @method     ChildSpyDiscountQuery orderByIsActive($order = Criteria::ASC) Order by the is_active column
 * @method     ChildSpyDiscountQuery orderByIsExclusive($order = Criteria::ASC) Order by the is_exclusive column
 * @method     ChildSpyDiscountQuery orderByMinimumItemAmount($order = Criteria::ASC) Order by the minimum_item_amount column
 * @method     ChildSpyDiscountQuery orderByPriority($order = Criteria::ASC) Order by the priority column
 * @method     ChildSpyDiscountQuery orderByValidFrom($order = Criteria::ASC) Order by the valid_from column
 * @method     ChildSpyDiscountQuery orderByValidTo($order = Criteria::ASC) Order by the valid_to column
 * @method     ChildSpyDiscountQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpyDiscountQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpyDiscountQuery groupByIdDiscount() Group by the id_discount column
 * @method     ChildSpyDiscountQuery groupByFkDiscountVoucherPool() Group by the fk_discount_voucher_pool column
 * @method     ChildSpyDiscountQuery groupByFkStore() Group by the fk_store column
 * @method     ChildSpyDiscountQuery groupByAmount() Group by the amount column
 * @method     ChildSpyDiscountQuery groupByCalculatorPlugin() Group by the calculator_plugin column
 * @method     ChildSpyDiscountQuery groupByCollectorQueryString() Group by the collector_query_string column
 * @method     ChildSpyDiscountQuery groupByDecisionRuleQueryString() Group by the decision_rule_query_string column
 * @method     ChildSpyDiscountQuery groupByDescription() Group by the description column
 * @method     ChildSpyDiscountQuery groupByDiscountKey() Group by the discount_key column
 * @method     ChildSpyDiscountQuery groupByDiscountType() Group by the discount_type column
 * @method     ChildSpyDiscountQuery groupByDisplayName() Group by the display_name column
 * @method     ChildSpyDiscountQuery groupByIsActive() Group by the is_active column
 * @method     ChildSpyDiscountQuery groupByIsExclusive() Group by the is_exclusive column
 * @method     ChildSpyDiscountQuery groupByMinimumItemAmount() Group by the minimum_item_amount column
 * @method     ChildSpyDiscountQuery groupByPriority() Group by the priority column
 * @method     ChildSpyDiscountQuery groupByValidFrom() Group by the valid_from column
 * @method     ChildSpyDiscountQuery groupByValidTo() Group by the valid_to column
 * @method     ChildSpyDiscountQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpyDiscountQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpyDiscountQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpyDiscountQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpyDiscountQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpyDiscountQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpyDiscountQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpyDiscountQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpyDiscountQuery leftJoinVoucherPool($relationAlias = null) Adds a LEFT JOIN clause to the query using the VoucherPool relation
 * @method     ChildSpyDiscountQuery rightJoinVoucherPool($relationAlias = null) Adds a RIGHT JOIN clause to the query using the VoucherPool relation
 * @method     ChildSpyDiscountQuery innerJoinVoucherPool($relationAlias = null) Adds a INNER JOIN clause to the query using the VoucherPool relation
 *
 * @method     ChildSpyDiscountQuery joinWithVoucherPool($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the VoucherPool relation
 *
 * @method     ChildSpyDiscountQuery leftJoinWithVoucherPool() Adds a LEFT JOIN clause and with to the query using the VoucherPool relation
 * @method     ChildSpyDiscountQuery rightJoinWithVoucherPool() Adds a RIGHT JOIN clause and with to the query using the VoucherPool relation
 * @method     ChildSpyDiscountQuery innerJoinWithVoucherPool() Adds a INNER JOIN clause and with to the query using the VoucherPool relation
 *
 * @method     ChildSpyDiscountQuery leftJoinStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the Store relation
 * @method     ChildSpyDiscountQuery rightJoinStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Store relation
 * @method     ChildSpyDiscountQuery innerJoinStore($relationAlias = null) Adds a INNER JOIN clause to the query using the Store relation
 *
 * @method     ChildSpyDiscountQuery joinWithStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Store relation
 *
 * @method     ChildSpyDiscountQuery leftJoinWithStore() Adds a LEFT JOIN clause and with to the query using the Store relation
 * @method     ChildSpyDiscountQuery rightJoinWithStore() Adds a RIGHT JOIN clause and with to the query using the Store relation
 * @method     ChildSpyDiscountQuery innerJoinWithStore() Adds a INNER JOIN clause and with to the query using the Store relation
 *
 * @method     ChildSpyDiscountQuery leftJoinSpyCustomerDiscount($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyCustomerDiscount relation
 * @method     ChildSpyDiscountQuery rightJoinSpyCustomerDiscount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyCustomerDiscount relation
 * @method     ChildSpyDiscountQuery innerJoinSpyCustomerDiscount($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyCustomerDiscount relation
 *
 * @method     ChildSpyDiscountQuery joinWithSpyCustomerDiscount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyCustomerDiscount relation
 *
 * @method     ChildSpyDiscountQuery leftJoinWithSpyCustomerDiscount() Adds a LEFT JOIN clause and with to the query using the SpyCustomerDiscount relation
 * @method     ChildSpyDiscountQuery rightJoinWithSpyCustomerDiscount() Adds a RIGHT JOIN clause and with to the query using the SpyCustomerDiscount relation
 * @method     ChildSpyDiscountQuery innerJoinWithSpyCustomerDiscount() Adds a INNER JOIN clause and with to the query using the SpyCustomerDiscount relation
 *
 * @method     ChildSpyDiscountQuery leftJoinSpyDiscountStore($relationAlias = null) Adds a LEFT JOIN clause to the query using the SpyDiscountStore relation
 * @method     ChildSpyDiscountQuery rightJoinSpyDiscountStore($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SpyDiscountStore relation
 * @method     ChildSpyDiscountQuery innerJoinSpyDiscountStore($relationAlias = null) Adds a INNER JOIN clause to the query using the SpyDiscountStore relation
 *
 * @method     ChildSpyDiscountQuery joinWithSpyDiscountStore($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SpyDiscountStore relation
 *
 * @method     ChildSpyDiscountQuery leftJoinWithSpyDiscountStore() Adds a LEFT JOIN clause and with to the query using the SpyDiscountStore relation
 * @method     ChildSpyDiscountQuery rightJoinWithSpyDiscountStore() Adds a RIGHT JOIN clause and with to the query using the SpyDiscountStore relation
 * @method     ChildSpyDiscountQuery innerJoinWithSpyDiscountStore() Adds a INNER JOIN clause and with to the query using the SpyDiscountStore relation
 *
 * @method     ChildSpyDiscountQuery leftJoinDiscountAmount($relationAlias = null) Adds a LEFT JOIN clause to the query using the DiscountAmount relation
 * @method     ChildSpyDiscountQuery rightJoinDiscountAmount($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DiscountAmount relation
 * @method     ChildSpyDiscountQuery innerJoinDiscountAmount($relationAlias = null) Adds a INNER JOIN clause to the query using the DiscountAmount relation
 *
 * @method     ChildSpyDiscountQuery joinWithDiscountAmount($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DiscountAmount relation
 *
 * @method     ChildSpyDiscountQuery leftJoinWithDiscountAmount() Adds a LEFT JOIN clause and with to the query using the DiscountAmount relation
 * @method     ChildSpyDiscountQuery rightJoinWithDiscountAmount() Adds a RIGHT JOIN clause and with to the query using the DiscountAmount relation
 * @method     ChildSpyDiscountQuery innerJoinWithDiscountAmount() Adds a INNER JOIN clause and with to the query using the DiscountAmount relation
 *
 * @method     ChildSpyDiscountQuery leftJoinDiscountPromotion($relationAlias = null) Adds a LEFT JOIN clause to the query using the DiscountPromotion relation
 * @method     ChildSpyDiscountQuery rightJoinDiscountPromotion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the DiscountPromotion relation
 * @method     ChildSpyDiscountQuery innerJoinDiscountPromotion($relationAlias = null) Adds a INNER JOIN clause to the query using the DiscountPromotion relation
 *
 * @method     ChildSpyDiscountQuery joinWithDiscountPromotion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the DiscountPromotion relation
 *
 * @method     ChildSpyDiscountQuery leftJoinWithDiscountPromotion() Adds a LEFT JOIN clause and with to the query using the DiscountPromotion relation
 * @method     ChildSpyDiscountQuery rightJoinWithDiscountPromotion() Adds a RIGHT JOIN clause and with to the query using the DiscountPromotion relation
 * @method     ChildSpyDiscountQuery innerJoinWithDiscountPromotion() Adds a INNER JOIN clause and with to the query using the DiscountPromotion relation
 *
 * @method     \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery|\Orm\Zed\Store\Persistence\SpyStoreQuery|\Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscountQuery|\Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery|\Orm\Zed\Discount\Persistence\SpyDiscountAmountQuery|\Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpyDiscount|null findOne(?ConnectionInterface $con = null) Return the first ChildSpyDiscount matching the query
 * @method     ChildSpyDiscount findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpyDiscount matching the query, or a new ChildSpyDiscount object populated from the query conditions when no match is found
 *
 * @method     ChildSpyDiscount|null findOneByIdDiscount(int $id_discount) Return the first ChildSpyDiscount filtered by the id_discount column
 * @method     ChildSpyDiscount|null findOneByFkDiscountVoucherPool(int $fk_discount_voucher_pool) Return the first ChildSpyDiscount filtered by the fk_discount_voucher_pool column
 * @method     ChildSpyDiscount|null findOneByFkStore(int $fk_store) Return the first ChildSpyDiscount filtered by the fk_store column
 * @method     ChildSpyDiscount|null findOneByAmount(int $amount) Return the first ChildSpyDiscount filtered by the amount column
 * @method     ChildSpyDiscount|null findOneByCalculatorPlugin(string $calculator_plugin) Return the first ChildSpyDiscount filtered by the calculator_plugin column
 * @method     ChildSpyDiscount|null findOneByCollectorQueryString(string $collector_query_string) Return the first ChildSpyDiscount filtered by the collector_query_string column
 * @method     ChildSpyDiscount|null findOneByDecisionRuleQueryString(string $decision_rule_query_string) Return the first ChildSpyDiscount filtered by the decision_rule_query_string column
 * @method     ChildSpyDiscount|null findOneByDescription(string $description) Return the first ChildSpyDiscount filtered by the description column
 * @method     ChildSpyDiscount|null findOneByDiscountKey(string $discount_key) Return the first ChildSpyDiscount filtered by the discount_key column
 * @method     ChildSpyDiscount|null findOneByDiscountType(string $discount_type) Return the first ChildSpyDiscount filtered by the discount_type column
 * @method     ChildSpyDiscount|null findOneByDisplayName(string $display_name) Return the first ChildSpyDiscount filtered by the display_name column
 * @method     ChildSpyDiscount|null findOneByIsActive(boolean $is_active) Return the first ChildSpyDiscount filtered by the is_active column
 * @method     ChildSpyDiscount|null findOneByIsExclusive(boolean $is_exclusive) Return the first ChildSpyDiscount filtered by the is_exclusive column
 * @method     ChildSpyDiscount|null findOneByMinimumItemAmount(int $minimum_item_amount) Return the first ChildSpyDiscount filtered by the minimum_item_amount column
 * @method     ChildSpyDiscount|null findOneByPriority(int $priority) Return the first ChildSpyDiscount filtered by the priority column
 * @method     ChildSpyDiscount|null findOneByValidFrom(string $valid_from) Return the first ChildSpyDiscount filtered by the valid_from column
 * @method     ChildSpyDiscount|null findOneByValidTo(string $valid_to) Return the first ChildSpyDiscount filtered by the valid_to column
 * @method     ChildSpyDiscount|null findOneByCreatedAt(string $created_at) Return the first ChildSpyDiscount filtered by the created_at column
 * @method     ChildSpyDiscount|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpyDiscount filtered by the updated_at column
 *
 * @method     ChildSpyDiscount requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpyDiscount by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOne(?ConnectionInterface $con = null) Return the first ChildSpyDiscount matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyDiscount requireOneByIdDiscount(int $id_discount) Return the first ChildSpyDiscount filtered by the id_discount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByFkDiscountVoucherPool(int $fk_discount_voucher_pool) Return the first ChildSpyDiscount filtered by the fk_discount_voucher_pool column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByFkStore(int $fk_store) Return the first ChildSpyDiscount filtered by the fk_store column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByAmount(int $amount) Return the first ChildSpyDiscount filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByCalculatorPlugin(string $calculator_plugin) Return the first ChildSpyDiscount filtered by the calculator_plugin column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByCollectorQueryString(string $collector_query_string) Return the first ChildSpyDiscount filtered by the collector_query_string column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByDecisionRuleQueryString(string $decision_rule_query_string) Return the first ChildSpyDiscount filtered by the decision_rule_query_string column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByDescription(string $description) Return the first ChildSpyDiscount filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByDiscountKey(string $discount_key) Return the first ChildSpyDiscount filtered by the discount_key column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByDiscountType(string $discount_type) Return the first ChildSpyDiscount filtered by the discount_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByDisplayName(string $display_name) Return the first ChildSpyDiscount filtered by the display_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByIsActive(boolean $is_active) Return the first ChildSpyDiscount filtered by the is_active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByIsExclusive(boolean $is_exclusive) Return the first ChildSpyDiscount filtered by the is_exclusive column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByMinimumItemAmount(int $minimum_item_amount) Return the first ChildSpyDiscount filtered by the minimum_item_amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByPriority(int $priority) Return the first ChildSpyDiscount filtered by the priority column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByValidFrom(string $valid_from) Return the first ChildSpyDiscount filtered by the valid_from column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByValidTo(string $valid_to) Return the first ChildSpyDiscount filtered by the valid_to column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByCreatedAt(string $created_at) Return the first ChildSpyDiscount filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpyDiscount requireOneByUpdatedAt(string $updated_at) Return the first ChildSpyDiscount filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpyDiscount[]|Collection find(?ConnectionInterface $con = null) Return ChildSpyDiscount objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> find(?ConnectionInterface $con = null) Return ChildSpyDiscount objects based on current ModelCriteria
 *
 * @method     ChildSpyDiscount[]|Collection findByIdDiscount(int|array<int> $id_discount) Return ChildSpyDiscount objects filtered by the id_discount column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByIdDiscount(int|array<int> $id_discount) Return ChildSpyDiscount objects filtered by the id_discount column
 * @method     ChildSpyDiscount[]|Collection findByFkDiscountVoucherPool(int|array<int> $fk_discount_voucher_pool) Return ChildSpyDiscount objects filtered by the fk_discount_voucher_pool column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByFkDiscountVoucherPool(int|array<int> $fk_discount_voucher_pool) Return ChildSpyDiscount objects filtered by the fk_discount_voucher_pool column
 * @method     ChildSpyDiscount[]|Collection findByFkStore(int|array<int> $fk_store) Return ChildSpyDiscount objects filtered by the fk_store column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByFkStore(int|array<int> $fk_store) Return ChildSpyDiscount objects filtered by the fk_store column
 * @method     ChildSpyDiscount[]|Collection findByAmount(int|array<int> $amount) Return ChildSpyDiscount objects filtered by the amount column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByAmount(int|array<int> $amount) Return ChildSpyDiscount objects filtered by the amount column
 * @method     ChildSpyDiscount[]|Collection findByCalculatorPlugin(string|array<string> $calculator_plugin) Return ChildSpyDiscount objects filtered by the calculator_plugin column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByCalculatorPlugin(string|array<string> $calculator_plugin) Return ChildSpyDiscount objects filtered by the calculator_plugin column
 * @method     ChildSpyDiscount[]|Collection findByCollectorQueryString(string|array<string> $collector_query_string) Return ChildSpyDiscount objects filtered by the collector_query_string column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByCollectorQueryString(string|array<string> $collector_query_string) Return ChildSpyDiscount objects filtered by the collector_query_string column
 * @method     ChildSpyDiscount[]|Collection findByDecisionRuleQueryString(string|array<string> $decision_rule_query_string) Return ChildSpyDiscount objects filtered by the decision_rule_query_string column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByDecisionRuleQueryString(string|array<string> $decision_rule_query_string) Return ChildSpyDiscount objects filtered by the decision_rule_query_string column
 * @method     ChildSpyDiscount[]|Collection findByDescription(string|array<string> $description) Return ChildSpyDiscount objects filtered by the description column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByDescription(string|array<string> $description) Return ChildSpyDiscount objects filtered by the description column
 * @method     ChildSpyDiscount[]|Collection findByDiscountKey(string|array<string> $discount_key) Return ChildSpyDiscount objects filtered by the discount_key column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByDiscountKey(string|array<string> $discount_key) Return ChildSpyDiscount objects filtered by the discount_key column
 * @method     ChildSpyDiscount[]|Collection findByDiscountType(string|array<string> $discount_type) Return ChildSpyDiscount objects filtered by the discount_type column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByDiscountType(string|array<string> $discount_type) Return ChildSpyDiscount objects filtered by the discount_type column
 * @method     ChildSpyDiscount[]|Collection findByDisplayName(string|array<string> $display_name) Return ChildSpyDiscount objects filtered by the display_name column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByDisplayName(string|array<string> $display_name) Return ChildSpyDiscount objects filtered by the display_name column
 * @method     ChildSpyDiscount[]|Collection findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyDiscount objects filtered by the is_active column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByIsActive(boolean|array<boolean> $is_active) Return ChildSpyDiscount objects filtered by the is_active column
 * @method     ChildSpyDiscount[]|Collection findByIsExclusive(boolean|array<boolean> $is_exclusive) Return ChildSpyDiscount objects filtered by the is_exclusive column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByIsExclusive(boolean|array<boolean> $is_exclusive) Return ChildSpyDiscount objects filtered by the is_exclusive column
 * @method     ChildSpyDiscount[]|Collection findByMinimumItemAmount(int|array<int> $minimum_item_amount) Return ChildSpyDiscount objects filtered by the minimum_item_amount column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByMinimumItemAmount(int|array<int> $minimum_item_amount) Return ChildSpyDiscount objects filtered by the minimum_item_amount column
 * @method     ChildSpyDiscount[]|Collection findByPriority(int|array<int> $priority) Return ChildSpyDiscount objects filtered by the priority column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByPriority(int|array<int> $priority) Return ChildSpyDiscount objects filtered by the priority column
 * @method     ChildSpyDiscount[]|Collection findByValidFrom(string|array<string> $valid_from) Return ChildSpyDiscount objects filtered by the valid_from column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByValidFrom(string|array<string> $valid_from) Return ChildSpyDiscount objects filtered by the valid_from column
 * @method     ChildSpyDiscount[]|Collection findByValidTo(string|array<string> $valid_to) Return ChildSpyDiscount objects filtered by the valid_to column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByValidTo(string|array<string> $valid_to) Return ChildSpyDiscount objects filtered by the valid_to column
 * @method     ChildSpyDiscount[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpyDiscount objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByCreatedAt(string|array<string> $created_at) Return ChildSpyDiscount objects filtered by the created_at column
 * @method     ChildSpyDiscount[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyDiscount objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpyDiscount> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpyDiscount objects filtered by the updated_at column
 *
 * @method     ChildSpyDiscount[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpyDiscount> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpyDiscountQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Discount\Persistence\Base\SpyDiscountQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Discount\\Persistence\\SpyDiscount', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpyDiscountQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpyDiscountQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpyDiscountQuery) {
            return $criteria;
        }
        $query = new ChildSpyDiscountQuery();
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
     * @return ChildSpyDiscount|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpyDiscountTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpyDiscount A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_discount, fk_discount_voucher_pool, fk_store, amount, calculator_plugin, collector_query_string, decision_rule_query_string, description, discount_key, discount_type, display_name, is_active, is_exclusive, minimum_item_amount, priority, valid_from, valid_to, created_at, updated_at FROM spy_discount WHERE id_discount = :p0';
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
            /** @var ChildSpyDiscount $obj */
            $obj = new ChildSpyDiscount();
            $obj->hydrate($row);
            SpyDiscountTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpyDiscount|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpyDiscountTableMap::COL_ID_DISCOUNT, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpyDiscountTableMap::COL_ID_DISCOUNT, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idDiscount Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdDiscount_Between(array $idDiscount)
    {
        return $this->filterByIdDiscount($idDiscount, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idDiscounts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdDiscount_In(array $idDiscounts)
    {
        return $this->filterByIdDiscount($idDiscounts, Criteria::IN);
    }

    /**
     * Filter the query on the id_discount column
     *
     * Example usage:
     * <code>
     * $query->filterByIdDiscount(1234); // WHERE id_discount = 1234
     * $query->filterByIdDiscount(array(12, 34), Criteria::IN); // WHERE id_discount IN (12, 34)
     * $query->filterByIdDiscount(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_discount > 12
     * </code>
     *
     * @param     mixed $idDiscount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdDiscount($idDiscount = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idDiscount)) {
            $useMinMax = false;
            if (isset($idDiscount['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountTableMap::COL_ID_DISCOUNT, $idDiscount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idDiscount['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountTableMap::COL_ID_DISCOUNT, $idDiscount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idDiscount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_ID_DISCOUNT, $idDiscount, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkDiscountVoucherPool Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkDiscountVoucherPool_Between(array $fkDiscountVoucherPool)
    {
        return $this->filterByFkDiscountVoucherPool($fkDiscountVoucherPool, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkDiscountVoucherPools Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkDiscountVoucherPool_In(array $fkDiscountVoucherPools)
    {
        return $this->filterByFkDiscountVoucherPool($fkDiscountVoucherPools, Criteria::IN);
    }

    /**
     * Filter the query on the fk_discount_voucher_pool column
     *
     * Example usage:
     * <code>
     * $query->filterByFkDiscountVoucherPool(1234); // WHERE fk_discount_voucher_pool = 1234
     * $query->filterByFkDiscountVoucherPool(array(12, 34), Criteria::IN); // WHERE fk_discount_voucher_pool IN (12, 34)
     * $query->filterByFkDiscountVoucherPool(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_discount_voucher_pool > 12
     * </code>
     *
     * @see       filterByVoucherPool()
     *
     * @param     mixed $fkDiscountVoucherPool The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkDiscountVoucherPool($fkDiscountVoucherPool = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkDiscountVoucherPool)) {
            $useMinMax = false;
            if (isset($fkDiscountVoucherPool['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountTableMap::COL_FK_DISCOUNT_VOUCHER_POOL, $fkDiscountVoucherPool['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkDiscountVoucherPool['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountTableMap::COL_FK_DISCOUNT_VOUCHER_POOL, $fkDiscountVoucherPool['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkDiscountVoucherPool of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_FK_DISCOUNT_VOUCHER_POOL, $fkDiscountVoucherPool, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkStore Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkStore_Between(array $fkStore)
    {
        return $this->filterByFkStore($fkStore, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkStores Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkStore_In(array $fkStores)
    {
        return $this->filterByFkStore($fkStores, Criteria::IN);
    }

    /**
     * Filter the query on the fk_store column
     *
     * Example usage:
     * <code>
     * $query->filterByFkStore(1234); // WHERE fk_store = 1234
     * $query->filterByFkStore(array(12, 34), Criteria::IN); // WHERE fk_store IN (12, 34)
     * $query->filterByFkStore(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_store > 12
     * </code>
     *
     * @see       filterByStore()
     *
     * @param     mixed $fkStore The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkStore($fkStore = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkStore)) {
            $useMinMax = false;
            if (isset($fkStore['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountTableMap::COL_FK_STORE, $fkStore['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkStore['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountTableMap::COL_FK_STORE, $fkStore['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkStore of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_FK_STORE, $fkStore, $comparison);

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
                $this->addUsingAlias(SpyDiscountTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$amount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_AMOUNT, $amount, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $calculatorPlugins Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCalculatorPlugin_In(array $calculatorPlugins)
    {
        return $this->filterByCalculatorPlugin($calculatorPlugins, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $calculatorPlugin Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCalculatorPlugin_Like($calculatorPlugin)
    {
        return $this->filterByCalculatorPlugin($calculatorPlugin, Criteria::LIKE);
    }

    /**
     * Filter the query on the calculator_plugin column
     *
     * Example usage:
     * <code>
     * $query->filterByCalculatorPlugin('fooValue');   // WHERE calculator_plugin = 'fooValue'
     * $query->filterByCalculatorPlugin('%fooValue%', Criteria::LIKE); // WHERE calculator_plugin LIKE '%fooValue%'
     * $query->filterByCalculatorPlugin([1, 'foo'], Criteria::IN); // WHERE calculator_plugin IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $calculatorPlugin The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCalculatorPlugin($calculatorPlugin = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $calculatorPlugin = str_replace('*', '%', $calculatorPlugin);
        }

        if (is_array($calculatorPlugin) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$calculatorPlugin of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_CALCULATOR_PLUGIN, $calculatorPlugin, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $collectorQueryStrings Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCollectorQueryString_In(array $collectorQueryStrings)
    {
        return $this->filterByCollectorQueryString($collectorQueryStrings, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $collectorQueryString Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCollectorQueryString_Like($collectorQueryString)
    {
        return $this->filterByCollectorQueryString($collectorQueryString, Criteria::LIKE);
    }

    /**
     * Filter the query on the collector_query_string column
     *
     * Example usage:
     * <code>
     * $query->filterByCollectorQueryString('fooValue');   // WHERE collector_query_string = 'fooValue'
     * $query->filterByCollectorQueryString('%fooValue%', Criteria::LIKE); // WHERE collector_query_string LIKE '%fooValue%'
     * $query->filterByCollectorQueryString([1, 'foo'], Criteria::IN); // WHERE collector_query_string IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $collectorQueryString The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCollectorQueryString($collectorQueryString = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $collectorQueryString = str_replace('*', '%', $collectorQueryString);
        }

        if (is_array($collectorQueryString) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$collectorQueryString of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_COLLECTOR_QUERY_STRING, $collectorQueryString, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $decisionRuleQueryStrings Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDecisionRuleQueryString_In(array $decisionRuleQueryStrings)
    {
        return $this->filterByDecisionRuleQueryString($decisionRuleQueryStrings, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $decisionRuleQueryString Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDecisionRuleQueryString_Like($decisionRuleQueryString)
    {
        return $this->filterByDecisionRuleQueryString($decisionRuleQueryString, Criteria::LIKE);
    }

    /**
     * Filter the query on the decision_rule_query_string column
     *
     * Example usage:
     * <code>
     * $query->filterByDecisionRuleQueryString('fooValue');   // WHERE decision_rule_query_string = 'fooValue'
     * $query->filterByDecisionRuleQueryString('%fooValue%', Criteria::LIKE); // WHERE decision_rule_query_string LIKE '%fooValue%'
     * $query->filterByDecisionRuleQueryString([1, 'foo'], Criteria::IN); // WHERE decision_rule_query_string IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $decisionRuleQueryString The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDecisionRuleQueryString($decisionRuleQueryString = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $decisionRuleQueryString = str_replace('*', '%', $decisionRuleQueryString);
        }

        if (is_array($decisionRuleQueryString) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$decisionRuleQueryString of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_DECISION_RULE_QUERY_STRING, $decisionRuleQueryString, $comparison);

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

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_DESCRIPTION, $description, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $discountKeys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscountKey_In(array $discountKeys)
    {
        return $this->filterByDiscountKey($discountKeys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $discountKey Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscountKey_Like($discountKey)
    {
        return $this->filterByDiscountKey($discountKey, Criteria::LIKE);
    }

    /**
     * Filter the query on the discount_key column
     *
     * Example usage:
     * <code>
     * $query->filterByDiscountKey('fooValue');   // WHERE discount_key = 'fooValue'
     * $query->filterByDiscountKey('%fooValue%', Criteria::LIKE); // WHERE discount_key LIKE '%fooValue%'
     * $query->filterByDiscountKey([1, 'foo'], Criteria::IN); // WHERE discount_key IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $discountKey The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDiscountKey($discountKey = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $discountKey = str_replace('*', '%', $discountKey);
        }

        if (is_array($discountKey) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$discountKey of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_DISCOUNT_KEY, $discountKey, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $discountTypes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscountType_In(array $discountTypes)
    {
        return $this->filterByDiscountType($discountTypes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $discountType Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscountType_Like($discountType)
    {
        return $this->filterByDiscountType($discountType, Criteria::LIKE);
    }

    /**
     * Filter the query on the discount_type column
     *
     * Example usage:
     * <code>
     * $query->filterByDiscountType('fooValue');   // WHERE discount_type = 'fooValue'
     * $query->filterByDiscountType('%fooValue%', Criteria::LIKE); // WHERE discount_type LIKE '%fooValue%'
     * $query->filterByDiscountType([1, 'foo'], Criteria::IN); // WHERE discount_type IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $discountType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDiscountType($discountType = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $discountType = str_replace('*', '%', $discountType);
        }

        if (is_array($discountType) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$discountType of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_DISCOUNT_TYPE, $discountType, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $displayNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDisplayName_In(array $displayNames)
    {
        return $this->filterByDisplayName($displayNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $displayName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDisplayName_Like($displayName)
    {
        return $this->filterByDisplayName($displayName, Criteria::LIKE);
    }

    /**
     * Filter the query on the display_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDisplayName('fooValue');   // WHERE display_name = 'fooValue'
     * $query->filterByDisplayName('%fooValue%', Criteria::LIKE); // WHERE display_name LIKE '%fooValue%'
     * $query->filterByDisplayName([1, 'foo'], Criteria::IN); // WHERE display_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $displayName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByDisplayName($displayName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $displayName = str_replace('*', '%', $displayName);
        }

        if (is_array($displayName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$displayName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_DISPLAY_NAME, $displayName, $comparison);

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

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_IS_ACTIVE, $isActive, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_exclusive column
     *
     * Example usage:
     * <code>
     * $query->filterByIsExclusive(true); // WHERE is_exclusive = true
     * $query->filterByIsExclusive('yes'); // WHERE is_exclusive = true
     * </code>
     *
     * @param     bool|string $isExclusive The value to use as filter.
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
    public function filterByIsExclusive($isExclusive = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isExclusive)) {
            $isExclusive = in_array(strtolower($isExclusive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_IS_EXCLUSIVE, $isExclusive, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $minimumItemAmount Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMinimumItemAmount_Between(array $minimumItemAmount)
    {
        return $this->filterByMinimumItemAmount($minimumItemAmount, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $minimumItemAmounts Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMinimumItemAmount_In(array $minimumItemAmounts)
    {
        return $this->filterByMinimumItemAmount($minimumItemAmounts, Criteria::IN);
    }

    /**
     * Filter the query on the minimum_item_amount column
     *
     * Example usage:
     * <code>
     * $query->filterByMinimumItemAmount(1234); // WHERE minimum_item_amount = 1234
     * $query->filterByMinimumItemAmount(array(12, 34), Criteria::IN); // WHERE minimum_item_amount IN (12, 34)
     * $query->filterByMinimumItemAmount(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE minimum_item_amount > 12
     * </code>
     *
     * @param     mixed $minimumItemAmount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByMinimumItemAmount($minimumItemAmount = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($minimumItemAmount)) {
            $useMinMax = false;
            if (isset($minimumItemAmount['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountTableMap::COL_MINIMUM_ITEM_AMOUNT, $minimumItemAmount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($minimumItemAmount['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountTableMap::COL_MINIMUM_ITEM_AMOUNT, $minimumItemAmount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$minimumItemAmount of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_MINIMUM_ITEM_AMOUNT, $minimumItemAmount, $comparison);

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
                $this->addUsingAlias(SpyDiscountTableMap::COL_PRIORITY, $priority['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($priority['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountTableMap::COL_PRIORITY, $priority['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$priority of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_PRIORITY, $priority, $comparison);

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
                $this->addUsingAlias(SpyDiscountTableMap::COL_VALID_FROM, $validFrom['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($validFrom['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountTableMap::COL_VALID_FROM, $validFrom['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$validFrom of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_VALID_FROM, $validFrom, $comparison);

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
                $this->addUsingAlias(SpyDiscountTableMap::COL_VALID_TO, $validTo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($validTo['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountTableMap::COL_VALID_TO, $validTo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$validTo of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_VALID_TO, $validTo, $comparison);

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
                $this->addUsingAlias(SpyDiscountTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpyDiscountTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpyDiscountTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpyDiscountTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPool object
     *
     * @param \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPool|ObjectCollection $spyDiscountVoucherPool The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByVoucherPool($spyDiscountVoucherPool, ?string $comparison = null)
    {
        if ($spyDiscountVoucherPool instanceof \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPool) {
            return $this
                ->addUsingAlias(SpyDiscountTableMap::COL_FK_DISCOUNT_VOUCHER_POOL, $spyDiscountVoucherPool->getIdDiscountVoucherPool(), $comparison);
        } elseif ($spyDiscountVoucherPool instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyDiscountTableMap::COL_FK_DISCOUNT_VOUCHER_POOL, $spyDiscountVoucherPool->toKeyValue('PrimaryKey', 'IdDiscountVoucherPool'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByVoucherPool() only accepts arguments of type \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPool or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the VoucherPool relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinVoucherPool(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('VoucherPool');

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
            $this->addJoinObject($join, 'VoucherPool');
        }

        return $this;
    }

    /**
     * Use the VoucherPool relation SpyDiscountVoucherPool object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery A secondary query class using the current class as primary query
     */
    public function useVoucherPoolQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinVoucherPool($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'VoucherPool', '\Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery');
    }

    /**
     * Use the VoucherPool relation SpyDiscountVoucherPool object
     *
     * @param callable(\Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery):\Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withVoucherPoolQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useVoucherPoolQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the VoucherPool relation to the SpyDiscountVoucherPool table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery The inner query object of the EXISTS statement
     */
    public function useVoucherPoolExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery */
        $q = $this->useExistsQuery('VoucherPool', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the VoucherPool relation to the SpyDiscountVoucherPool table for a NOT EXISTS query.
     *
     * @see useVoucherPoolExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery The inner query object of the NOT EXISTS statement
     */
    public function useVoucherPoolNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery */
        $q = $this->useExistsQuery('VoucherPool', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the VoucherPool relation to the SpyDiscountVoucherPool table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery The inner query object of the IN statement
     */
    public function useInVoucherPoolQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery */
        $q = $this->useInQuery('VoucherPool', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the VoucherPool relation to the SpyDiscountVoucherPool table for a NOT IN query.
     *
     * @see useVoucherPoolInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery The inner query object of the NOT IN statement
     */
    public function useNotInVoucherPoolQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountVoucherPoolQuery */
        $q = $this->useInQuery('VoucherPool', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Store\Persistence\SpyStore object
     *
     * @param \Orm\Zed\Store\Persistence\SpyStore|ObjectCollection $spyStore The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByStore($spyStore, ?string $comparison = null)
    {
        if ($spyStore instanceof \Orm\Zed\Store\Persistence\SpyStore) {
            return $this
                ->addUsingAlias(SpyDiscountTableMap::COL_FK_STORE, $spyStore->getIdStore(), $comparison);
        } elseif ($spyStore instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpyDiscountTableMap::COL_FK_STORE, $spyStore->toKeyValue('PrimaryKey', 'IdStore'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByStore() only accepts arguments of type \Orm\Zed\Store\Persistence\SpyStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Store relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinStore(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Store');

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
            $this->addJoinObject($join, 'Store');
        }

        return $this;
    }

    /**
     * Use the Store relation SpyStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Store\Persistence\SpyStoreQuery A secondary query class using the current class as primary query
     */
    public function useStoreQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Store', '\Orm\Zed\Store\Persistence\SpyStoreQuery');
    }

    /**
     * Use the Store relation SpyStore object
     *
     * @param callable(\Orm\Zed\Store\Persistence\SpyStoreQuery):\Orm\Zed\Store\Persistence\SpyStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Store relation to the SpyStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Store\Persistence\SpyStoreQuery The inner query object of the EXISTS statement
     */
    public function useStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Store\Persistence\SpyStoreQuery */
        $q = $this->useExistsQuery('Store', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Store relation to the SpyStore table for a NOT EXISTS query.
     *
     * @see useStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Store\Persistence\SpyStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Store\Persistence\SpyStoreQuery */
        $q = $this->useExistsQuery('Store', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Store relation to the SpyStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Store\Persistence\SpyStoreQuery The inner query object of the IN statement
     */
    public function useInStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Store\Persistence\SpyStoreQuery */
        $q = $this->useInQuery('Store', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Store relation to the SpyStore table for a NOT IN query.
     *
     * @see useStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Store\Persistence\SpyStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Store\Persistence\SpyStoreQuery */
        $q = $this->useInQuery('Store', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscount object
     *
     * @param \Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscount|ObjectCollection $spyCustomerDiscount the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyCustomerDiscount($spyCustomerDiscount, ?string $comparison = null)
    {
        if ($spyCustomerDiscount instanceof \Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscount) {
            $this
                ->addUsingAlias(SpyDiscountTableMap::COL_ID_DISCOUNT, $spyCustomerDiscount->getFkDiscount(), $comparison);

            return $this;
        } elseif ($spyCustomerDiscount instanceof ObjectCollection) {
            $this
                ->useSpyCustomerDiscountQuery()
                ->filterByPrimaryKeys($spyCustomerDiscount->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyCustomerDiscount() only accepts arguments of type \Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscount or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyCustomerDiscount relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyCustomerDiscount(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyCustomerDiscount');

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
            $this->addJoinObject($join, 'SpyCustomerDiscount');
        }

        return $this;
    }

    /**
     * Use the SpyCustomerDiscount relation SpyCustomerDiscount object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscountQuery A secondary query class using the current class as primary query
     */
    public function useSpyCustomerDiscountQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyCustomerDiscount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyCustomerDiscount', '\Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscountQuery');
    }

    /**
     * Use the SpyCustomerDiscount relation SpyCustomerDiscount object
     *
     * @param callable(\Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscountQuery):\Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscountQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyCustomerDiscountQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyCustomerDiscountQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyCustomerDiscount table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscountQuery The inner query object of the EXISTS statement
     */
    public function useSpyCustomerDiscountExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscountQuery */
        $q = $this->useExistsQuery('SpyCustomerDiscount', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyCustomerDiscount table for a NOT EXISTS query.
     *
     * @see useSpyCustomerDiscountExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscountQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyCustomerDiscountNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscountQuery */
        $q = $this->useExistsQuery('SpyCustomerDiscount', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyCustomerDiscount table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscountQuery The inner query object of the IN statement
     */
    public function useInSpyCustomerDiscountQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscountQuery */
        $q = $this->useInQuery('SpyCustomerDiscount', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyCustomerDiscount table for a NOT IN query.
     *
     * @see useSpyCustomerDiscountInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscountQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyCustomerDiscountQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\CustomerDiscountConnector\Persistence\SpyCustomerDiscountQuery */
        $q = $this->useInQuery('SpyCustomerDiscount', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Discount\Persistence\SpyDiscountStore object
     *
     * @param \Orm\Zed\Discount\Persistence\SpyDiscountStore|ObjectCollection $spyDiscountStore the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySpyDiscountStore($spyDiscountStore, ?string $comparison = null)
    {
        if ($spyDiscountStore instanceof \Orm\Zed\Discount\Persistence\SpyDiscountStore) {
            $this
                ->addUsingAlias(SpyDiscountTableMap::COL_ID_DISCOUNT, $spyDiscountStore->getFkDiscount(), $comparison);

            return $this;
        } elseif ($spyDiscountStore instanceof ObjectCollection) {
            $this
                ->useSpyDiscountStoreQuery()
                ->filterByPrimaryKeys($spyDiscountStore->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterBySpyDiscountStore() only accepts arguments of type \Orm\Zed\Discount\Persistence\SpyDiscountStore or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SpyDiscountStore relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSpyDiscountStore(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SpyDiscountStore');

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
            $this->addJoinObject($join, 'SpyDiscountStore');
        }

        return $this;
    }

    /**
     * Use the SpyDiscountStore relation SpyDiscountStore object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery A secondary query class using the current class as primary query
     */
    public function useSpyDiscountStoreQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSpyDiscountStore($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SpyDiscountStore', '\Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery');
    }

    /**
     * Use the SpyDiscountStore relation SpyDiscountStore object
     *
     * @param callable(\Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery):\Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSpyDiscountStoreQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSpyDiscountStoreQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to SpyDiscountStore table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery The inner query object of the EXISTS statement
     */
    public function useSpyDiscountStoreExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery */
        $q = $this->useExistsQuery('SpyDiscountStore', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to SpyDiscountStore table for a NOT EXISTS query.
     *
     * @see useSpyDiscountStoreExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery The inner query object of the NOT EXISTS statement
     */
    public function useSpyDiscountStoreNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery */
        $q = $this->useExistsQuery('SpyDiscountStore', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to SpyDiscountStore table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery The inner query object of the IN statement
     */
    public function useInSpyDiscountStoreQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery */
        $q = $this->useInQuery('SpyDiscountStore', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to SpyDiscountStore table for a NOT IN query.
     *
     * @see useSpyDiscountStoreInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery The inner query object of the NOT IN statement
     */
    public function useNotInSpyDiscountStoreQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountStoreQuery */
        $q = $this->useInQuery('SpyDiscountStore', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Discount\Persistence\SpyDiscountAmount object
     *
     * @param \Orm\Zed\Discount\Persistence\SpyDiscountAmount|ObjectCollection $spyDiscountAmount the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscountAmount($spyDiscountAmount, ?string $comparison = null)
    {
        if ($spyDiscountAmount instanceof \Orm\Zed\Discount\Persistence\SpyDiscountAmount) {
            $this
                ->addUsingAlias(SpyDiscountTableMap::COL_ID_DISCOUNT, $spyDiscountAmount->getFkDiscount(), $comparison);

            return $this;
        } elseif ($spyDiscountAmount instanceof ObjectCollection) {
            $this
                ->useDiscountAmountQuery()
                ->filterByPrimaryKeys($spyDiscountAmount->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDiscountAmount() only accepts arguments of type \Orm\Zed\Discount\Persistence\SpyDiscountAmount or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DiscountAmount relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDiscountAmount(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DiscountAmount');

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
            $this->addJoinObject($join, 'DiscountAmount');
        }

        return $this;
    }

    /**
     * Use the DiscountAmount relation SpyDiscountAmount object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountAmountQuery A secondary query class using the current class as primary query
     */
    public function useDiscountAmountQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDiscountAmount($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DiscountAmount', '\Orm\Zed\Discount\Persistence\SpyDiscountAmountQuery');
    }

    /**
     * Use the DiscountAmount relation SpyDiscountAmount object
     *
     * @param callable(\Orm\Zed\Discount\Persistence\SpyDiscountAmountQuery):\Orm\Zed\Discount\Persistence\SpyDiscountAmountQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDiscountAmountQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useDiscountAmountQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the DiscountAmount relation to the SpyDiscountAmount table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountAmountQuery The inner query object of the EXISTS statement
     */
    public function useDiscountAmountExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountAmountQuery */
        $q = $this->useExistsQuery('DiscountAmount', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the DiscountAmount relation to the SpyDiscountAmount table for a NOT EXISTS query.
     *
     * @see useDiscountAmountExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountAmountQuery The inner query object of the NOT EXISTS statement
     */
    public function useDiscountAmountNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountAmountQuery */
        $q = $this->useExistsQuery('DiscountAmount', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the DiscountAmount relation to the SpyDiscountAmount table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountAmountQuery The inner query object of the IN statement
     */
    public function useInDiscountAmountQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountAmountQuery */
        $q = $this->useInQuery('DiscountAmount', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the DiscountAmount relation to the SpyDiscountAmount table for a NOT IN query.
     *
     * @see useDiscountAmountInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Discount\Persistence\SpyDiscountAmountQuery The inner query object of the NOT IN statement
     */
    public function useNotInDiscountAmountQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Discount\Persistence\SpyDiscountAmountQuery */
        $q = $this->useInQuery('DiscountAmount', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotion object
     *
     * @param \Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotion|ObjectCollection $spyDiscountPromotion the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDiscountPromotion($spyDiscountPromotion, ?string $comparison = null)
    {
        if ($spyDiscountPromotion instanceof \Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotion) {
            $this
                ->addUsingAlias(SpyDiscountTableMap::COL_ID_DISCOUNT, $spyDiscountPromotion->getFkDiscount(), $comparison);

            return $this;
        } elseif ($spyDiscountPromotion instanceof ObjectCollection) {
            $this
                ->useDiscountPromotionQuery()
                ->filterByPrimaryKeys($spyDiscountPromotion->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByDiscountPromotion() only accepts arguments of type \Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the DiscountPromotion relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinDiscountPromotion(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('DiscountPromotion');

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
            $this->addJoinObject($join, 'DiscountPromotion');
        }

        return $this;
    }

    /**
     * Use the DiscountPromotion relation SpyDiscountPromotion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotionQuery A secondary query class using the current class as primary query
     */
    public function useDiscountPromotionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDiscountPromotion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'DiscountPromotion', '\Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotionQuery');
    }

    /**
     * Use the DiscountPromotion relation SpyDiscountPromotion object
     *
     * @param callable(\Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotionQuery):\Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDiscountPromotionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useDiscountPromotionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the DiscountPromotion relation to the SpyDiscountPromotion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotionQuery The inner query object of the EXISTS statement
     */
    public function useDiscountPromotionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotionQuery */
        $q = $this->useExistsQuery('DiscountPromotion', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the DiscountPromotion relation to the SpyDiscountPromotion table for a NOT EXISTS query.
     *
     * @see useDiscountPromotionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotionQuery The inner query object of the NOT EXISTS statement
     */
    public function useDiscountPromotionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotionQuery */
        $q = $this->useExistsQuery('DiscountPromotion', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the DiscountPromotion relation to the SpyDiscountPromotion table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotionQuery The inner query object of the IN statement
     */
    public function useInDiscountPromotionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotionQuery */
        $q = $this->useInQuery('DiscountPromotion', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the DiscountPromotion relation to the SpyDiscountPromotion table for a NOT IN query.
     *
     * @see useDiscountPromotionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotionQuery The inner query object of the NOT IN statement
     */
    public function useNotInDiscountPromotionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotionQuery */
        $q = $this->useInQuery('DiscountPromotion', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpyDiscount $spyDiscount Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spyDiscount = null)
    {
        if ($spyDiscount) {
            $this->addUsingAlias(SpyDiscountTableMap::COL_ID_DISCOUNT, $spyDiscount->getIdDiscount(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_discount table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDiscountTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpyDiscountTableMap::clearInstancePool();
            SpyDiscountTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDiscountTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpyDiscountTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpyDiscountTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpyDiscountTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpyDiscountTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyDiscountTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyDiscountTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpyDiscountTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpyDiscountTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpyDiscountTableMap::COL_CREATED_AT);

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
