<?php

namespace Orm\Zed\Payment\Persistence\Map;

use Orm\Zed\Payment\Persistence\SpySalesPaymentMethodType;
use Orm\Zed\Payment\Persistence\SpySalesPaymentMethodTypeQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'spy_sales_payment_method_type' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesPaymentMethodTypeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Payment.Persistence.Map.SpySalesPaymentMethodTypeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_payment_method_type';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesPaymentMethodType';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Payment\\Persistence\\SpySalesPaymentMethodType';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Payment.Persistence.SpySalesPaymentMethodType';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the id_sales_payment_method_type field
     */
    public const COL_ID_SALES_PAYMENT_METHOD_TYPE = 'spy_sales_payment_method_type.id_sales_payment_method_type';

    /**
     * the column name for the payment_method field
     */
    public const COL_PAYMENT_METHOD = 'spy_sales_payment_method_type.payment_method';

    /**
     * the column name for the payment_provider field
     */
    public const COL_PAYMENT_PROVIDER = 'spy_sales_payment_method_type.payment_provider';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdSalesPaymentMethodType', 'PaymentMethod', 'PaymentProvider', ],
        self::TYPE_CAMELNAME     => ['idSalesPaymentMethodType', 'paymentMethod', 'paymentProvider', ],
        self::TYPE_COLNAME       => [SpySalesPaymentMethodTypeTableMap::COL_ID_SALES_PAYMENT_METHOD_TYPE, SpySalesPaymentMethodTypeTableMap::COL_PAYMENT_METHOD, SpySalesPaymentMethodTypeTableMap::COL_PAYMENT_PROVIDER, ],
        self::TYPE_FIELDNAME     => ['id_sales_payment_method_type', 'payment_method', 'payment_provider', ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     *
     * @var array<string, mixed>
     */
    protected static $fieldKeys = [
        self::TYPE_PHPNAME       => ['IdSalesPaymentMethodType' => 0, 'PaymentMethod' => 1, 'PaymentProvider' => 2, ],
        self::TYPE_CAMELNAME     => ['idSalesPaymentMethodType' => 0, 'paymentMethod' => 1, 'paymentProvider' => 2, ],
        self::TYPE_COLNAME       => [SpySalesPaymentMethodTypeTableMap::COL_ID_SALES_PAYMENT_METHOD_TYPE => 0, SpySalesPaymentMethodTypeTableMap::COL_PAYMENT_METHOD => 1, SpySalesPaymentMethodTypeTableMap::COL_PAYMENT_PROVIDER => 2, ],
        self::TYPE_FIELDNAME     => ['id_sales_payment_method_type' => 0, 'payment_method' => 1, 'payment_provider' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesPaymentMethodType' => 'ID_SALES_PAYMENT_METHOD_TYPE',
        'SpySalesPaymentMethodType.IdSalesPaymentMethodType' => 'ID_SALES_PAYMENT_METHOD_TYPE',
        'idSalesPaymentMethodType' => 'ID_SALES_PAYMENT_METHOD_TYPE',
        'spySalesPaymentMethodType.idSalesPaymentMethodType' => 'ID_SALES_PAYMENT_METHOD_TYPE',
        'SpySalesPaymentMethodTypeTableMap::COL_ID_SALES_PAYMENT_METHOD_TYPE' => 'ID_SALES_PAYMENT_METHOD_TYPE',
        'COL_ID_SALES_PAYMENT_METHOD_TYPE' => 'ID_SALES_PAYMENT_METHOD_TYPE',
        'id_sales_payment_method_type' => 'ID_SALES_PAYMENT_METHOD_TYPE',
        'spy_sales_payment_method_type.id_sales_payment_method_type' => 'ID_SALES_PAYMENT_METHOD_TYPE',
        'PaymentMethod' => 'PAYMENT_METHOD',
        'SpySalesPaymentMethodType.PaymentMethod' => 'PAYMENT_METHOD',
        'paymentMethod' => 'PAYMENT_METHOD',
        'spySalesPaymentMethodType.paymentMethod' => 'PAYMENT_METHOD',
        'SpySalesPaymentMethodTypeTableMap::COL_PAYMENT_METHOD' => 'PAYMENT_METHOD',
        'COL_PAYMENT_METHOD' => 'PAYMENT_METHOD',
        'payment_method' => 'PAYMENT_METHOD',
        'spy_sales_payment_method_type.payment_method' => 'PAYMENT_METHOD',
        'PaymentProvider' => 'PAYMENT_PROVIDER',
        'SpySalesPaymentMethodType.PaymentProvider' => 'PAYMENT_PROVIDER',
        'paymentProvider' => 'PAYMENT_PROVIDER',
        'spySalesPaymentMethodType.paymentProvider' => 'PAYMENT_PROVIDER',
        'SpySalesPaymentMethodTypeTableMap::COL_PAYMENT_PROVIDER' => 'PAYMENT_PROVIDER',
        'COL_PAYMENT_PROVIDER' => 'PAYMENT_PROVIDER',
        'payment_provider' => 'PAYMENT_PROVIDER',
        'spy_sales_payment_method_type.payment_provider' => 'PAYMENT_PROVIDER',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function initialize(): void
    {
        // attributes
        $this->setName('spy_sales_payment_method_type');
        $this->setPhpName('SpySalesPaymentMethodType');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Payment\\Persistence\\SpySalesPaymentMethodType');
        $this->setPackage('src.Orm.Zed.Payment.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_payment_method_type_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_payment_method_type', 'IdSalesPaymentMethodType', 'INTEGER', true, null, null);
        $this->addColumn('payment_method', 'PaymentMethod', 'VARCHAR', true, 255, null);
        $this->addColumn('payment_provider', 'PaymentProvider', 'VARCHAR', true, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SalesPaymentMethodType', '\\Orm\\Zed\\Payment\\Persistence\\SpySalesPayment', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_sales_payment_method_type',
    1 => ':id_sales_payment_method_type',
  ),
), null, null, 'SalesPaymentMethodTypes', false);
    }

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array<string, array> Associative array (name => parameters) of behaviors
     */
    public function getBehaviors(): array
    {
        return [
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string|null The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): ?string
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesPaymentMethodType', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesPaymentMethodType', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesPaymentMethodType', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesPaymentMethodType', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesPaymentMethodType', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesPaymentMethodType', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array $row Resultset row.
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdSalesPaymentMethodType', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param bool $withPrefix Whether to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass(bool $withPrefix = true): string
    {
        return $withPrefix ? SpySalesPaymentMethodTypeTableMap::CLASS_DEFAULT : SpySalesPaymentMethodTypeTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array $row Row returned by DataFetcher->fetch().
     * @param int $offset The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array (SpySalesPaymentMethodType object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesPaymentMethodTypeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesPaymentMethodTypeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesPaymentMethodTypeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesPaymentMethodTypeTableMap::OM_CLASS;
            /** @var SpySalesPaymentMethodType $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesPaymentMethodTypeTableMap::addInstanceToPool($obj, $key);
        }

        return [$obj, $col];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array<object>
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher): array
    {
        $results = [];

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = SpySalesPaymentMethodTypeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesPaymentMethodTypeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesPaymentMethodType $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesPaymentMethodTypeTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria Object containing the columns to add.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function addSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->addSelectColumn(SpySalesPaymentMethodTypeTableMap::COL_ID_SALES_PAYMENT_METHOD_TYPE);
            $criteria->addSelectColumn(SpySalesPaymentMethodTypeTableMap::COL_PAYMENT_METHOD);
            $criteria->addSelectColumn(SpySalesPaymentMethodTypeTableMap::COL_PAYMENT_PROVIDER);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_payment_method_type');
            $criteria->addSelectColumn($alias . '.payment_method');
            $criteria->addSelectColumn($alias . '.payment_provider');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria Object containing the columns to remove.
     * @param string|null $alias Optional table alias
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return void
     */
    public static function removeSelectColumns(Criteria $criteria, ?string $alias = null): void
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(SpySalesPaymentMethodTypeTableMap::COL_ID_SALES_PAYMENT_METHOD_TYPE);
            $criteria->removeSelectColumn(SpySalesPaymentMethodTypeTableMap::COL_PAYMENT_METHOD);
            $criteria->removeSelectColumn(SpySalesPaymentMethodTypeTableMap::COL_PAYMENT_PROVIDER);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_payment_method_type');
            $criteria->removeSelectColumn($alias . '.payment_method');
            $criteria->removeSelectColumn($alias . '.payment_provider');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap(): TableMap
    {
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesPaymentMethodTypeTableMap::DATABASE_NAME)->getTable(SpySalesPaymentMethodTypeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesPaymentMethodType or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesPaymentMethodType object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ?ConnectionInterface $con = null): int
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesPaymentMethodTypeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Payment\Persistence\SpySalesPaymentMethodType) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesPaymentMethodTypeTableMap::DATABASE_NAME);
            $criteria->add(SpySalesPaymentMethodTypeTableMap::COL_ID_SALES_PAYMENT_METHOD_TYPE, (array) $values, Criteria::IN);
        }

        $query = SpySalesPaymentMethodTypeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesPaymentMethodTypeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesPaymentMethodTypeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_payment_method_type table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesPaymentMethodTypeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesPaymentMethodType or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesPaymentMethodType object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesPaymentMethodTypeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesPaymentMethodType object
        }

        if ($criteria->containsKey(SpySalesPaymentMethodTypeTableMap::COL_ID_SALES_PAYMENT_METHOD_TYPE) && $criteria->keyContainsValue(SpySalesPaymentMethodTypeTableMap::COL_ID_SALES_PAYMENT_METHOD_TYPE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesPaymentMethodTypeTableMap::COL_ID_SALES_PAYMENT_METHOD_TYPE.')');
        }


        // Set the correct dbName
        $query = SpySalesPaymentMethodTypeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
