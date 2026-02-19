<?php

namespace Orm\Zed\SupplierLocation\Persistence\Map;

use Orm\Zed\SupplierLocation\Persistence\PyzSupplierLocation;
use Orm\Zed\SupplierLocation\Persistence\PyzSupplierLocationQuery;
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
 * This class defines the structure of the 'pyz_supplier_location' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PyzSupplierLocationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SupplierLocation.Persistence.Map.PyzSupplierLocationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'pyz_supplier_location';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'PyzSupplierLocation';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SupplierLocation\\Persistence\\PyzSupplierLocation';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SupplierLocation.Persistence.PyzSupplierLocation';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id_supplier_location field
     */
    public const COL_ID_SUPPLIER_LOCATION = 'pyz_supplier_location.id_supplier_location';

    /**
     * the column name for the fk_supplier field
     */
    public const COL_FK_SUPPLIER = 'pyz_supplier_location.fk_supplier';

    /**
     * the column name for the city field
     */
    public const COL_CITY = 'pyz_supplier_location.city';

    /**
     * the column name for the country field
     */
    public const COL_COUNTRY = 'pyz_supplier_location.country';

    /**
     * the column name for the address field
     */
    public const COL_ADDRESS = 'pyz_supplier_location.address';

    /**
     * the column name for the zip_code field
     */
    public const COL_ZIP_CODE = 'pyz_supplier_location.zip_code';

    /**
     * the column name for the is_default field
     */
    public const COL_IS_DEFAULT = 'pyz_supplier_location.is_default';

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
        self::TYPE_PHPNAME       => ['IdSupplierLocation', 'FkSupplier', 'City', 'Country', 'Address', 'ZipCode', 'IsDefault', ],
        self::TYPE_CAMELNAME     => ['idSupplierLocation', 'fkSupplier', 'city', 'country', 'address', 'zipCode', 'isDefault', ],
        self::TYPE_COLNAME       => [PyzSupplierLocationTableMap::COL_ID_SUPPLIER_LOCATION, PyzSupplierLocationTableMap::COL_FK_SUPPLIER, PyzSupplierLocationTableMap::COL_CITY, PyzSupplierLocationTableMap::COL_COUNTRY, PyzSupplierLocationTableMap::COL_ADDRESS, PyzSupplierLocationTableMap::COL_ZIP_CODE, PyzSupplierLocationTableMap::COL_IS_DEFAULT, ],
        self::TYPE_FIELDNAME     => ['id_supplier_location', 'fk_supplier', 'city', 'country', 'address', 'zip_code', 'is_default', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
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
        self::TYPE_PHPNAME       => ['IdSupplierLocation' => 0, 'FkSupplier' => 1, 'City' => 2, 'Country' => 3, 'Address' => 4, 'ZipCode' => 5, 'IsDefault' => 6, ],
        self::TYPE_CAMELNAME     => ['idSupplierLocation' => 0, 'fkSupplier' => 1, 'city' => 2, 'country' => 3, 'address' => 4, 'zipCode' => 5, 'isDefault' => 6, ],
        self::TYPE_COLNAME       => [PyzSupplierLocationTableMap::COL_ID_SUPPLIER_LOCATION => 0, PyzSupplierLocationTableMap::COL_FK_SUPPLIER => 1, PyzSupplierLocationTableMap::COL_CITY => 2, PyzSupplierLocationTableMap::COL_COUNTRY => 3, PyzSupplierLocationTableMap::COL_ADDRESS => 4, PyzSupplierLocationTableMap::COL_ZIP_CODE => 5, PyzSupplierLocationTableMap::COL_IS_DEFAULT => 6, ],
        self::TYPE_FIELDNAME     => ['id_supplier_location' => 0, 'fk_supplier' => 1, 'city' => 2, 'country' => 3, 'address' => 4, 'zip_code' => 5, 'is_default' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSupplierLocation' => 'ID_SUPPLIER_LOCATION',
        'PyzSupplierLocation.IdSupplierLocation' => 'ID_SUPPLIER_LOCATION',
        'idSupplierLocation' => 'ID_SUPPLIER_LOCATION',
        'pyzSupplierLocation.idSupplierLocation' => 'ID_SUPPLIER_LOCATION',
        'PyzSupplierLocationTableMap::COL_ID_SUPPLIER_LOCATION' => 'ID_SUPPLIER_LOCATION',
        'COL_ID_SUPPLIER_LOCATION' => 'ID_SUPPLIER_LOCATION',
        'id_supplier_location' => 'ID_SUPPLIER_LOCATION',
        'pyz_supplier_location.id_supplier_location' => 'ID_SUPPLIER_LOCATION',
        'FkSupplier' => 'FK_SUPPLIER',
        'PyzSupplierLocation.FkSupplier' => 'FK_SUPPLIER',
        'fkSupplier' => 'FK_SUPPLIER',
        'pyzSupplierLocation.fkSupplier' => 'FK_SUPPLIER',
        'PyzSupplierLocationTableMap::COL_FK_SUPPLIER' => 'FK_SUPPLIER',
        'COL_FK_SUPPLIER' => 'FK_SUPPLIER',
        'fk_supplier' => 'FK_SUPPLIER',
        'pyz_supplier_location.fk_supplier' => 'FK_SUPPLIER',
        'City' => 'CITY',
        'PyzSupplierLocation.City' => 'CITY',
        'city' => 'CITY',
        'pyzSupplierLocation.city' => 'CITY',
        'PyzSupplierLocationTableMap::COL_CITY' => 'CITY',
        'COL_CITY' => 'CITY',
        'pyz_supplier_location.city' => 'CITY',
        'Country' => 'COUNTRY',
        'PyzSupplierLocation.Country' => 'COUNTRY',
        'country' => 'COUNTRY',
        'pyzSupplierLocation.country' => 'COUNTRY',
        'PyzSupplierLocationTableMap::COL_COUNTRY' => 'COUNTRY',
        'COL_COUNTRY' => 'COUNTRY',
        'pyz_supplier_location.country' => 'COUNTRY',
        'Address' => 'ADDRESS',
        'PyzSupplierLocation.Address' => 'ADDRESS',
        'address' => 'ADDRESS',
        'pyzSupplierLocation.address' => 'ADDRESS',
        'PyzSupplierLocationTableMap::COL_ADDRESS' => 'ADDRESS',
        'COL_ADDRESS' => 'ADDRESS',
        'pyz_supplier_location.address' => 'ADDRESS',
        'ZipCode' => 'ZIP_CODE',
        'PyzSupplierLocation.ZipCode' => 'ZIP_CODE',
        'zipCode' => 'ZIP_CODE',
        'pyzSupplierLocation.zipCode' => 'ZIP_CODE',
        'PyzSupplierLocationTableMap::COL_ZIP_CODE' => 'ZIP_CODE',
        'COL_ZIP_CODE' => 'ZIP_CODE',
        'zip_code' => 'ZIP_CODE',
        'pyz_supplier_location.zip_code' => 'ZIP_CODE',
        'IsDefault' => 'IS_DEFAULT',
        'PyzSupplierLocation.IsDefault' => 'IS_DEFAULT',
        'isDefault' => 'IS_DEFAULT',
        'pyzSupplierLocation.isDefault' => 'IS_DEFAULT',
        'PyzSupplierLocationTableMap::COL_IS_DEFAULT' => 'IS_DEFAULT',
        'COL_IS_DEFAULT' => 'IS_DEFAULT',
        'is_default' => 'IS_DEFAULT',
        'pyz_supplier_location.is_default' => 'IS_DEFAULT',
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
        $this->setName('pyz_supplier_location');
        $this->setPhpName('PyzSupplierLocation');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SupplierLocation\\Persistence\\PyzSupplierLocation');
        $this->setPackage('src.Orm.Zed.SupplierLocation.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('pyz_supplier_location_pk_seq');
        // columns
        $this->addPrimaryKey('id_supplier_location', 'IdSupplierLocation', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_supplier', 'FkSupplier', 'INTEGER', 'pyz_supplier', 'id_supplier', true, null, null);
        $this->addColumn('city', 'City', 'VARCHAR', true, 255, null);
        $this->addColumn('country', 'Country', 'VARCHAR', true, 255, null);
        $this->addColumn('address', 'Address', 'VARCHAR', true, 255, null);
        $this->addColumn('zip_code', 'ZipCode', 'VARCHAR', true, 255, null);
        $this->addColumn('is_default', 'IsDefault', 'BOOLEAN', true, 1, false);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('PyzSupplier', '\\Orm\\Zed\\Supplier\\Persistence\\PyzSupplier', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_supplier',
    1 => ':id_supplier',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplierLocation', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplierLocation', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplierLocation', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplierLocation', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplierLocation', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSupplierLocation', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSupplierLocation', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PyzSupplierLocationTableMap::CLASS_DEFAULT : PyzSupplierLocationTableMap::OM_CLASS;
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
     * @return array (PyzSupplierLocation object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = PyzSupplierLocationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PyzSupplierLocationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PyzSupplierLocationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PyzSupplierLocationTableMap::OM_CLASS;
            /** @var PyzSupplierLocation $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PyzSupplierLocationTableMap::addInstanceToPool($obj, $key);
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
            $key = PyzSupplierLocationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PyzSupplierLocationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PyzSupplierLocation $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PyzSupplierLocationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PyzSupplierLocationTableMap::COL_ID_SUPPLIER_LOCATION);
            $criteria->addSelectColumn(PyzSupplierLocationTableMap::COL_FK_SUPPLIER);
            $criteria->addSelectColumn(PyzSupplierLocationTableMap::COL_CITY);
            $criteria->addSelectColumn(PyzSupplierLocationTableMap::COL_COUNTRY);
            $criteria->addSelectColumn(PyzSupplierLocationTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(PyzSupplierLocationTableMap::COL_ZIP_CODE);
            $criteria->addSelectColumn(PyzSupplierLocationTableMap::COL_IS_DEFAULT);
        } else {
            $criteria->addSelectColumn($alias . '.id_supplier_location');
            $criteria->addSelectColumn($alias . '.fk_supplier');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.country');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.zip_code');
            $criteria->addSelectColumn($alias . '.is_default');
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
            $criteria->removeSelectColumn(PyzSupplierLocationTableMap::COL_ID_SUPPLIER_LOCATION);
            $criteria->removeSelectColumn(PyzSupplierLocationTableMap::COL_FK_SUPPLIER);
            $criteria->removeSelectColumn(PyzSupplierLocationTableMap::COL_CITY);
            $criteria->removeSelectColumn(PyzSupplierLocationTableMap::COL_COUNTRY);
            $criteria->removeSelectColumn(PyzSupplierLocationTableMap::COL_ADDRESS);
            $criteria->removeSelectColumn(PyzSupplierLocationTableMap::COL_ZIP_CODE);
            $criteria->removeSelectColumn(PyzSupplierLocationTableMap::COL_IS_DEFAULT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_supplier_location');
            $criteria->removeSelectColumn($alias . '.fk_supplier');
            $criteria->removeSelectColumn($alias . '.city');
            $criteria->removeSelectColumn($alias . '.country');
            $criteria->removeSelectColumn($alias . '.address');
            $criteria->removeSelectColumn($alias . '.zip_code');
            $criteria->removeSelectColumn($alias . '.is_default');
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
        return Propel::getServiceContainer()->getDatabaseMap(PyzSupplierLocationTableMap::DATABASE_NAME)->getTable(PyzSupplierLocationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a PyzSupplierLocation or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or PyzSupplierLocation object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PyzSupplierLocationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SupplierLocation\Persistence\PyzSupplierLocation) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PyzSupplierLocationTableMap::DATABASE_NAME);
            $criteria->add(PyzSupplierLocationTableMap::COL_ID_SUPPLIER_LOCATION, (array) $values, Criteria::IN);
        }

        $query = PyzSupplierLocationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PyzSupplierLocationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PyzSupplierLocationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the pyz_supplier_location table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return PyzSupplierLocationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PyzSupplierLocation or Criteria object.
     *
     * @param mixed $criteria Criteria or PyzSupplierLocation object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PyzSupplierLocationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PyzSupplierLocation object
        }


        // Set the correct dbName
        $query = PyzSupplierLocationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
