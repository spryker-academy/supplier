<?php

namespace Orm\Zed\SalesReclamation\Persistence\Map;

use Orm\Zed\SalesReclamation\Persistence\SpySalesReclamation;
use Orm\Zed\SalesReclamation\Persistence\SpySalesReclamationQuery;
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
 * This class defines the structure of the 'spy_sales_reclamation' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesReclamationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SalesReclamation.Persistence.Map.SpySalesReclamationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_reclamation';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesReclamation';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SalesReclamation\\Persistence\\SpySalesReclamation';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SalesReclamation.Persistence.SpySalesReclamation';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id_sales_reclamation field
     */
    public const COL_ID_SALES_RECLAMATION = 'spy_sales_reclamation.id_sales_reclamation';

    /**
     * the column name for the fk_sales_order field
     */
    public const COL_FK_SALES_ORDER = 'spy_sales_reclamation.fk_sales_order';

    /**
     * the column name for the customer_email field
     */
    public const COL_CUSTOMER_EMAIL = 'spy_sales_reclamation.customer_email';

    /**
     * the column name for the customer_name field
     */
    public const COL_CUSTOMER_NAME = 'spy_sales_reclamation.customer_name';

    /**
     * the column name for the customer_reference field
     */
    public const COL_CUSTOMER_REFERENCE = 'spy_sales_reclamation.customer_reference';

    /**
     * the column name for the is_open field
     */
    public const COL_IS_OPEN = 'spy_sales_reclamation.is_open';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_reclamation.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_reclamation.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesReclamation', 'FkSalesOrder', 'CustomerEmail', 'CustomerName', 'CustomerReference', 'IsOpen', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesReclamation', 'fkSalesOrder', 'customerEmail', 'customerName', 'customerReference', 'isOpen', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesReclamationTableMap::COL_ID_SALES_RECLAMATION, SpySalesReclamationTableMap::COL_FK_SALES_ORDER, SpySalesReclamationTableMap::COL_CUSTOMER_EMAIL, SpySalesReclamationTableMap::COL_CUSTOMER_NAME, SpySalesReclamationTableMap::COL_CUSTOMER_REFERENCE, SpySalesReclamationTableMap::COL_IS_OPEN, SpySalesReclamationTableMap::COL_CREATED_AT, SpySalesReclamationTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_reclamation', 'fk_sales_order', 'customer_email', 'customer_name', 'customer_reference', 'is_open', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['IdSalesReclamation' => 0, 'FkSalesOrder' => 1, 'CustomerEmail' => 2, 'CustomerName' => 3, 'CustomerReference' => 4, 'IsOpen' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idSalesReclamation' => 0, 'fkSalesOrder' => 1, 'customerEmail' => 2, 'customerName' => 3, 'customerReference' => 4, 'isOpen' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpySalesReclamationTableMap::COL_ID_SALES_RECLAMATION => 0, SpySalesReclamationTableMap::COL_FK_SALES_ORDER => 1, SpySalesReclamationTableMap::COL_CUSTOMER_EMAIL => 2, SpySalesReclamationTableMap::COL_CUSTOMER_NAME => 3, SpySalesReclamationTableMap::COL_CUSTOMER_REFERENCE => 4, SpySalesReclamationTableMap::COL_IS_OPEN => 5, SpySalesReclamationTableMap::COL_CREATED_AT => 6, SpySalesReclamationTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_sales_reclamation' => 0, 'fk_sales_order' => 1, 'customer_email' => 2, 'customer_name' => 3, 'customer_reference' => 4, 'is_open' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesReclamation' => 'ID_SALES_RECLAMATION',
        'SpySalesReclamation.IdSalesReclamation' => 'ID_SALES_RECLAMATION',
        'idSalesReclamation' => 'ID_SALES_RECLAMATION',
        'spySalesReclamation.idSalesReclamation' => 'ID_SALES_RECLAMATION',
        'SpySalesReclamationTableMap::COL_ID_SALES_RECLAMATION' => 'ID_SALES_RECLAMATION',
        'COL_ID_SALES_RECLAMATION' => 'ID_SALES_RECLAMATION',
        'id_sales_reclamation' => 'ID_SALES_RECLAMATION',
        'spy_sales_reclamation.id_sales_reclamation' => 'ID_SALES_RECLAMATION',
        'FkSalesOrder' => 'FK_SALES_ORDER',
        'SpySalesReclamation.FkSalesOrder' => 'FK_SALES_ORDER',
        'fkSalesOrder' => 'FK_SALES_ORDER',
        'spySalesReclamation.fkSalesOrder' => 'FK_SALES_ORDER',
        'SpySalesReclamationTableMap::COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'fk_sales_order' => 'FK_SALES_ORDER',
        'spy_sales_reclamation.fk_sales_order' => 'FK_SALES_ORDER',
        'CustomerEmail' => 'CUSTOMER_EMAIL',
        'SpySalesReclamation.CustomerEmail' => 'CUSTOMER_EMAIL',
        'customerEmail' => 'CUSTOMER_EMAIL',
        'spySalesReclamation.customerEmail' => 'CUSTOMER_EMAIL',
        'SpySalesReclamationTableMap::COL_CUSTOMER_EMAIL' => 'CUSTOMER_EMAIL',
        'COL_CUSTOMER_EMAIL' => 'CUSTOMER_EMAIL',
        'customer_email' => 'CUSTOMER_EMAIL',
        'spy_sales_reclamation.customer_email' => 'CUSTOMER_EMAIL',
        'CustomerName' => 'CUSTOMER_NAME',
        'SpySalesReclamation.CustomerName' => 'CUSTOMER_NAME',
        'customerName' => 'CUSTOMER_NAME',
        'spySalesReclamation.customerName' => 'CUSTOMER_NAME',
        'SpySalesReclamationTableMap::COL_CUSTOMER_NAME' => 'CUSTOMER_NAME',
        'COL_CUSTOMER_NAME' => 'CUSTOMER_NAME',
        'customer_name' => 'CUSTOMER_NAME',
        'spy_sales_reclamation.customer_name' => 'CUSTOMER_NAME',
        'CustomerReference' => 'CUSTOMER_REFERENCE',
        'SpySalesReclamation.CustomerReference' => 'CUSTOMER_REFERENCE',
        'customerReference' => 'CUSTOMER_REFERENCE',
        'spySalesReclamation.customerReference' => 'CUSTOMER_REFERENCE',
        'SpySalesReclamationTableMap::COL_CUSTOMER_REFERENCE' => 'CUSTOMER_REFERENCE',
        'COL_CUSTOMER_REFERENCE' => 'CUSTOMER_REFERENCE',
        'customer_reference' => 'CUSTOMER_REFERENCE',
        'spy_sales_reclamation.customer_reference' => 'CUSTOMER_REFERENCE',
        'IsOpen' => 'IS_OPEN',
        'SpySalesReclamation.IsOpen' => 'IS_OPEN',
        'isOpen' => 'IS_OPEN',
        'spySalesReclamation.isOpen' => 'IS_OPEN',
        'SpySalesReclamationTableMap::COL_IS_OPEN' => 'IS_OPEN',
        'COL_IS_OPEN' => 'IS_OPEN',
        'is_open' => 'IS_OPEN',
        'spy_sales_reclamation.is_open' => 'IS_OPEN',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesReclamation.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesReclamation.createdAt' => 'CREATED_AT',
        'SpySalesReclamationTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_reclamation.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesReclamation.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesReclamation.updatedAt' => 'UPDATED_AT',
        'SpySalesReclamationTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_reclamation.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_reclamation');
        $this->setPhpName('SpySalesReclamation');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SalesReclamation\\Persistence\\SpySalesReclamation');
        $this->setPackage('src.Orm.Zed.SalesReclamation.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_reclamation_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_reclamation', 'IdSalesReclamation', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_sales_order', 'FkSalesOrder', 'INTEGER', 'spy_sales_order', 'id_sales_order', true, null, null);
        $this->addColumn('customer_email', 'CustomerEmail', 'VARCHAR', true, 255, null);
        $this->addColumn('customer_name', 'CustomerName', 'VARCHAR', true, 511, null);
        $this->addColumn('customer_reference', 'CustomerReference', 'VARCHAR', false, 255, null);
        $this->addColumn('is_open', 'IsOpen', 'BOOLEAN', true, 1, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Order', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrder', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order',
    1 => ':id_sales_order',
  ),
), null, null, null, false);
        $this->addRelation('SpySalesReclamationItem', '\\Orm\\Zed\\SalesReclamation\\Persistence\\SpySalesReclamationItem', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_sales_reclamation',
    1 => ':id_sales_reclamation',
  ),
), null, null, 'SpySalesReclamationItems', false);
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
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', 'is_timestamp' => 'true'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesReclamation', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesReclamation', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesReclamation', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesReclamation', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesReclamation', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesReclamation', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesReclamation', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesReclamationTableMap::CLASS_DEFAULT : SpySalesReclamationTableMap::OM_CLASS;
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
     * @return array (SpySalesReclamation object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesReclamationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesReclamationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesReclamationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesReclamationTableMap::OM_CLASS;
            /** @var SpySalesReclamation $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesReclamationTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesReclamationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesReclamationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesReclamation $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesReclamationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesReclamationTableMap::COL_ID_SALES_RECLAMATION);
            $criteria->addSelectColumn(SpySalesReclamationTableMap::COL_FK_SALES_ORDER);
            $criteria->addSelectColumn(SpySalesReclamationTableMap::COL_CUSTOMER_EMAIL);
            $criteria->addSelectColumn(SpySalesReclamationTableMap::COL_CUSTOMER_NAME);
            $criteria->addSelectColumn(SpySalesReclamationTableMap::COL_CUSTOMER_REFERENCE);
            $criteria->addSelectColumn(SpySalesReclamationTableMap::COL_IS_OPEN);
            $criteria->addSelectColumn(SpySalesReclamationTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesReclamationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_reclamation');
            $criteria->addSelectColumn($alias . '.fk_sales_order');
            $criteria->addSelectColumn($alias . '.customer_email');
            $criteria->addSelectColumn($alias . '.customer_name');
            $criteria->addSelectColumn($alias . '.customer_reference');
            $criteria->addSelectColumn($alias . '.is_open');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
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
            $criteria->removeSelectColumn(SpySalesReclamationTableMap::COL_ID_SALES_RECLAMATION);
            $criteria->removeSelectColumn(SpySalesReclamationTableMap::COL_FK_SALES_ORDER);
            $criteria->removeSelectColumn(SpySalesReclamationTableMap::COL_CUSTOMER_EMAIL);
            $criteria->removeSelectColumn(SpySalesReclamationTableMap::COL_CUSTOMER_NAME);
            $criteria->removeSelectColumn(SpySalesReclamationTableMap::COL_CUSTOMER_REFERENCE);
            $criteria->removeSelectColumn(SpySalesReclamationTableMap::COL_IS_OPEN);
            $criteria->removeSelectColumn(SpySalesReclamationTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesReclamationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_reclamation');
            $criteria->removeSelectColumn($alias . '.fk_sales_order');
            $criteria->removeSelectColumn($alias . '.customer_email');
            $criteria->removeSelectColumn($alias . '.customer_name');
            $criteria->removeSelectColumn($alias . '.customer_reference');
            $criteria->removeSelectColumn($alias . '.is_open');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesReclamationTableMap::DATABASE_NAME)->getTable(SpySalesReclamationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesReclamation or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesReclamation object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesReclamationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SalesReclamation\Persistence\SpySalesReclamation) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesReclamationTableMap::DATABASE_NAME);
            $criteria->add(SpySalesReclamationTableMap::COL_ID_SALES_RECLAMATION, (array) $values, Criteria::IN);
        }

        $query = SpySalesReclamationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesReclamationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesReclamationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_reclamation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesReclamationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesReclamation or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesReclamation object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesReclamationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesReclamation object
        }

        if ($criteria->containsKey(SpySalesReclamationTableMap::COL_ID_SALES_RECLAMATION) && $criteria->keyContainsValue(SpySalesReclamationTableMap::COL_ID_SALES_RECLAMATION) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesReclamationTableMap::COL_ID_SALES_RECLAMATION.')');
        }


        // Set the correct dbName
        $query = SpySalesReclamationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
