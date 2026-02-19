<?php

namespace Orm\Zed\Supplier\Persistence\Map;

use Orm\Zed\Supplier\Persistence\PyzSupplier;
use Orm\Zed\Supplier\Persistence\PyzSupplierQuery;
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
 * This class defines the structure of the 'pyz_supplier' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PyzSupplierTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Supplier.Persistence.Map.PyzSupplierTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'pyz_supplier';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'PyzSupplier';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Supplier\\Persistence\\PyzSupplier';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Supplier.Persistence.PyzSupplier';

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
     * the column name for the id_supplier field
     */
    public const COL_ID_SUPPLIER = 'pyz_supplier.id_supplier';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'pyz_supplier.name';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'pyz_supplier.description';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'pyz_supplier.status';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'pyz_supplier.email';

    /**
     * the column name for the phone field
     */
    public const COL_PHONE = 'pyz_supplier.phone';

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
        self::TYPE_PHPNAME       => ['IdSupplier', 'Name', 'Description', 'Status', 'Email', 'Phone', ],
        self::TYPE_CAMELNAME     => ['idSupplier', 'name', 'description', 'status', 'email', 'phone', ],
        self::TYPE_COLNAME       => [PyzSupplierTableMap::COL_ID_SUPPLIER, PyzSupplierTableMap::COL_NAME, PyzSupplierTableMap::COL_DESCRIPTION, PyzSupplierTableMap::COL_STATUS, PyzSupplierTableMap::COL_EMAIL, PyzSupplierTableMap::COL_PHONE, ],
        self::TYPE_FIELDNAME     => ['id_supplier', 'name', 'description', 'status', 'email', 'phone', ],
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
        self::TYPE_PHPNAME       => ['IdSupplier' => 0, 'Name' => 1, 'Description' => 2, 'Status' => 3, 'Email' => 4, 'Phone' => 5, ],
        self::TYPE_CAMELNAME     => ['idSupplier' => 0, 'name' => 1, 'description' => 2, 'status' => 3, 'email' => 4, 'phone' => 5, ],
        self::TYPE_COLNAME       => [PyzSupplierTableMap::COL_ID_SUPPLIER => 0, PyzSupplierTableMap::COL_NAME => 1, PyzSupplierTableMap::COL_DESCRIPTION => 2, PyzSupplierTableMap::COL_STATUS => 3, PyzSupplierTableMap::COL_EMAIL => 4, PyzSupplierTableMap::COL_PHONE => 5, ],
        self::TYPE_FIELDNAME     => ['id_supplier' => 0, 'name' => 1, 'description' => 2, 'status' => 3, 'email' => 4, 'phone' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSupplier' => 'ID_SUPPLIER',
        'PyzSupplier.IdSupplier' => 'ID_SUPPLIER',
        'idSupplier' => 'ID_SUPPLIER',
        'pyzSupplier.idSupplier' => 'ID_SUPPLIER',
        'PyzSupplierTableMap::COL_ID_SUPPLIER' => 'ID_SUPPLIER',
        'COL_ID_SUPPLIER' => 'ID_SUPPLIER',
        'id_supplier' => 'ID_SUPPLIER',
        'pyz_supplier.id_supplier' => 'ID_SUPPLIER',
        'Name' => 'NAME',
        'PyzSupplier.Name' => 'NAME',
        'name' => 'NAME',
        'pyzSupplier.name' => 'NAME',
        'PyzSupplierTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'pyz_supplier.name' => 'NAME',
        'Description' => 'DESCRIPTION',
        'PyzSupplier.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'pyzSupplier.description' => 'DESCRIPTION',
        'PyzSupplierTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'pyz_supplier.description' => 'DESCRIPTION',
        'Status' => 'STATUS',
        'PyzSupplier.Status' => 'STATUS',
        'status' => 'STATUS',
        'pyzSupplier.status' => 'STATUS',
        'PyzSupplierTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'pyz_supplier.status' => 'STATUS',
        'Email' => 'EMAIL',
        'PyzSupplier.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'pyzSupplier.email' => 'EMAIL',
        'PyzSupplierTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'pyz_supplier.email' => 'EMAIL',
        'Phone' => 'PHONE',
        'PyzSupplier.Phone' => 'PHONE',
        'phone' => 'PHONE',
        'pyzSupplier.phone' => 'PHONE',
        'PyzSupplierTableMap::COL_PHONE' => 'PHONE',
        'COL_PHONE' => 'PHONE',
        'pyz_supplier.phone' => 'PHONE',
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
        $this->setName('pyz_supplier');
        $this->setPhpName('PyzSupplier');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Supplier\\Persistence\\PyzSupplier');
        $this->setPackage('src.Orm.Zed.Supplier.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('pyz_supplier_pk_seq');
        // columns
        $this->addPrimaryKey('id_supplier', 'IdSupplier', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', true, null, null);
        $this->addColumn('status', 'Status', 'INTEGER', true, null, 1);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 255, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', true, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('PyzMerchantToSupplier', '\\Orm\\Zed\\Supplier\\Persistence\\PyzMerchantToSupplier', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_supplier',
    1 => ':id_supplier',
  ),
), null, null, 'PyzMerchantToSuppliers', false);
        $this->addRelation('PyzSupplierLocation', '\\Orm\\Zed\\SupplierLocation\\Persistence\\PyzSupplierLocation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_supplier',
    1 => ':id_supplier',
  ),
), null, null, 'PyzSupplierLocations', false);
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
            'event' => ['pyz_supplier_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplier', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplier', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplier', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplier', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplier', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplier', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSupplier', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PyzSupplierTableMap::CLASS_DEFAULT : PyzSupplierTableMap::OM_CLASS;
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
     * @return array (PyzSupplier object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PyzSupplierTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PyzSupplierTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PyzSupplierTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PyzSupplierTableMap::OM_CLASS;
            /** @var PyzSupplier $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PyzSupplierTableMap::addInstanceToPool($obj, $key);
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
            $key = PyzSupplierTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PyzSupplierTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PyzSupplier $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PyzSupplierTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PyzSupplierTableMap::COL_ID_SUPPLIER);
            $criteria->addSelectColumn(PyzSupplierTableMap::COL_NAME);
            $criteria->addSelectColumn(PyzSupplierTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(PyzSupplierTableMap::COL_STATUS);
            $criteria->addSelectColumn(PyzSupplierTableMap::COL_EMAIL);
            $criteria->addSelectColumn(PyzSupplierTableMap::COL_PHONE);
        } else {
            $criteria->addSelectColumn($alias . '.id_supplier');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.phone');
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
            $criteria->removeSelectColumn(PyzSupplierTableMap::COL_ID_SUPPLIER);
            $criteria->removeSelectColumn(PyzSupplierTableMap::COL_NAME);
            $criteria->removeSelectColumn(PyzSupplierTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(PyzSupplierTableMap::COL_STATUS);
            $criteria->removeSelectColumn(PyzSupplierTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(PyzSupplierTableMap::COL_PHONE);
        } else {
            $criteria->removeSelectColumn($alias . '.id_supplier');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.phone');
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
        return Propel::getServiceContainer()->getDatabaseMap(PyzSupplierTableMap::DATABASE_NAME)->getTable(PyzSupplierTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a PyzSupplier or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or PyzSupplier object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PyzSupplierTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Supplier\Persistence\PyzSupplier) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PyzSupplierTableMap::DATABASE_NAME);
            $criteria->add(PyzSupplierTableMap::COL_ID_SUPPLIER, (array) $values, Criteria::IN);
        }

        $query = PyzSupplierQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PyzSupplierTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PyzSupplierTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the pyz_supplier table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return PyzSupplierQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PyzSupplier or Criteria object.
     *
     * @param mixed $criteria Criteria or PyzSupplier object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PyzSupplierTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PyzSupplier object
        }


        // Set the correct dbName
        $query = PyzSupplierQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
