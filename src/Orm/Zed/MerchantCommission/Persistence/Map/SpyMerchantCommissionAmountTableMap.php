<?php

namespace Orm\Zed\MerchantCommission\Persistence\Map;

use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmount;
use Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmountQuery;
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
 * This class defines the structure of the 'spy_merchant_commission_amount' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyMerchantCommissionAmountTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MerchantCommission.Persistence.Map.SpyMerchantCommissionAmountTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_merchant_commission_amount';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyMerchantCommissionAmount';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MerchantCommission\\Persistence\\SpyMerchantCommissionAmount';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MerchantCommission.Persistence.SpyMerchantCommissionAmount';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the id_merchant_commission_amount field
     */
    public const COL_ID_MERCHANT_COMMISSION_AMOUNT = 'spy_merchant_commission_amount.id_merchant_commission_amount';

    /**
     * the column name for the fk_currency field
     */
    public const COL_FK_CURRENCY = 'spy_merchant_commission_amount.fk_currency';

    /**
     * the column name for the fk_merchant_commission field
     */
    public const COL_FK_MERCHANT_COMMISSION = 'spy_merchant_commission_amount.fk_merchant_commission';

    /**
     * the column name for the gross_amount field
     */
    public const COL_GROSS_AMOUNT = 'spy_merchant_commission_amount.gross_amount';

    /**
     * the column name for the net_amount field
     */
    public const COL_NET_AMOUNT = 'spy_merchant_commission_amount.net_amount';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_merchant_commission_amount.uuid';

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
        self::TYPE_PHPNAME       => ['IdMerchantCommissionAmount', 'FkCurrency', 'FkMerchantCommission', 'GrossAmount', 'NetAmount', 'Uuid', ],
        self::TYPE_CAMELNAME     => ['idMerchantCommissionAmount', 'fkCurrency', 'fkMerchantCommission', 'grossAmount', 'netAmount', 'uuid', ],
        self::TYPE_COLNAME       => [SpyMerchantCommissionAmountTableMap::COL_ID_MERCHANT_COMMISSION_AMOUNT, SpyMerchantCommissionAmountTableMap::COL_FK_CURRENCY, SpyMerchantCommissionAmountTableMap::COL_FK_MERCHANT_COMMISSION, SpyMerchantCommissionAmountTableMap::COL_GROSS_AMOUNT, SpyMerchantCommissionAmountTableMap::COL_NET_AMOUNT, SpyMerchantCommissionAmountTableMap::COL_UUID, ],
        self::TYPE_FIELDNAME     => ['id_merchant_commission_amount', 'fk_currency', 'fk_merchant_commission', 'gross_amount', 'net_amount', 'uuid', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['IdMerchantCommissionAmount' => 0, 'FkCurrency' => 1, 'FkMerchantCommission' => 2, 'GrossAmount' => 3, 'NetAmount' => 4, 'Uuid' => 5, ],
        self::TYPE_CAMELNAME     => ['idMerchantCommissionAmount' => 0, 'fkCurrency' => 1, 'fkMerchantCommission' => 2, 'grossAmount' => 3, 'netAmount' => 4, 'uuid' => 5, ],
        self::TYPE_COLNAME       => [SpyMerchantCommissionAmountTableMap::COL_ID_MERCHANT_COMMISSION_AMOUNT => 0, SpyMerchantCommissionAmountTableMap::COL_FK_CURRENCY => 1, SpyMerchantCommissionAmountTableMap::COL_FK_MERCHANT_COMMISSION => 2, SpyMerchantCommissionAmountTableMap::COL_GROSS_AMOUNT => 3, SpyMerchantCommissionAmountTableMap::COL_NET_AMOUNT => 4, SpyMerchantCommissionAmountTableMap::COL_UUID => 5, ],
        self::TYPE_FIELDNAME     => ['id_merchant_commission_amount' => 0, 'fk_currency' => 1, 'fk_merchant_commission' => 2, 'gross_amount' => 3, 'net_amount' => 4, 'uuid' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdMerchantCommissionAmount' => 'ID_MERCHANT_COMMISSION_AMOUNT',
        'SpyMerchantCommissionAmount.IdMerchantCommissionAmount' => 'ID_MERCHANT_COMMISSION_AMOUNT',
        'idMerchantCommissionAmount' => 'ID_MERCHANT_COMMISSION_AMOUNT',
        'spyMerchantCommissionAmount.idMerchantCommissionAmount' => 'ID_MERCHANT_COMMISSION_AMOUNT',
        'SpyMerchantCommissionAmountTableMap::COL_ID_MERCHANT_COMMISSION_AMOUNT' => 'ID_MERCHANT_COMMISSION_AMOUNT',
        'COL_ID_MERCHANT_COMMISSION_AMOUNT' => 'ID_MERCHANT_COMMISSION_AMOUNT',
        'id_merchant_commission_amount' => 'ID_MERCHANT_COMMISSION_AMOUNT',
        'spy_merchant_commission_amount.id_merchant_commission_amount' => 'ID_MERCHANT_COMMISSION_AMOUNT',
        'FkCurrency' => 'FK_CURRENCY',
        'SpyMerchantCommissionAmount.FkCurrency' => 'FK_CURRENCY',
        'fkCurrency' => 'FK_CURRENCY',
        'spyMerchantCommissionAmount.fkCurrency' => 'FK_CURRENCY',
        'SpyMerchantCommissionAmountTableMap::COL_FK_CURRENCY' => 'FK_CURRENCY',
        'COL_FK_CURRENCY' => 'FK_CURRENCY',
        'fk_currency' => 'FK_CURRENCY',
        'spy_merchant_commission_amount.fk_currency' => 'FK_CURRENCY',
        'FkMerchantCommission' => 'FK_MERCHANT_COMMISSION',
        'SpyMerchantCommissionAmount.FkMerchantCommission' => 'FK_MERCHANT_COMMISSION',
        'fkMerchantCommission' => 'FK_MERCHANT_COMMISSION',
        'spyMerchantCommissionAmount.fkMerchantCommission' => 'FK_MERCHANT_COMMISSION',
        'SpyMerchantCommissionAmountTableMap::COL_FK_MERCHANT_COMMISSION' => 'FK_MERCHANT_COMMISSION',
        'COL_FK_MERCHANT_COMMISSION' => 'FK_MERCHANT_COMMISSION',
        'fk_merchant_commission' => 'FK_MERCHANT_COMMISSION',
        'spy_merchant_commission_amount.fk_merchant_commission' => 'FK_MERCHANT_COMMISSION',
        'GrossAmount' => 'GROSS_AMOUNT',
        'SpyMerchantCommissionAmount.GrossAmount' => 'GROSS_AMOUNT',
        'grossAmount' => 'GROSS_AMOUNT',
        'spyMerchantCommissionAmount.grossAmount' => 'GROSS_AMOUNT',
        'SpyMerchantCommissionAmountTableMap::COL_GROSS_AMOUNT' => 'GROSS_AMOUNT',
        'COL_GROSS_AMOUNT' => 'GROSS_AMOUNT',
        'gross_amount' => 'GROSS_AMOUNT',
        'spy_merchant_commission_amount.gross_amount' => 'GROSS_AMOUNT',
        'NetAmount' => 'NET_AMOUNT',
        'SpyMerchantCommissionAmount.NetAmount' => 'NET_AMOUNT',
        'netAmount' => 'NET_AMOUNT',
        'spyMerchantCommissionAmount.netAmount' => 'NET_AMOUNT',
        'SpyMerchantCommissionAmountTableMap::COL_NET_AMOUNT' => 'NET_AMOUNT',
        'COL_NET_AMOUNT' => 'NET_AMOUNT',
        'net_amount' => 'NET_AMOUNT',
        'spy_merchant_commission_amount.net_amount' => 'NET_AMOUNT',
        'Uuid' => 'UUID',
        'SpyMerchantCommissionAmount.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyMerchantCommissionAmount.uuid' => 'UUID',
        'SpyMerchantCommissionAmountTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_merchant_commission_amount.uuid' => 'UUID',
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
        $this->setName('spy_merchant_commission_amount');
        $this->setPhpName('SpyMerchantCommissionAmount');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\MerchantCommission\\Persistence\\SpyMerchantCommissionAmount');
        $this->setPackage('src.Orm.Zed.MerchantCommission.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_merchant_commission_amount_pk_seq');
        // columns
        $this->addPrimaryKey('id_merchant_commission_amount', 'IdMerchantCommissionAmount', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_currency', 'FkCurrency', 'INTEGER', 'spy_currency', 'id_currency', true, null, null);
        $this->addForeignKey('fk_merchant_commission', 'FkMerchantCommission', 'INTEGER', 'spy_merchant_commission', 'id_merchant_commission', true, null, null);
        $this->addColumn('gross_amount', 'GrossAmount', 'INTEGER', false, null, null);
        $this->addColumn('net_amount', 'NetAmount', 'INTEGER', false, null, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Currency', '\\Orm\\Zed\\Currency\\Persistence\\SpyCurrency', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_currency',
    1 => ':id_currency',
  ),
), null, null, null, false);
        $this->addRelation('MerchantCommission', '\\Orm\\Zed\\MerchantCommission\\Persistence\\SpyMerchantCommission', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_merchant_commission',
    1 => ':id_merchant_commission',
  ),
), null, null, null, false);
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_merchant_commission_amount'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommissionAmount', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommissionAmount', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommissionAmount', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommissionAmount', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommissionAmount', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantCommissionAmount', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdMerchantCommissionAmount', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyMerchantCommissionAmountTableMap::CLASS_DEFAULT : SpyMerchantCommissionAmountTableMap::OM_CLASS;
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
     * @return array (SpyMerchantCommissionAmount object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyMerchantCommissionAmountTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyMerchantCommissionAmountTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyMerchantCommissionAmountTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyMerchantCommissionAmountTableMap::OM_CLASS;
            /** @var SpyMerchantCommissionAmount $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyMerchantCommissionAmountTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyMerchantCommissionAmountTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyMerchantCommissionAmountTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyMerchantCommissionAmount $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyMerchantCommissionAmountTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyMerchantCommissionAmountTableMap::COL_ID_MERCHANT_COMMISSION_AMOUNT);
            $criteria->addSelectColumn(SpyMerchantCommissionAmountTableMap::COL_FK_CURRENCY);
            $criteria->addSelectColumn(SpyMerchantCommissionAmountTableMap::COL_FK_MERCHANT_COMMISSION);
            $criteria->addSelectColumn(SpyMerchantCommissionAmountTableMap::COL_GROSS_AMOUNT);
            $criteria->addSelectColumn(SpyMerchantCommissionAmountTableMap::COL_NET_AMOUNT);
            $criteria->addSelectColumn(SpyMerchantCommissionAmountTableMap::COL_UUID);
        } else {
            $criteria->addSelectColumn($alias . '.id_merchant_commission_amount');
            $criteria->addSelectColumn($alias . '.fk_currency');
            $criteria->addSelectColumn($alias . '.fk_merchant_commission');
            $criteria->addSelectColumn($alias . '.gross_amount');
            $criteria->addSelectColumn($alias . '.net_amount');
            $criteria->addSelectColumn($alias . '.uuid');
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
            $criteria->removeSelectColumn(SpyMerchantCommissionAmountTableMap::COL_ID_MERCHANT_COMMISSION_AMOUNT);
            $criteria->removeSelectColumn(SpyMerchantCommissionAmountTableMap::COL_FK_CURRENCY);
            $criteria->removeSelectColumn(SpyMerchantCommissionAmountTableMap::COL_FK_MERCHANT_COMMISSION);
            $criteria->removeSelectColumn(SpyMerchantCommissionAmountTableMap::COL_GROSS_AMOUNT);
            $criteria->removeSelectColumn(SpyMerchantCommissionAmountTableMap::COL_NET_AMOUNT);
            $criteria->removeSelectColumn(SpyMerchantCommissionAmountTableMap::COL_UUID);
        } else {
            $criteria->removeSelectColumn($alias . '.id_merchant_commission_amount');
            $criteria->removeSelectColumn($alias . '.fk_currency');
            $criteria->removeSelectColumn($alias . '.fk_merchant_commission');
            $criteria->removeSelectColumn($alias . '.gross_amount');
            $criteria->removeSelectColumn($alias . '.net_amount');
            $criteria->removeSelectColumn($alias . '.uuid');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyMerchantCommissionAmountTableMap::DATABASE_NAME)->getTable(SpyMerchantCommissionAmountTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyMerchantCommissionAmount or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyMerchantCommissionAmount object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantCommissionAmountTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MerchantCommission\Persistence\SpyMerchantCommissionAmount) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyMerchantCommissionAmountTableMap::DATABASE_NAME);
            $criteria->add(SpyMerchantCommissionAmountTableMap::COL_ID_MERCHANT_COMMISSION_AMOUNT, (array) $values, Criteria::IN);
        }

        $query = SpyMerchantCommissionAmountQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyMerchantCommissionAmountTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyMerchantCommissionAmountTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_merchant_commission_amount table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyMerchantCommissionAmountQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyMerchantCommissionAmount or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyMerchantCommissionAmount object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantCommissionAmountTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyMerchantCommissionAmount object
        }

        if ($criteria->containsKey(SpyMerchantCommissionAmountTableMap::COL_ID_MERCHANT_COMMISSION_AMOUNT) && $criteria->keyContainsValue(SpyMerchantCommissionAmountTableMap::COL_ID_MERCHANT_COMMISSION_AMOUNT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyMerchantCommissionAmountTableMap::COL_ID_MERCHANT_COMMISSION_AMOUNT.')');
        }


        // Set the correct dbName
        $query = SpyMerchantCommissionAmountQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
