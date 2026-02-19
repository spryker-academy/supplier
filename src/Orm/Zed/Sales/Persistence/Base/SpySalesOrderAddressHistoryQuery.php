<?php

namespace Orm\Zed\Sales\Persistence\Base;

use \Exception;
use \PDO;
use Orm\Zed\Country\Persistence\SpyCountry;
use Orm\Zed\Country\Persistence\SpyRegion;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistory as ChildSpySalesOrderAddressHistory;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistoryQuery as ChildSpySalesOrderAddressHistoryQuery;
use Orm\Zed\Sales\Persistence\Map\SpySalesOrderAddressHistoryTableMap;
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
 * Base class that represents a query for the `spy_sales_order_address_history` table.
 *
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByIdSalesOrderAddressHistory($order = Criteria::ASC) Order by the id_sales_order_address_history column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByFkCountry($order = Criteria::ASC) Order by the fk_country column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByFkRegion($order = Criteria::ASC) Order by the fk_region column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByFkSalesOrderAddress($order = Criteria::ASC) Order by the fk_sales_order_address column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByAddress1($order = Criteria::ASC) Order by the address1 column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByAddress2($order = Criteria::ASC) Order by the address2 column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByAddress3($order = Criteria::ASC) Order by the address3 column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByCellPhone($order = Criteria::ASC) Order by the cell_phone column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByCity($order = Criteria::ASC) Order by the city column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByComment($order = Criteria::ASC) Order by the comment column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByCompany($order = Criteria::ASC) Order by the company column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByFirstName($order = Criteria::ASC) Order by the first_name column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByIsBilling($order = Criteria::ASC) Order by the is_billing column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByLastName($order = Criteria::ASC) Order by the last_name column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByMiddleName($order = Criteria::ASC) Order by the middle_name column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByPoBox($order = Criteria::ASC) Order by the po_box column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderBySalutation($order = Criteria::ASC) Order by the salutation column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByZipCode($order = Criteria::ASC) Order by the zip_code column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildSpySalesOrderAddressHistoryQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByIdSalesOrderAddressHistory() Group by the id_sales_order_address_history column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByFkCountry() Group by the fk_country column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByFkRegion() Group by the fk_region column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByFkSalesOrderAddress() Group by the fk_sales_order_address column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByAddress1() Group by the address1 column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByAddress2() Group by the address2 column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByAddress3() Group by the address3 column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByCellPhone() Group by the cell_phone column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByCity() Group by the city column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByComment() Group by the comment column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByCompany() Group by the company column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByDescription() Group by the description column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByEmail() Group by the email column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByFirstName() Group by the first_name column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByIsBilling() Group by the is_billing column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByLastName() Group by the last_name column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByMiddleName() Group by the middle_name column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByPhone() Group by the phone column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByPoBox() Group by the po_box column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupBySalutation() Group by the salutation column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByZipCode() Group by the zip_code column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildSpySalesOrderAddressHistoryQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildSpySalesOrderAddressHistoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSpySalesOrderAddressHistoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSpySalesOrderAddressHistoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSpySalesOrderAddressHistoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSpySalesOrderAddressHistoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSpySalesOrderAddressHistoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSpySalesOrderAddressHistoryQuery leftJoinCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Country relation
 * @method     ChildSpySalesOrderAddressHistoryQuery rightJoinCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Country relation
 * @method     ChildSpySalesOrderAddressHistoryQuery innerJoinCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the Country relation
 *
 * @method     ChildSpySalesOrderAddressHistoryQuery joinWithCountry($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Country relation
 *
 * @method     ChildSpySalesOrderAddressHistoryQuery leftJoinWithCountry() Adds a LEFT JOIN clause and with to the query using the Country relation
 * @method     ChildSpySalesOrderAddressHistoryQuery rightJoinWithCountry() Adds a RIGHT JOIN clause and with to the query using the Country relation
 * @method     ChildSpySalesOrderAddressHistoryQuery innerJoinWithCountry() Adds a INNER JOIN clause and with to the query using the Country relation
 *
 * @method     ChildSpySalesOrderAddressHistoryQuery leftJoinSalesOrderAddress($relationAlias = null) Adds a LEFT JOIN clause to the query using the SalesOrderAddress relation
 * @method     ChildSpySalesOrderAddressHistoryQuery rightJoinSalesOrderAddress($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SalesOrderAddress relation
 * @method     ChildSpySalesOrderAddressHistoryQuery innerJoinSalesOrderAddress($relationAlias = null) Adds a INNER JOIN clause to the query using the SalesOrderAddress relation
 *
 * @method     ChildSpySalesOrderAddressHistoryQuery joinWithSalesOrderAddress($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the SalesOrderAddress relation
 *
 * @method     ChildSpySalesOrderAddressHistoryQuery leftJoinWithSalesOrderAddress() Adds a LEFT JOIN clause and with to the query using the SalesOrderAddress relation
 * @method     ChildSpySalesOrderAddressHistoryQuery rightJoinWithSalesOrderAddress() Adds a RIGHT JOIN clause and with to the query using the SalesOrderAddress relation
 * @method     ChildSpySalesOrderAddressHistoryQuery innerJoinWithSalesOrderAddress() Adds a INNER JOIN clause and with to the query using the SalesOrderAddress relation
 *
 * @method     ChildSpySalesOrderAddressHistoryQuery leftJoinRegion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Region relation
 * @method     ChildSpySalesOrderAddressHistoryQuery rightJoinRegion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Region relation
 * @method     ChildSpySalesOrderAddressHistoryQuery innerJoinRegion($relationAlias = null) Adds a INNER JOIN clause to the query using the Region relation
 *
 * @method     ChildSpySalesOrderAddressHistoryQuery joinWithRegion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Region relation
 *
 * @method     ChildSpySalesOrderAddressHistoryQuery leftJoinWithRegion() Adds a LEFT JOIN clause and with to the query using the Region relation
 * @method     ChildSpySalesOrderAddressHistoryQuery rightJoinWithRegion() Adds a RIGHT JOIN clause and with to the query using the Region relation
 * @method     ChildSpySalesOrderAddressHistoryQuery innerJoinWithRegion() Adds a INNER JOIN clause and with to the query using the Region relation
 *
 * @method     \Orm\Zed\Country\Persistence\SpyCountryQuery|\Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery|\Orm\Zed\Country\Persistence\SpyRegionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSpySalesOrderAddressHistory|null findOne(?ConnectionInterface $con = null) Return the first ChildSpySalesOrderAddressHistory matching the query
 * @method     ChildSpySalesOrderAddressHistory findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildSpySalesOrderAddressHistory matching the query, or a new ChildSpySalesOrderAddressHistory object populated from the query conditions when no match is found
 *
 * @method     ChildSpySalesOrderAddressHistory|null findOneByIdSalesOrderAddressHistory(int $id_sales_order_address_history) Return the first ChildSpySalesOrderAddressHistory filtered by the id_sales_order_address_history column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByFkCountry(int $fk_country) Return the first ChildSpySalesOrderAddressHistory filtered by the fk_country column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByFkRegion(int $fk_region) Return the first ChildSpySalesOrderAddressHistory filtered by the fk_region column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByFkSalesOrderAddress(int $fk_sales_order_address) Return the first ChildSpySalesOrderAddressHistory filtered by the fk_sales_order_address column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByAddress1(string $address1) Return the first ChildSpySalesOrderAddressHistory filtered by the address1 column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByAddress2(string $address2) Return the first ChildSpySalesOrderAddressHistory filtered by the address2 column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByAddress3(string $address3) Return the first ChildSpySalesOrderAddressHistory filtered by the address3 column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByCellPhone(string $cell_phone) Return the first ChildSpySalesOrderAddressHistory filtered by the cell_phone column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByCity(string $city) Return the first ChildSpySalesOrderAddressHistory filtered by the city column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByComment(string $comment) Return the first ChildSpySalesOrderAddressHistory filtered by the comment column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByCompany(string $company) Return the first ChildSpySalesOrderAddressHistory filtered by the company column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByDescription(string $description) Return the first ChildSpySalesOrderAddressHistory filtered by the description column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByEmail(string $email) Return the first ChildSpySalesOrderAddressHistory filtered by the email column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByFirstName(string $first_name) Return the first ChildSpySalesOrderAddressHistory filtered by the first_name column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByIsBilling(boolean $is_billing) Return the first ChildSpySalesOrderAddressHistory filtered by the is_billing column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByLastName(string $last_name) Return the first ChildSpySalesOrderAddressHistory filtered by the last_name column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByMiddleName(string $middle_name) Return the first ChildSpySalesOrderAddressHistory filtered by the middle_name column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByPhone(string $phone) Return the first ChildSpySalesOrderAddressHistory filtered by the phone column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByPoBox(string $po_box) Return the first ChildSpySalesOrderAddressHistory filtered by the po_box column
 * @method     ChildSpySalesOrderAddressHistory|null findOneBySalutation(int $salutation) Return the first ChildSpySalesOrderAddressHistory filtered by the salutation column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByZipCode(string $zip_code) Return the first ChildSpySalesOrderAddressHistory filtered by the zip_code column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByCreatedAt(string $created_at) Return the first ChildSpySalesOrderAddressHistory filtered by the created_at column
 * @method     ChildSpySalesOrderAddressHistory|null findOneByUpdatedAt(string $updated_at) Return the first ChildSpySalesOrderAddressHistory filtered by the updated_at column
 *
 * @method     ChildSpySalesOrderAddressHistory requirePk($key, ?ConnectionInterface $con = null) Return the ChildSpySalesOrderAddressHistory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOne(?ConnectionInterface $con = null) Return the first ChildSpySalesOrderAddressHistory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySalesOrderAddressHistory requireOneByIdSalesOrderAddressHistory(int $id_sales_order_address_history) Return the first ChildSpySalesOrderAddressHistory filtered by the id_sales_order_address_history column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByFkCountry(int $fk_country) Return the first ChildSpySalesOrderAddressHistory filtered by the fk_country column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByFkRegion(int $fk_region) Return the first ChildSpySalesOrderAddressHistory filtered by the fk_region column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByFkSalesOrderAddress(int $fk_sales_order_address) Return the first ChildSpySalesOrderAddressHistory filtered by the fk_sales_order_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByAddress1(string $address1) Return the first ChildSpySalesOrderAddressHistory filtered by the address1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByAddress2(string $address2) Return the first ChildSpySalesOrderAddressHistory filtered by the address2 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByAddress3(string $address3) Return the first ChildSpySalesOrderAddressHistory filtered by the address3 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByCellPhone(string $cell_phone) Return the first ChildSpySalesOrderAddressHistory filtered by the cell_phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByCity(string $city) Return the first ChildSpySalesOrderAddressHistory filtered by the city column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByComment(string $comment) Return the first ChildSpySalesOrderAddressHistory filtered by the comment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByCompany(string $company) Return the first ChildSpySalesOrderAddressHistory filtered by the company column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByDescription(string $description) Return the first ChildSpySalesOrderAddressHistory filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByEmail(string $email) Return the first ChildSpySalesOrderAddressHistory filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByFirstName(string $first_name) Return the first ChildSpySalesOrderAddressHistory filtered by the first_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByIsBilling(boolean $is_billing) Return the first ChildSpySalesOrderAddressHistory filtered by the is_billing column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByLastName(string $last_name) Return the first ChildSpySalesOrderAddressHistory filtered by the last_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByMiddleName(string $middle_name) Return the first ChildSpySalesOrderAddressHistory filtered by the middle_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByPhone(string $phone) Return the first ChildSpySalesOrderAddressHistory filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByPoBox(string $po_box) Return the first ChildSpySalesOrderAddressHistory filtered by the po_box column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneBySalutation(int $salutation) Return the first ChildSpySalesOrderAddressHistory filtered by the salutation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByZipCode(string $zip_code) Return the first ChildSpySalesOrderAddressHistory filtered by the zip_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByCreatedAt(string $created_at) Return the first ChildSpySalesOrderAddressHistory filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSpySalesOrderAddressHistory requireOneByUpdatedAt(string $updated_at) Return the first ChildSpySalesOrderAddressHistory filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSpySalesOrderAddressHistory[]|Collection find(?ConnectionInterface $con = null) Return ChildSpySalesOrderAddressHistory objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> find(?ConnectionInterface $con = null) Return ChildSpySalesOrderAddressHistory objects based on current ModelCriteria
 *
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByIdSalesOrderAddressHistory(int|array<int> $id_sales_order_address_history) Return ChildSpySalesOrderAddressHistory objects filtered by the id_sales_order_address_history column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByIdSalesOrderAddressHistory(int|array<int> $id_sales_order_address_history) Return ChildSpySalesOrderAddressHistory objects filtered by the id_sales_order_address_history column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByFkCountry(int|array<int> $fk_country) Return ChildSpySalesOrderAddressHistory objects filtered by the fk_country column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByFkCountry(int|array<int> $fk_country) Return ChildSpySalesOrderAddressHistory objects filtered by the fk_country column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByFkRegion(int|array<int> $fk_region) Return ChildSpySalesOrderAddressHistory objects filtered by the fk_region column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByFkRegion(int|array<int> $fk_region) Return ChildSpySalesOrderAddressHistory objects filtered by the fk_region column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByFkSalesOrderAddress(int|array<int> $fk_sales_order_address) Return ChildSpySalesOrderAddressHistory objects filtered by the fk_sales_order_address column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByFkSalesOrderAddress(int|array<int> $fk_sales_order_address) Return ChildSpySalesOrderAddressHistory objects filtered by the fk_sales_order_address column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByAddress1(string|array<string> $address1) Return ChildSpySalesOrderAddressHistory objects filtered by the address1 column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByAddress1(string|array<string> $address1) Return ChildSpySalesOrderAddressHistory objects filtered by the address1 column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByAddress2(string|array<string> $address2) Return ChildSpySalesOrderAddressHistory objects filtered by the address2 column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByAddress2(string|array<string> $address2) Return ChildSpySalesOrderAddressHistory objects filtered by the address2 column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByAddress3(string|array<string> $address3) Return ChildSpySalesOrderAddressHistory objects filtered by the address3 column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByAddress3(string|array<string> $address3) Return ChildSpySalesOrderAddressHistory objects filtered by the address3 column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByCellPhone(string|array<string> $cell_phone) Return ChildSpySalesOrderAddressHistory objects filtered by the cell_phone column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByCellPhone(string|array<string> $cell_phone) Return ChildSpySalesOrderAddressHistory objects filtered by the cell_phone column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByCity(string|array<string> $city) Return ChildSpySalesOrderAddressHistory objects filtered by the city column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByCity(string|array<string> $city) Return ChildSpySalesOrderAddressHistory objects filtered by the city column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByComment(string|array<string> $comment) Return ChildSpySalesOrderAddressHistory objects filtered by the comment column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByComment(string|array<string> $comment) Return ChildSpySalesOrderAddressHistory objects filtered by the comment column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByCompany(string|array<string> $company) Return ChildSpySalesOrderAddressHistory objects filtered by the company column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByCompany(string|array<string> $company) Return ChildSpySalesOrderAddressHistory objects filtered by the company column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByDescription(string|array<string> $description) Return ChildSpySalesOrderAddressHistory objects filtered by the description column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByDescription(string|array<string> $description) Return ChildSpySalesOrderAddressHistory objects filtered by the description column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByEmail(string|array<string> $email) Return ChildSpySalesOrderAddressHistory objects filtered by the email column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByEmail(string|array<string> $email) Return ChildSpySalesOrderAddressHistory objects filtered by the email column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByFirstName(string|array<string> $first_name) Return ChildSpySalesOrderAddressHistory objects filtered by the first_name column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByFirstName(string|array<string> $first_name) Return ChildSpySalesOrderAddressHistory objects filtered by the first_name column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByIsBilling(boolean|array<boolean> $is_billing) Return ChildSpySalesOrderAddressHistory objects filtered by the is_billing column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByIsBilling(boolean|array<boolean> $is_billing) Return ChildSpySalesOrderAddressHistory objects filtered by the is_billing column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByLastName(string|array<string> $last_name) Return ChildSpySalesOrderAddressHistory objects filtered by the last_name column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByLastName(string|array<string> $last_name) Return ChildSpySalesOrderAddressHistory objects filtered by the last_name column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByMiddleName(string|array<string> $middle_name) Return ChildSpySalesOrderAddressHistory objects filtered by the middle_name column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByMiddleName(string|array<string> $middle_name) Return ChildSpySalesOrderAddressHistory objects filtered by the middle_name column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByPhone(string|array<string> $phone) Return ChildSpySalesOrderAddressHistory objects filtered by the phone column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByPhone(string|array<string> $phone) Return ChildSpySalesOrderAddressHistory objects filtered by the phone column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByPoBox(string|array<string> $po_box) Return ChildSpySalesOrderAddressHistory objects filtered by the po_box column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByPoBox(string|array<string> $po_box) Return ChildSpySalesOrderAddressHistory objects filtered by the po_box column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findBySalutation(int|array<int> $salutation) Return ChildSpySalesOrderAddressHistory objects filtered by the salutation column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findBySalutation(int|array<int> $salutation) Return ChildSpySalesOrderAddressHistory objects filtered by the salutation column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByZipCode(string|array<string> $zip_code) Return ChildSpySalesOrderAddressHistory objects filtered by the zip_code column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByZipCode(string|array<string> $zip_code) Return ChildSpySalesOrderAddressHistory objects filtered by the zip_code column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByCreatedAt(string|array<string> $created_at) Return ChildSpySalesOrderAddressHistory objects filtered by the created_at column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByCreatedAt(string|array<string> $created_at) Return ChildSpySalesOrderAddressHistory objects filtered by the created_at column
 * @method     ChildSpySalesOrderAddressHistory[]|Collection findByUpdatedAt(string|array<string> $updated_at) Return ChildSpySalesOrderAddressHistory objects filtered by the updated_at column
 * @psalm-method Collection&\Traversable<ChildSpySalesOrderAddressHistory> findByUpdatedAt(string|array<string> $updated_at) Return ChildSpySalesOrderAddressHistory objects filtered by the updated_at column
 *
 * @method     ChildSpySalesOrderAddressHistory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildSpySalesOrderAddressHistory> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class SpySalesOrderAddressHistoryQuery extends ModelCriteria
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
     * Initializes internal state of \Orm\Zed\Sales\Persistence\Base\SpySalesOrderAddressHistoryQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'zed', $modelName = '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderAddressHistory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSpySalesOrderAddressHistoryQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSpySalesOrderAddressHistoryQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildSpySalesOrderAddressHistoryQuery) {
            return $criteria;
        }
        $query = new ChildSpySalesOrderAddressHistoryQuery();
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
     * @return ChildSpySalesOrderAddressHistory|array|mixed the result, formatted by the current formatter
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

        if ((null !== ($obj = SpySalesOrderAddressHistoryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildSpySalesOrderAddressHistory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_sales_order_address_history, fk_country, fk_region, fk_sales_order_address, address1, address2, address3, cell_phone, city, comment, company, description, email, first_name, is_billing, last_name, middle_name, phone, po_box, salutation, zip_code, created_at, updated_at FROM spy_sales_order_address_history WHERE id_sales_order_address_history = :p0';
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
            /** @var ChildSpySalesOrderAddressHistory $obj */
            $obj = new ChildSpySalesOrderAddressHistory();
            $obj->hydrate($row);
            SpySalesOrderAddressHistoryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildSpySalesOrderAddressHistory|array|mixed the result, formatted by the current formatter
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

        $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_ID_SALES_ORDER_ADDRESS_HISTORY, $key, Criteria::EQUAL);

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

        $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_ID_SALES_ORDER_ADDRESS_HISTORY, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $idSalesOrderAddressHistory Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSalesOrderAddressHistory_Between(array $idSalesOrderAddressHistory)
    {
        return $this->filterByIdSalesOrderAddressHistory($idSalesOrderAddressHistory, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $idSalesOrderAddressHistorys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByIdSalesOrderAddressHistory_In(array $idSalesOrderAddressHistorys)
    {
        return $this->filterByIdSalesOrderAddressHistory($idSalesOrderAddressHistorys, Criteria::IN);
    }

    /**
     * Filter the query on the id_sales_order_address_history column
     *
     * Example usage:
     * <code>
     * $query->filterByIdSalesOrderAddressHistory(1234); // WHERE id_sales_order_address_history = 1234
     * $query->filterByIdSalesOrderAddressHistory(array(12, 34), Criteria::IN); // WHERE id_sales_order_address_history IN (12, 34)
     * $query->filterByIdSalesOrderAddressHistory(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE id_sales_order_address_history > 12
     * </code>
     *
     * @param     mixed $idSalesOrderAddressHistory The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByIdSalesOrderAddressHistory($idSalesOrderAddressHistory = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($idSalesOrderAddressHistory)) {
            $useMinMax = false;
            if (isset($idSalesOrderAddressHistory['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_ID_SALES_ORDER_ADDRESS_HISTORY, $idSalesOrderAddressHistory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSalesOrderAddressHistory['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_ID_SALES_ORDER_ADDRESS_HISTORY, $idSalesOrderAddressHistory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$idSalesOrderAddressHistory of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_ID_SALES_ORDER_ADDRESS_HISTORY, $idSalesOrderAddressHistory, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkCountry Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCountry_Between(array $fkCountry)
    {
        return $this->filterByFkCountry($fkCountry, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkCountrys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkCountry_In(array $fkCountrys)
    {
        return $this->filterByFkCountry($fkCountrys, Criteria::IN);
    }

    /**
     * Filter the query on the fk_country column
     *
     * Example usage:
     * <code>
     * $query->filterByFkCountry(1234); // WHERE fk_country = 1234
     * $query->filterByFkCountry(array(12, 34), Criteria::IN); // WHERE fk_country IN (12, 34)
     * $query->filterByFkCountry(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_country > 12
     * </code>
     *
     * @see       filterByCountry()
     *
     * @param     mixed $fkCountry The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkCountry($fkCountry = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkCountry)) {
            $useMinMax = false;
            if (isset($fkCountry['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_FK_COUNTRY, $fkCountry['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkCountry['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_FK_COUNTRY, $fkCountry['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkCountry of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_FK_COUNTRY, $fkCountry, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkRegion Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkRegion_Between(array $fkRegion)
    {
        return $this->filterByFkRegion($fkRegion, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkRegions Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkRegion_In(array $fkRegions)
    {
        return $this->filterByFkRegion($fkRegions, Criteria::IN);
    }

    /**
     * Filter the query on the fk_region column
     *
     * Example usage:
     * <code>
     * $query->filterByFkRegion(1234); // WHERE fk_region = 1234
     * $query->filterByFkRegion(array(12, 34), Criteria::IN); // WHERE fk_region IN (12, 34)
     * $query->filterByFkRegion(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_region > 12
     * </code>
     *
     * @see       filterByRegion()
     *
     * @param     mixed $fkRegion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkRegion($fkRegion = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkRegion)) {
            $useMinMax = false;
            if (isset($fkRegion['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_FK_REGION, $fkRegion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkRegion['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_FK_REGION, $fkRegion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkRegion of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_FK_REGION, $fkRegion, $comparison);

        return $query;
    }

    /**
     * Applies SprykerCriteria::BETWEEN filtering criteria for the column.
     *
     * @param array $fkSalesOrderAddress Filter value.
     * [
     *    'min' => 3, 'max' => 5
     * ]
     *
     * 'min' and 'max' are optional, when neither is specified, throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSalesOrderAddress_Between(array $fkSalesOrderAddress)
    {
        return $this->filterByFkSalesOrderAddress($fkSalesOrderAddress, SprykerCriteria::BETWEEN);
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $fkSalesOrderAddresss Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFkSalesOrderAddress_In(array $fkSalesOrderAddresss)
    {
        return $this->filterByFkSalesOrderAddress($fkSalesOrderAddresss, Criteria::IN);
    }

    /**
     * Filter the query on the fk_sales_order_address column
     *
     * Example usage:
     * <code>
     * $query->filterByFkSalesOrderAddress(1234); // WHERE fk_sales_order_address = 1234
     * $query->filterByFkSalesOrderAddress(array(12, 34), Criteria::IN); // WHERE fk_sales_order_address IN (12, 34)
     * $query->filterByFkSalesOrderAddress(array('min' => 12), SprykerCriteria::BETWEEN); // WHERE fk_sales_order_address > 12
     * </code>
     *
     * @see       filterBySalesOrderAddress()
     *
     * @param     mixed $fkSalesOrderAddress The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent. Add Criteria::IN explicitly.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals. Add SprykerCriteria::BETWEEN explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFkSalesOrderAddress($fkSalesOrderAddress = null, $comparison = Criteria::EQUAL)
    {

        if (is_array($fkSalesOrderAddress)) {
            $useMinMax = false;
            if (isset($fkSalesOrderAddress['min'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::GREATER_EQUAL && $comparison != Criteria::GREATER_THAN) {
                    throw new AmbiguousComparisonException('\'min\' requires explicit Criteria::GREATER_EQUAL, Criteria::GREATER_THAN or SprykerCriteria::BETWEEN when \'max\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_FK_SALES_ORDER_ADDRESS, $fkSalesOrderAddress['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkSalesOrderAddress['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_FK_SALES_ORDER_ADDRESS, $fkSalesOrderAddress['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$fkSalesOrderAddress of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_FK_SALES_ORDER_ADDRESS, $fkSalesOrderAddress, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $address1s Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress1_In(array $address1s)
    {
        return $this->filterByAddress1($address1s, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $address1 Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress1_Like($address1)
    {
        return $this->filterByAddress1($address1, Criteria::LIKE);
    }

    /**
     * Filter the query on the address1 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress1('fooValue');   // WHERE address1 = 'fooValue'
     * $query->filterByAddress1('%fooValue%', Criteria::LIKE); // WHERE address1 LIKE '%fooValue%'
     * $query->filterByAddress1([1, 'foo'], Criteria::IN); // WHERE address1 IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $address1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAddress1($address1 = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $address1 = str_replace('*', '%', $address1);
        }

        if (is_array($address1) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$address1 of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_ADDRESS1, $address1, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $address2s Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress2_In(array $address2s)
    {
        return $this->filterByAddress2($address2s, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $address2 Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress2_Like($address2)
    {
        return $this->filterByAddress2($address2, Criteria::LIKE);
    }

    /**
     * Filter the query on the address2 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress2('fooValue');   // WHERE address2 = 'fooValue'
     * $query->filterByAddress2('%fooValue%', Criteria::LIKE); // WHERE address2 LIKE '%fooValue%'
     * $query->filterByAddress2([1, 'foo'], Criteria::IN); // WHERE address2 IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $address2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAddress2($address2 = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $address2 = str_replace('*', '%', $address2);
        }

        if (is_array($address2) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$address2 of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_ADDRESS2, $address2, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $address3s Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress3_In(array $address3s)
    {
        return $this->filterByAddress3($address3s, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $address3 Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByAddress3_Like($address3)
    {
        return $this->filterByAddress3($address3, Criteria::LIKE);
    }

    /**
     * Filter the query on the address3 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress3('fooValue');   // WHERE address3 = 'fooValue'
     * $query->filterByAddress3('%fooValue%', Criteria::LIKE); // WHERE address3 LIKE '%fooValue%'
     * $query->filterByAddress3([1, 'foo'], Criteria::IN); // WHERE address3 IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $address3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByAddress3($address3 = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $address3 = str_replace('*', '%', $address3);
        }

        if (is_array($address3) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$address3 of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_ADDRESS3, $address3, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $cellPhones Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCellPhone_In(array $cellPhones)
    {
        return $this->filterByCellPhone($cellPhones, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $cellPhone Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCellPhone_Like($cellPhone)
    {
        return $this->filterByCellPhone($cellPhone, Criteria::LIKE);
    }

    /**
     * Filter the query on the cell_phone column
     *
     * Example usage:
     * <code>
     * $query->filterByCellPhone('fooValue');   // WHERE cell_phone = 'fooValue'
     * $query->filterByCellPhone('%fooValue%', Criteria::LIKE); // WHERE cell_phone LIKE '%fooValue%'
     * $query->filterByCellPhone([1, 'foo'], Criteria::IN); // WHERE cell_phone IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $cellPhone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCellPhone($cellPhone = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $cellPhone = str_replace('*', '%', $cellPhone);
        }

        if (is_array($cellPhone) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$cellPhone of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_CELL_PHONE, $cellPhone, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $citys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCity_In(array $citys)
    {
        return $this->filterByCity($citys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $city Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCity_Like($city)
    {
        return $this->filterByCity($city, Criteria::LIKE);
    }

    /**
     * Filter the query on the city column
     *
     * Example usage:
     * <code>
     * $query->filterByCity('fooValue');   // WHERE city = 'fooValue'
     * $query->filterByCity('%fooValue%', Criteria::LIKE); // WHERE city LIKE '%fooValue%'
     * $query->filterByCity([1, 'foo'], Criteria::IN); // WHERE city IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $city The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCity($city = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $city = str_replace('*', '%', $city);
        }

        if (is_array($city) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$city of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_CITY, $city, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $comments Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByComment_In(array $comments)
    {
        return $this->filterByComment($comments, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $comment Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByComment_Like($comment)
    {
        return $this->filterByComment($comment, Criteria::LIKE);
    }

    /**
     * Filter the query on the comment column
     *
     * Example usage:
     * <code>
     * $query->filterByComment('fooValue');   // WHERE comment = 'fooValue'
     * $query->filterByComment('%fooValue%', Criteria::LIKE); // WHERE comment LIKE '%fooValue%'
     * $query->filterByComment([1, 'foo'], Criteria::IN); // WHERE comment IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $comment The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByComment($comment = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $comment = str_replace('*', '%', $comment);
        }

        if (is_array($comment) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$comment of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_COMMENT, $comment, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $companys Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompany_In(array $companys)
    {
        return $this->filterByCompany($companys, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $company Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCompany_Like($company)
    {
        return $this->filterByCompany($company, Criteria::LIKE);
    }

    /**
     * Filter the query on the company column
     *
     * Example usage:
     * <code>
     * $query->filterByCompany('fooValue');   // WHERE company = 'fooValue'
     * $query->filterByCompany('%fooValue%', Criteria::LIKE); // WHERE company LIKE '%fooValue%'
     * $query->filterByCompany([1, 'foo'], Criteria::IN); // WHERE company IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $company The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByCompany($company = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $company = str_replace('*', '%', $company);
        }

        if (is_array($company) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$company of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_COMPANY, $company, $comparison);

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

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_DESCRIPTION, $description, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $emails Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail_In(array $emails)
    {
        return $this->filterByEmail($emails, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $email Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByEmail_Like($email)
    {
        return $this->filterByEmail($email, Criteria::LIKE);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * $query->filterByEmail([1, 'foo'], Criteria::IN); // WHERE email IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByEmail($email = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $email = str_replace('*', '%', $email);
        }

        if (is_array($email) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$email of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_EMAIL, $email, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $firstNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFirstName_In(array $firstNames)
    {
        return $this->filterByFirstName($firstNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $firstName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByFirstName_Like($firstName)
    {
        return $this->filterByFirstName($firstName, Criteria::LIKE);
    }

    /**
     * Filter the query on the first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByFirstName('fooValue');   // WHERE first_name = 'fooValue'
     * $query->filterByFirstName('%fooValue%', Criteria::LIKE); // WHERE first_name LIKE '%fooValue%'
     * $query->filterByFirstName([1, 'foo'], Criteria::IN); // WHERE first_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $firstName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByFirstName($firstName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $firstName = str_replace('*', '%', $firstName);
        }

        if (is_array($firstName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$firstName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_FIRST_NAME, $firstName, $comparison);

        return $query;
    }

    /**
     * Filter the query on the is_billing column
     *
     * Example usage:
     * <code>
     * $query->filterByIsBilling(true); // WHERE is_billing = true
     * $query->filterByIsBilling('yes'); // WHERE is_billing = true
     * </code>
     *
     * @param     bool|string $isBilling The value to use as filter.
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
    public function filterByIsBilling($isBilling = null, $comparison = Criteria::EQUAL)
    {
        if (is_string($isBilling)) {
            $isBilling = in_array(strtolower($isBilling), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_IS_BILLING, $isBilling, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $lastNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastName_In(array $lastNames)
    {
        return $this->filterByLastName($lastNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $lastName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByLastName_Like($lastName)
    {
        return $this->filterByLastName($lastName, Criteria::LIKE);
    }

    /**
     * Filter the query on the last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByLastName('fooValue');   // WHERE last_name = 'fooValue'
     * $query->filterByLastName('%fooValue%', Criteria::LIKE); // WHERE last_name LIKE '%fooValue%'
     * $query->filterByLastName([1, 'foo'], Criteria::IN); // WHERE last_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $lastName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByLastName($lastName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $lastName = str_replace('*', '%', $lastName);
        }

        if (is_array($lastName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$lastName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_LAST_NAME, $lastName, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $middleNames Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMiddleName_In(array $middleNames)
    {
        return $this->filterByMiddleName($middleNames, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $middleName Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByMiddleName_Like($middleName)
    {
        return $this->filterByMiddleName($middleName, Criteria::LIKE);
    }

    /**
     * Filter the query on the middle_name column
     *
     * Example usage:
     * <code>
     * $query->filterByMiddleName('fooValue');   // WHERE middle_name = 'fooValue'
     * $query->filterByMiddleName('%fooValue%', Criteria::LIKE); // WHERE middle_name LIKE '%fooValue%'
     * $query->filterByMiddleName([1, 'foo'], Criteria::IN); // WHERE middle_name IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $middleName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByMiddleName($middleName = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $middleName = str_replace('*', '%', $middleName);
        }

        if (is_array($middleName) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$middleName of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_MIDDLE_NAME, $middleName, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $phones Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPhone_In(array $phones)
    {
        return $this->filterByPhone($phones, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $phone Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPhone_Like($phone)
    {
        return $this->filterByPhone($phone, Criteria::LIKE);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * $query->filterByPhone([1, 'foo'], Criteria::IN); // WHERE phone IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $phone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPhone($phone = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $phone = str_replace('*', '%', $phone);
        }

        if (is_array($phone) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$phone of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_PHONE, $phone, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $poBoxs Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPoBox_In(array $poBoxs)
    {
        return $this->filterByPoBox($poBoxs, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $poBox Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPoBox_Like($poBox)
    {
        return $this->filterByPoBox($poBox, Criteria::LIKE);
    }

    /**
     * Filter the query on the po_box column
     *
     * Example usage:
     * <code>
     * $query->filterByPoBox('fooValue');   // WHERE po_box = 'fooValue'
     * $query->filterByPoBox('%fooValue%', Criteria::LIKE); // WHERE po_box LIKE '%fooValue%'
     * $query->filterByPoBox([1, 'foo'], Criteria::IN); // WHERE po_box IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $poBox The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByPoBox($poBox = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $poBox = str_replace('*', '%', $poBox);
        }

        if (is_array($poBox) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$poBox of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_PO_BOX, $poBox, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $salutations Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySalutation_In(array $salutations)
    {
        return $this->filterBySalutation($salutations, Criteria::IN);
    }

    /**
     * Filter the query on the salutation column
     *
     * @param     mixed $salutation The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterBySalutation($salutation = null, $comparison = Criteria::EQUAL)
    {
        $valueSet = SpySalesOrderAddressHistoryTableMap::getValueSet(SpySalesOrderAddressHistoryTableMap::COL_SALUTATION);
        if (is_scalar($salutation)) {
            if (!in_array($salutation, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $salutation));
            }
            $salutation = array_search($salutation, $valueSet);
        } elseif (is_array($salutation)) {
            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
            $convertedValues = array();
            foreach ($salutation as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $salutation = $convertedValues;
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_SALUTATION, $salutation, $comparison);

        return $query;
    }

    /**
     * Applies Criteria::IN filtering criteria for the column.
     *
     * @param array $zipCodes Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZipCode_In(array $zipCodes)
    {
        return $this->filterByZipCode($zipCodes, Criteria::IN);
    }

    /**
     * Applies SprykerCriteria::LIKE filtering criteria for the column.
     *
     * @param string $zipCode Filter value.
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByZipCode_Like($zipCode)
    {
        return $this->filterByZipCode($zipCode, Criteria::LIKE);
    }

    /**
     * Filter the query on the zip_code column
     *
     * Example usage:
     * <code>
     * $query->filterByZipCode('fooValue');   // WHERE zip_code = 'fooValue'
     * $query->filterByZipCode('%fooValue%', Criteria::LIKE); // WHERE zip_code LIKE '%fooValue%'
     * $query->filterByZipCode([1, 'foo'], Criteria::IN); // WHERE zip_code IN (1, 'foo')
     * </code>
     *
     * @param     string|string[] $zipCode The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE). Add Criteria::LIKE explicitly.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function filterByZipCode($zipCode = null, $comparison = Criteria::EQUAL)
    {
        if ($comparison == Criteria::LIKE || $comparison == Criteria::ILIKE) {
            $zipCode = str_replace('*', '%', $zipCode);
        }

        if (is_array($zipCode) && !in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
            throw new AmbiguousComparisonException('$zipCode of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_ZIP_CODE, $zipCode, $comparison);

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
                $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$createdAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_CREATED_AT, $createdAt, $comparison);

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
                $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                if ($comparison != SprykerCriteria::BETWEEN && $comparison != Criteria::LESS_EQUAL && $comparison != Criteria::LESS_THAN) {
                    throw new AmbiguousComparisonException('\'max\' requires explicit Criteria::LESS_EQUAL, Criteria::LESS_THAN or SprykerCriteria::BETWEEN when \'min\' is also needed as comparison criteria.');
                }
                $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }

            if (!in_array($comparison, [Criteria::IN, Criteria::NOT_IN])) {
                throw new AmbiguousComparisonException('$updatedAt of type array requires one of [Criteria::IN, Criteria::NOT_IN] as comparison criteria.');
            }
        }

        $query = $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_UPDATED_AT, $updatedAt, $comparison);

        return $query;
    }

    /**
     * Filter the query by a related \Orm\Zed\Country\Persistence\SpyCountry object
     *
     * @param \Orm\Zed\Country\Persistence\SpyCountry|ObjectCollection $spyCountry The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCountry($spyCountry, ?string $comparison = null)
    {
        if ($spyCountry instanceof \Orm\Zed\Country\Persistence\SpyCountry) {
            return $this
                ->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_FK_COUNTRY, $spyCountry->getIdCountry(), $comparison);
        } elseif ($spyCountry instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_FK_COUNTRY, $spyCountry->toKeyValue('PrimaryKey', 'IdCountry'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByCountry() only accepts arguments of type \Orm\Zed\Country\Persistence\SpyCountry or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Country relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinCountry(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Country');

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
            $this->addJoinObject($join, 'Country');
        }

        return $this;
    }

    /**
     * Use the Country relation SpyCountry object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery A secondary query class using the current class as primary query
     */
    public function useCountryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Country', '\Orm\Zed\Country\Persistence\SpyCountryQuery');
    }

    /**
     * Use the Country relation SpyCountry object
     *
     * @param callable(\Orm\Zed\Country\Persistence\SpyCountryQuery):\Orm\Zed\Country\Persistence\SpyCountryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCountryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCountryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Country relation to the SpyCountry table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery The inner query object of the EXISTS statement
     */
    public function useCountryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryQuery */
        $q = $this->useExistsQuery('Country', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Country relation to the SpyCountry table for a NOT EXISTS query.
     *
     * @see useCountryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery The inner query object of the NOT EXISTS statement
     */
    public function useCountryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryQuery */
        $q = $this->useExistsQuery('Country', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Country relation to the SpyCountry table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery The inner query object of the IN statement
     */
    public function useInCountryQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryQuery */
        $q = $this->useInQuery('Country', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Country relation to the SpyCountry table for a NOT IN query.
     *
     * @see useCountryInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyCountryQuery The inner query object of the NOT IN statement
     */
    public function useNotInCountryQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyCountryQuery */
        $q = $this->useInQuery('Country', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Sales\Persistence\SpySalesOrderAddress object
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderAddress|ObjectCollection $spySalesOrderAddress The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterBySalesOrderAddress($spySalesOrderAddress, ?string $comparison = null)
    {
        if ($spySalesOrderAddress instanceof \Orm\Zed\Sales\Persistence\SpySalesOrderAddress) {
            return $this
                ->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_FK_SALES_ORDER_ADDRESS, $spySalesOrderAddress->getIdSalesOrderAddress(), $comparison);
        } elseif ($spySalesOrderAddress instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_FK_SALES_ORDER_ADDRESS, $spySalesOrderAddress->toKeyValue('PrimaryKey', 'IdSalesOrderAddress'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterBySalesOrderAddress() only accepts arguments of type \Orm\Zed\Sales\Persistence\SpySalesOrderAddress or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the SalesOrderAddress relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinSalesOrderAddress(?string $relationAlias = null, ?string $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('SalesOrderAddress');

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
            $this->addJoinObject($join, 'SalesOrderAddress');
        }

        return $this;
    }

    /**
     * Use the SalesOrderAddress relation SpySalesOrderAddress object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery A secondary query class using the current class as primary query
     */
    public function useSalesOrderAddressQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSalesOrderAddress($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'SalesOrderAddress', '\Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery');
    }

    /**
     * Use the SalesOrderAddress relation SpySalesOrderAddress object
     *
     * @param callable(\Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery):\Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withSalesOrderAddressQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useSalesOrderAddressQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the SalesOrderAddress relation to the SpySalesOrderAddress table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery The inner query object of the EXISTS statement
     */
    public function useSalesOrderAddressExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery */
        $q = $this->useExistsQuery('SalesOrderAddress', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the SalesOrderAddress relation to the SpySalesOrderAddress table for a NOT EXISTS query.
     *
     * @see useSalesOrderAddressExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery The inner query object of the NOT EXISTS statement
     */
    public function useSalesOrderAddressNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery */
        $q = $this->useExistsQuery('SalesOrderAddress', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the SalesOrderAddress relation to the SpySalesOrderAddress table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery The inner query object of the IN statement
     */
    public function useInSalesOrderAddressQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery */
        $q = $this->useInQuery('SalesOrderAddress', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the SalesOrderAddress relation to the SpySalesOrderAddress table for a NOT IN query.
     *
     * @see useSalesOrderAddressInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery The inner query object of the NOT IN statement
     */
    public function useNotInSalesOrderAddressQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery */
        $q = $this->useInQuery('SalesOrderAddress', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Filter the query by a related \Orm\Zed\Country\Persistence\SpyRegion object
     *
     * @param \Orm\Zed\Country\Persistence\SpyRegion|ObjectCollection $spyRegion The related object(s) to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByRegion($spyRegion, ?string $comparison = null)
    {
        if ($spyRegion instanceof \Orm\Zed\Country\Persistence\SpyRegion) {
            return $this
                ->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_FK_REGION, $spyRegion->getIdRegion(), $comparison);
        } elseif ($spyRegion instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            $this
                ->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_FK_REGION, $spyRegion->toKeyValue('PrimaryKey', 'IdRegion'), $comparison);

            return $this;
        } else {
            throw new PropelException('filterByRegion() only accepts arguments of type \Orm\Zed\Country\Persistence\SpyRegion or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Region relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinRegion(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Region');

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
            $this->addJoinObject($join, 'Region');
        }

        return $this;
    }

    /**
     * Use the Region relation SpyRegion object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery A secondary query class using the current class as primary query
     */
    public function useRegionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRegion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Region', '\Orm\Zed\Country\Persistence\SpyRegionQuery');
    }

    /**
     * Use the Region relation SpyRegion object
     *
     * @param callable(\Orm\Zed\Country\Persistence\SpyRegionQuery):\Orm\Zed\Country\Persistence\SpyRegionQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withRegionQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useRegionQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the Region relation to the SpyRegion table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery The inner query object of the EXISTS statement
     */
    public function useRegionExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyRegionQuery */
        $q = $this->useExistsQuery('Region', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the Region relation to the SpyRegion table for a NOT EXISTS query.
     *
     * @see useRegionExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery The inner query object of the NOT EXISTS statement
     */
    public function useRegionNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyRegionQuery */
        $q = $this->useExistsQuery('Region', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the Region relation to the SpyRegion table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery The inner query object of the IN statement
     */
    public function useInRegionQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyRegionQuery */
        $q = $this->useInQuery('Region', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the Region relation to the SpyRegion table for a NOT IN query.
     *
     * @see useRegionInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Orm\Zed\Country\Persistence\SpyRegionQuery The inner query object of the NOT IN statement
     */
    public function useNotInRegionQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Orm\Zed\Country\Persistence\SpyRegionQuery */
        $q = $this->useInQuery('Region', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildSpySalesOrderAddressHistory $spySalesOrderAddressHistory Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($spySalesOrderAddressHistory = null)
    {
        if ($spySalesOrderAddressHistory) {
            $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_ID_SALES_ORDER_ADDRESS_HISTORY, $spySalesOrderAddressHistory->getIdSalesOrderAddressHistory(), Criteria::NOT_EQUAL);
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
     * Deletes all rows from the spy_sales_order_address_history table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderAddressHistoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SpySalesOrderAddressHistoryTableMap::clearInstancePool();
            SpySalesOrderAddressHistoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderAddressHistoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SpySalesOrderAddressHistoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SpySalesOrderAddressHistoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SpySalesOrderAddressHistoryTableMap::clearRelatedInstancePool();

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
        $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by update date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        $this->addDescendingOrderByColumn(SpySalesOrderAddressHistoryTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by update date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        $this->addAscendingOrderByColumn(SpySalesOrderAddressHistoryTableMap::COL_UPDATED_AT);

        return $this;
    }

    /**
     * Order by create date desc
     *
     * @return $this The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        $this->addDescendingOrderByColumn(SpySalesOrderAddressHistoryTableMap::COL_CREATED_AT);

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
        $this->addUsingAlias(SpySalesOrderAddressHistoryTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);

        return $this;
    }

    /**
     * Order by create date asc
     *
     * @return $this The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        $this->addAscendingOrderByColumn(SpySalesOrderAddressHistoryTableMap::COL_CREATED_AT);

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
