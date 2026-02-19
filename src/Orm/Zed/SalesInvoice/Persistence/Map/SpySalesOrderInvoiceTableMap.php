<?php

namespace Orm\Zed\SalesInvoice\Persistence\Map;

use Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoice;
use Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoiceQuery;
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
 * This class defines the structure of the 'spy_sales_order_invoice' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesOrderInvoiceTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SalesInvoice.Persistence.Map.SpySalesOrderInvoiceTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_order_invoice';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesOrderInvoice';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SalesInvoice\\Persistence\\SpySalesOrderInvoice';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SalesInvoice.Persistence.SpySalesOrderInvoice';

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
     * the column name for the id_sales_order_invoice field
     */
    public const COL_ID_SALES_ORDER_INVOICE = 'spy_sales_order_invoice.id_sales_order_invoice';

    /**
     * the column name for the fk_sales_order field
     */
    public const COL_FK_SALES_ORDER = 'spy_sales_order_invoice.fk_sales_order';

    /**
     * the column name for the reference field
     */
    public const COL_REFERENCE = 'spy_sales_order_invoice.reference';

    /**
     * the column name for the issue_date field
     */
    public const COL_ISSUE_DATE = 'spy_sales_order_invoice.issue_date';

    /**
     * the column name for the template_path field
     */
    public const COL_TEMPLATE_PATH = 'spy_sales_order_invoice.template_path';

    /**
     * the column name for the email_sent field
     */
    public const COL_EMAIL_SENT = 'spy_sales_order_invoice.email_sent';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_order_invoice.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_order_invoice.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesOrderInvoice', 'FkSalesOrder', 'Reference', 'IssueDate', 'TemplatePath', 'EmailSent', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesOrderInvoice', 'fkSalesOrder', 'reference', 'issueDate', 'templatePath', 'emailSent', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesOrderInvoiceTableMap::COL_ID_SALES_ORDER_INVOICE, SpySalesOrderInvoiceTableMap::COL_FK_SALES_ORDER, SpySalesOrderInvoiceTableMap::COL_REFERENCE, SpySalesOrderInvoiceTableMap::COL_ISSUE_DATE, SpySalesOrderInvoiceTableMap::COL_TEMPLATE_PATH, SpySalesOrderInvoiceTableMap::COL_EMAIL_SENT, SpySalesOrderInvoiceTableMap::COL_CREATED_AT, SpySalesOrderInvoiceTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_invoice', 'fk_sales_order', 'reference', 'issue_date', 'template_path', 'email_sent', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdSalesOrderInvoice' => 0, 'FkSalesOrder' => 1, 'Reference' => 2, 'IssueDate' => 3, 'TemplatePath' => 4, 'EmailSent' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idSalesOrderInvoice' => 0, 'fkSalesOrder' => 1, 'reference' => 2, 'issueDate' => 3, 'templatePath' => 4, 'emailSent' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpySalesOrderInvoiceTableMap::COL_ID_SALES_ORDER_INVOICE => 0, SpySalesOrderInvoiceTableMap::COL_FK_SALES_ORDER => 1, SpySalesOrderInvoiceTableMap::COL_REFERENCE => 2, SpySalesOrderInvoiceTableMap::COL_ISSUE_DATE => 3, SpySalesOrderInvoiceTableMap::COL_TEMPLATE_PATH => 4, SpySalesOrderInvoiceTableMap::COL_EMAIL_SENT => 5, SpySalesOrderInvoiceTableMap::COL_CREATED_AT => 6, SpySalesOrderInvoiceTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_invoice' => 0, 'fk_sales_order' => 1, 'reference' => 2, 'issue_date' => 3, 'template_path' => 4, 'email_sent' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesOrderInvoice' => 'ID_SALES_ORDER_INVOICE',
        'SpySalesOrderInvoice.IdSalesOrderInvoice' => 'ID_SALES_ORDER_INVOICE',
        'idSalesOrderInvoice' => 'ID_SALES_ORDER_INVOICE',
        'spySalesOrderInvoice.idSalesOrderInvoice' => 'ID_SALES_ORDER_INVOICE',
        'SpySalesOrderInvoiceTableMap::COL_ID_SALES_ORDER_INVOICE' => 'ID_SALES_ORDER_INVOICE',
        'COL_ID_SALES_ORDER_INVOICE' => 'ID_SALES_ORDER_INVOICE',
        'id_sales_order_invoice' => 'ID_SALES_ORDER_INVOICE',
        'spy_sales_order_invoice.id_sales_order_invoice' => 'ID_SALES_ORDER_INVOICE',
        'FkSalesOrder' => 'FK_SALES_ORDER',
        'SpySalesOrderInvoice.FkSalesOrder' => 'FK_SALES_ORDER',
        'fkSalesOrder' => 'FK_SALES_ORDER',
        'spySalesOrderInvoice.fkSalesOrder' => 'FK_SALES_ORDER',
        'SpySalesOrderInvoiceTableMap::COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'COL_FK_SALES_ORDER' => 'FK_SALES_ORDER',
        'fk_sales_order' => 'FK_SALES_ORDER',
        'spy_sales_order_invoice.fk_sales_order' => 'FK_SALES_ORDER',
        'Reference' => 'REFERENCE',
        'SpySalesOrderInvoice.Reference' => 'REFERENCE',
        'reference' => 'REFERENCE',
        'spySalesOrderInvoice.reference' => 'REFERENCE',
        'SpySalesOrderInvoiceTableMap::COL_REFERENCE' => 'REFERENCE',
        'COL_REFERENCE' => 'REFERENCE',
        'spy_sales_order_invoice.reference' => 'REFERENCE',
        'IssueDate' => 'ISSUE_DATE',
        'SpySalesOrderInvoice.IssueDate' => 'ISSUE_DATE',
        'issueDate' => 'ISSUE_DATE',
        'spySalesOrderInvoice.issueDate' => 'ISSUE_DATE',
        'SpySalesOrderInvoiceTableMap::COL_ISSUE_DATE' => 'ISSUE_DATE',
        'COL_ISSUE_DATE' => 'ISSUE_DATE',
        'issue_date' => 'ISSUE_DATE',
        'spy_sales_order_invoice.issue_date' => 'ISSUE_DATE',
        'TemplatePath' => 'TEMPLATE_PATH',
        'SpySalesOrderInvoice.TemplatePath' => 'TEMPLATE_PATH',
        'templatePath' => 'TEMPLATE_PATH',
        'spySalesOrderInvoice.templatePath' => 'TEMPLATE_PATH',
        'SpySalesOrderInvoiceTableMap::COL_TEMPLATE_PATH' => 'TEMPLATE_PATH',
        'COL_TEMPLATE_PATH' => 'TEMPLATE_PATH',
        'template_path' => 'TEMPLATE_PATH',
        'spy_sales_order_invoice.template_path' => 'TEMPLATE_PATH',
        'EmailSent' => 'EMAIL_SENT',
        'SpySalesOrderInvoice.EmailSent' => 'EMAIL_SENT',
        'emailSent' => 'EMAIL_SENT',
        'spySalesOrderInvoice.emailSent' => 'EMAIL_SENT',
        'SpySalesOrderInvoiceTableMap::COL_EMAIL_SENT' => 'EMAIL_SENT',
        'COL_EMAIL_SENT' => 'EMAIL_SENT',
        'email_sent' => 'EMAIL_SENT',
        'spy_sales_order_invoice.email_sent' => 'EMAIL_SENT',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesOrderInvoice.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesOrderInvoice.createdAt' => 'CREATED_AT',
        'SpySalesOrderInvoiceTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_order_invoice.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesOrderInvoice.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesOrderInvoice.updatedAt' => 'UPDATED_AT',
        'SpySalesOrderInvoiceTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_order_invoice.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_sales_order_invoice');
        $this->setPhpName('SpySalesOrderInvoice');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SalesInvoice\\Persistence\\SpySalesOrderInvoice');
        $this->setPackage('src.Orm.Zed.SalesInvoice.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_order_invoice_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_order_invoice', 'IdSalesOrderInvoice', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_sales_order', 'FkSalesOrder', 'INTEGER', 'spy_sales_order', 'id_sales_order', true, null, null);
        $this->addColumn('reference', 'Reference', 'VARCHAR', false, 64, null);
        $this->addColumn('issue_date', 'IssueDate', 'TIMESTAMP', false, null, null);
        $this->addColumn('template_path', 'TemplatePath', 'VARCHAR', true, 255, null);
        $this->addColumn('email_sent', 'EmailSent', 'BOOLEAN', true, 1, false);
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
        $this->addRelation('SpySalesOrder', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrder', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order',
    1 => ':id_sales_order',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderInvoice', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderInvoice', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderInvoice', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderInvoice', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderInvoice', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderInvoice', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesOrderInvoice', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesOrderInvoiceTableMap::CLASS_DEFAULT : SpySalesOrderInvoiceTableMap::OM_CLASS;
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
     * @return array (SpySalesOrderInvoice object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesOrderInvoiceTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesOrderInvoiceTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesOrderInvoiceTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesOrderInvoiceTableMap::OM_CLASS;
            /** @var SpySalesOrderInvoice $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesOrderInvoiceTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesOrderInvoiceTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesOrderInvoiceTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesOrderInvoice $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesOrderInvoiceTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesOrderInvoiceTableMap::COL_ID_SALES_ORDER_INVOICE);
            $criteria->addSelectColumn(SpySalesOrderInvoiceTableMap::COL_FK_SALES_ORDER);
            $criteria->addSelectColumn(SpySalesOrderInvoiceTableMap::COL_REFERENCE);
            $criteria->addSelectColumn(SpySalesOrderInvoiceTableMap::COL_ISSUE_DATE);
            $criteria->addSelectColumn(SpySalesOrderInvoiceTableMap::COL_TEMPLATE_PATH);
            $criteria->addSelectColumn(SpySalesOrderInvoiceTableMap::COL_EMAIL_SENT);
            $criteria->addSelectColumn(SpySalesOrderInvoiceTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesOrderInvoiceTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_order_invoice');
            $criteria->addSelectColumn($alias . '.fk_sales_order');
            $criteria->addSelectColumn($alias . '.reference');
            $criteria->addSelectColumn($alias . '.issue_date');
            $criteria->addSelectColumn($alias . '.template_path');
            $criteria->addSelectColumn($alias . '.email_sent');
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
            $criteria->removeSelectColumn(SpySalesOrderInvoiceTableMap::COL_ID_SALES_ORDER_INVOICE);
            $criteria->removeSelectColumn(SpySalesOrderInvoiceTableMap::COL_FK_SALES_ORDER);
            $criteria->removeSelectColumn(SpySalesOrderInvoiceTableMap::COL_REFERENCE);
            $criteria->removeSelectColumn(SpySalesOrderInvoiceTableMap::COL_ISSUE_DATE);
            $criteria->removeSelectColumn(SpySalesOrderInvoiceTableMap::COL_TEMPLATE_PATH);
            $criteria->removeSelectColumn(SpySalesOrderInvoiceTableMap::COL_EMAIL_SENT);
            $criteria->removeSelectColumn(SpySalesOrderInvoiceTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesOrderInvoiceTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_order_invoice');
            $criteria->removeSelectColumn($alias . '.fk_sales_order');
            $criteria->removeSelectColumn($alias . '.reference');
            $criteria->removeSelectColumn($alias . '.issue_date');
            $criteria->removeSelectColumn($alias . '.template_path');
            $criteria->removeSelectColumn($alias . '.email_sent');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesOrderInvoiceTableMap::DATABASE_NAME)->getTable(SpySalesOrderInvoiceTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesOrderInvoice or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesOrderInvoice object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderInvoiceTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SalesInvoice\Persistence\SpySalesOrderInvoice) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesOrderInvoiceTableMap::DATABASE_NAME);
            $criteria->add(SpySalesOrderInvoiceTableMap::COL_ID_SALES_ORDER_INVOICE, (array) $values, Criteria::IN);
        }

        $query = SpySalesOrderInvoiceQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesOrderInvoiceTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesOrderInvoiceTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_order_invoice table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesOrderInvoiceQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesOrderInvoice or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesOrderInvoice object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderInvoiceTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesOrderInvoice object
        }

        if ($criteria->containsKey(SpySalesOrderInvoiceTableMap::COL_ID_SALES_ORDER_INVOICE) && $criteria->keyContainsValue(SpySalesOrderInvoiceTableMap::COL_ID_SALES_ORDER_INVOICE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesOrderInvoiceTableMap::COL_ID_SALES_ORDER_INVOICE.')');
        }


        // Set the correct dbName
        $query = SpySalesOrderInvoiceQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
