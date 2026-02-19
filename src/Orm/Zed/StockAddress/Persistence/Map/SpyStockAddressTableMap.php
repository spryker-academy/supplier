<?php

namespace Orm\Zed\StockAddress\Persistence\Map;

use Orm\Zed\StockAddress\Persistence\SpyStockAddress;
use Orm\Zed\StockAddress\Persistence\SpyStockAddressQuery;
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
 * This class defines the structure of the 'spy_stock_address' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyStockAddressTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.StockAddress.Persistence.Map.SpyStockAddressTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_stock_address';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyStockAddress';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\StockAddress\\Persistence\\SpyStockAddress';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.StockAddress.Persistence.SpyStockAddress';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the id_stock_address field
     */
    public const COL_ID_STOCK_ADDRESS = 'spy_stock_address.id_stock_address';

    /**
     * the column name for the fk_stock field
     */
    public const COL_FK_STOCK = 'spy_stock_address.fk_stock';

    /**
     * the column name for the fk_country field
     */
    public const COL_FK_COUNTRY = 'spy_stock_address.fk_country';

    /**
     * the column name for the fk_region field
     */
    public const COL_FK_REGION = 'spy_stock_address.fk_region';

    /**
     * the column name for the address1 field
     */
    public const COL_ADDRESS1 = 'spy_stock_address.address1';

    /**
     * the column name for the address2 field
     */
    public const COL_ADDRESS2 = 'spy_stock_address.address2';

    /**
     * the column name for the address3 field
     */
    public const COL_ADDRESS3 = 'spy_stock_address.address3';

    /**
     * the column name for the city field
     */
    public const COL_CITY = 'spy_stock_address.city';

    /**
     * the column name for the zip_code field
     */
    public const COL_ZIP_CODE = 'spy_stock_address.zip_code';

    /**
     * the column name for the phone field
     */
    public const COL_PHONE = 'spy_stock_address.phone';

    /**
     * the column name for the comment field
     */
    public const COL_COMMENT = 'spy_stock_address.comment';

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
        self::TYPE_PHPNAME       => ['IdStockAddress', 'FkStock', 'FkCountry', 'FkRegion', 'Address1', 'Address2', 'Address3', 'City', 'ZipCode', 'Phone', 'Comment', ],
        self::TYPE_CAMELNAME     => ['idStockAddress', 'fkStock', 'fkCountry', 'fkRegion', 'address1', 'address2', 'address3', 'city', 'zipCode', 'phone', 'comment', ],
        self::TYPE_COLNAME       => [SpyStockAddressTableMap::COL_ID_STOCK_ADDRESS, SpyStockAddressTableMap::COL_FK_STOCK, SpyStockAddressTableMap::COL_FK_COUNTRY, SpyStockAddressTableMap::COL_FK_REGION, SpyStockAddressTableMap::COL_ADDRESS1, SpyStockAddressTableMap::COL_ADDRESS2, SpyStockAddressTableMap::COL_ADDRESS3, SpyStockAddressTableMap::COL_CITY, SpyStockAddressTableMap::COL_ZIP_CODE, SpyStockAddressTableMap::COL_PHONE, SpyStockAddressTableMap::COL_COMMENT, ],
        self::TYPE_FIELDNAME     => ['id_stock_address', 'fk_stock', 'fk_country', 'fk_region', 'address1', 'address2', 'address3', 'city', 'zip_code', 'phone', 'comment', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
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
        self::TYPE_PHPNAME       => ['IdStockAddress' => 0, 'FkStock' => 1, 'FkCountry' => 2, 'FkRegion' => 3, 'Address1' => 4, 'Address2' => 5, 'Address3' => 6, 'City' => 7, 'ZipCode' => 8, 'Phone' => 9, 'Comment' => 10, ],
        self::TYPE_CAMELNAME     => ['idStockAddress' => 0, 'fkStock' => 1, 'fkCountry' => 2, 'fkRegion' => 3, 'address1' => 4, 'address2' => 5, 'address3' => 6, 'city' => 7, 'zipCode' => 8, 'phone' => 9, 'comment' => 10, ],
        self::TYPE_COLNAME       => [SpyStockAddressTableMap::COL_ID_STOCK_ADDRESS => 0, SpyStockAddressTableMap::COL_FK_STOCK => 1, SpyStockAddressTableMap::COL_FK_COUNTRY => 2, SpyStockAddressTableMap::COL_FK_REGION => 3, SpyStockAddressTableMap::COL_ADDRESS1 => 4, SpyStockAddressTableMap::COL_ADDRESS2 => 5, SpyStockAddressTableMap::COL_ADDRESS3 => 6, SpyStockAddressTableMap::COL_CITY => 7, SpyStockAddressTableMap::COL_ZIP_CODE => 8, SpyStockAddressTableMap::COL_PHONE => 9, SpyStockAddressTableMap::COL_COMMENT => 10, ],
        self::TYPE_FIELDNAME     => ['id_stock_address' => 0, 'fk_stock' => 1, 'fk_country' => 2, 'fk_region' => 3, 'address1' => 4, 'address2' => 5, 'address3' => 6, 'city' => 7, 'zip_code' => 8, 'phone' => 9, 'comment' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdStockAddress' => 'ID_STOCK_ADDRESS',
        'SpyStockAddress.IdStockAddress' => 'ID_STOCK_ADDRESS',
        'idStockAddress' => 'ID_STOCK_ADDRESS',
        'spyStockAddress.idStockAddress' => 'ID_STOCK_ADDRESS',
        'SpyStockAddressTableMap::COL_ID_STOCK_ADDRESS' => 'ID_STOCK_ADDRESS',
        'COL_ID_STOCK_ADDRESS' => 'ID_STOCK_ADDRESS',
        'id_stock_address' => 'ID_STOCK_ADDRESS',
        'spy_stock_address.id_stock_address' => 'ID_STOCK_ADDRESS',
        'FkStock' => 'FK_STOCK',
        'SpyStockAddress.FkStock' => 'FK_STOCK',
        'fkStock' => 'FK_STOCK',
        'spyStockAddress.fkStock' => 'FK_STOCK',
        'SpyStockAddressTableMap::COL_FK_STOCK' => 'FK_STOCK',
        'COL_FK_STOCK' => 'FK_STOCK',
        'fk_stock' => 'FK_STOCK',
        'spy_stock_address.fk_stock' => 'FK_STOCK',
        'FkCountry' => 'FK_COUNTRY',
        'SpyStockAddress.FkCountry' => 'FK_COUNTRY',
        'fkCountry' => 'FK_COUNTRY',
        'spyStockAddress.fkCountry' => 'FK_COUNTRY',
        'SpyStockAddressTableMap::COL_FK_COUNTRY' => 'FK_COUNTRY',
        'COL_FK_COUNTRY' => 'FK_COUNTRY',
        'fk_country' => 'FK_COUNTRY',
        'spy_stock_address.fk_country' => 'FK_COUNTRY',
        'FkRegion' => 'FK_REGION',
        'SpyStockAddress.FkRegion' => 'FK_REGION',
        'fkRegion' => 'FK_REGION',
        'spyStockAddress.fkRegion' => 'FK_REGION',
        'SpyStockAddressTableMap::COL_FK_REGION' => 'FK_REGION',
        'COL_FK_REGION' => 'FK_REGION',
        'fk_region' => 'FK_REGION',
        'spy_stock_address.fk_region' => 'FK_REGION',
        'Address1' => 'ADDRESS1',
        'SpyStockAddress.Address1' => 'ADDRESS1',
        'address1' => 'ADDRESS1',
        'spyStockAddress.address1' => 'ADDRESS1',
        'SpyStockAddressTableMap::COL_ADDRESS1' => 'ADDRESS1',
        'COL_ADDRESS1' => 'ADDRESS1',
        'spy_stock_address.address1' => 'ADDRESS1',
        'Address2' => 'ADDRESS2',
        'SpyStockAddress.Address2' => 'ADDRESS2',
        'address2' => 'ADDRESS2',
        'spyStockAddress.address2' => 'ADDRESS2',
        'SpyStockAddressTableMap::COL_ADDRESS2' => 'ADDRESS2',
        'COL_ADDRESS2' => 'ADDRESS2',
        'spy_stock_address.address2' => 'ADDRESS2',
        'Address3' => 'ADDRESS3',
        'SpyStockAddress.Address3' => 'ADDRESS3',
        'address3' => 'ADDRESS3',
        'spyStockAddress.address3' => 'ADDRESS3',
        'SpyStockAddressTableMap::COL_ADDRESS3' => 'ADDRESS3',
        'COL_ADDRESS3' => 'ADDRESS3',
        'spy_stock_address.address3' => 'ADDRESS3',
        'City' => 'CITY',
        'SpyStockAddress.City' => 'CITY',
        'city' => 'CITY',
        'spyStockAddress.city' => 'CITY',
        'SpyStockAddressTableMap::COL_CITY' => 'CITY',
        'COL_CITY' => 'CITY',
        'spy_stock_address.city' => 'CITY',
        'ZipCode' => 'ZIP_CODE',
        'SpyStockAddress.ZipCode' => 'ZIP_CODE',
        'zipCode' => 'ZIP_CODE',
        'spyStockAddress.zipCode' => 'ZIP_CODE',
        'SpyStockAddressTableMap::COL_ZIP_CODE' => 'ZIP_CODE',
        'COL_ZIP_CODE' => 'ZIP_CODE',
        'zip_code' => 'ZIP_CODE',
        'spy_stock_address.zip_code' => 'ZIP_CODE',
        'Phone' => 'PHONE',
        'SpyStockAddress.Phone' => 'PHONE',
        'phone' => 'PHONE',
        'spyStockAddress.phone' => 'PHONE',
        'SpyStockAddressTableMap::COL_PHONE' => 'PHONE',
        'COL_PHONE' => 'PHONE',
        'spy_stock_address.phone' => 'PHONE',
        'Comment' => 'COMMENT',
        'SpyStockAddress.Comment' => 'COMMENT',
        'comment' => 'COMMENT',
        'spyStockAddress.comment' => 'COMMENT',
        'SpyStockAddressTableMap::COL_COMMENT' => 'COMMENT',
        'COL_COMMENT' => 'COMMENT',
        'spy_stock_address.comment' => 'COMMENT',
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
        $this->setName('spy_stock_address');
        $this->setPhpName('SpyStockAddress');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\StockAddress\\Persistence\\SpyStockAddress');
        $this->setPackage('src.Orm.Zed.StockAddress.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_stock_address_pk_seq');
        // columns
        $this->addPrimaryKey('id_stock_address', 'IdStockAddress', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_stock', 'FkStock', 'INTEGER', 'spy_stock', 'id_stock', true, null, null);
        $this->addForeignKey('fk_country', 'FkCountry', 'INTEGER', 'spy_country', 'id_country', true, null, null);
        $this->addForeignKey('fk_region', 'FkRegion', 'INTEGER', 'spy_region', 'id_region', false, null, null);
        $this->addColumn('address1', 'Address1', 'VARCHAR', true, 255, null);
        $this->addColumn('address2', 'Address2', 'VARCHAR', false, 255, null);
        $this->addColumn('address3', 'Address3', 'VARCHAR', false, 255, null);
        $this->addColumn('city', 'City', 'VARCHAR', true, 255, null);
        $this->addColumn('zip_code', 'ZipCode', 'VARCHAR', true, 15, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, 255, null);
        $this->addColumn('comment', 'Comment', 'VARCHAR', false, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Stock', '\\Orm\\Zed\\Stock\\Persistence\\SpyStock', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_stock',
    1 => ':id_stock',
  ),
), null, null, null, false);
        $this->addRelation('Country', '\\Orm\\Zed\\Country\\Persistence\\SpyCountry', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_country',
    1 => ':id_country',
  ),
), null, null, null, false);
        $this->addRelation('Region', '\\Orm\\Zed\\Country\\Persistence\\SpyRegion', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_region',
    1 => ':id_region',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStockAddress', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStockAddress', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStockAddress', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStockAddress', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStockAddress', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdStockAddress', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdStockAddress', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyStockAddressTableMap::CLASS_DEFAULT : SpyStockAddressTableMap::OM_CLASS;
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
     * @return array (SpyStockAddress object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyStockAddressTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyStockAddressTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyStockAddressTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyStockAddressTableMap::OM_CLASS;
            /** @var SpyStockAddress $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyStockAddressTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyStockAddressTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyStockAddressTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyStockAddress $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyStockAddressTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyStockAddressTableMap::COL_ID_STOCK_ADDRESS);
            $criteria->addSelectColumn(SpyStockAddressTableMap::COL_FK_STOCK);
            $criteria->addSelectColumn(SpyStockAddressTableMap::COL_FK_COUNTRY);
            $criteria->addSelectColumn(SpyStockAddressTableMap::COL_FK_REGION);
            $criteria->addSelectColumn(SpyStockAddressTableMap::COL_ADDRESS1);
            $criteria->addSelectColumn(SpyStockAddressTableMap::COL_ADDRESS2);
            $criteria->addSelectColumn(SpyStockAddressTableMap::COL_ADDRESS3);
            $criteria->addSelectColumn(SpyStockAddressTableMap::COL_CITY);
            $criteria->addSelectColumn(SpyStockAddressTableMap::COL_ZIP_CODE);
            $criteria->addSelectColumn(SpyStockAddressTableMap::COL_PHONE);
            $criteria->addSelectColumn(SpyStockAddressTableMap::COL_COMMENT);
        } else {
            $criteria->addSelectColumn($alias . '.id_stock_address');
            $criteria->addSelectColumn($alias . '.fk_stock');
            $criteria->addSelectColumn($alias . '.fk_country');
            $criteria->addSelectColumn($alias . '.fk_region');
            $criteria->addSelectColumn($alias . '.address1');
            $criteria->addSelectColumn($alias . '.address2');
            $criteria->addSelectColumn($alias . '.address3');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.zip_code');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.comment');
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
            $criteria->removeSelectColumn(SpyStockAddressTableMap::COL_ID_STOCK_ADDRESS);
            $criteria->removeSelectColumn(SpyStockAddressTableMap::COL_FK_STOCK);
            $criteria->removeSelectColumn(SpyStockAddressTableMap::COL_FK_COUNTRY);
            $criteria->removeSelectColumn(SpyStockAddressTableMap::COL_FK_REGION);
            $criteria->removeSelectColumn(SpyStockAddressTableMap::COL_ADDRESS1);
            $criteria->removeSelectColumn(SpyStockAddressTableMap::COL_ADDRESS2);
            $criteria->removeSelectColumn(SpyStockAddressTableMap::COL_ADDRESS3);
            $criteria->removeSelectColumn(SpyStockAddressTableMap::COL_CITY);
            $criteria->removeSelectColumn(SpyStockAddressTableMap::COL_ZIP_CODE);
            $criteria->removeSelectColumn(SpyStockAddressTableMap::COL_PHONE);
            $criteria->removeSelectColumn(SpyStockAddressTableMap::COL_COMMENT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_stock_address');
            $criteria->removeSelectColumn($alias . '.fk_stock');
            $criteria->removeSelectColumn($alias . '.fk_country');
            $criteria->removeSelectColumn($alias . '.fk_region');
            $criteria->removeSelectColumn($alias . '.address1');
            $criteria->removeSelectColumn($alias . '.address2');
            $criteria->removeSelectColumn($alias . '.address3');
            $criteria->removeSelectColumn($alias . '.city');
            $criteria->removeSelectColumn($alias . '.zip_code');
            $criteria->removeSelectColumn($alias . '.phone');
            $criteria->removeSelectColumn($alias . '.comment');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyStockAddressTableMap::DATABASE_NAME)->getTable(SpyStockAddressTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyStockAddress or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyStockAddress object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStockAddressTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\StockAddress\Persistence\SpyStockAddress) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyStockAddressTableMap::DATABASE_NAME);
            $criteria->add(SpyStockAddressTableMap::COL_ID_STOCK_ADDRESS, (array) $values, Criteria::IN);
        }

        $query = SpyStockAddressQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyStockAddressTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyStockAddressTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_stock_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyStockAddressQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyStockAddress or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyStockAddress object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyStockAddressTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyStockAddress object
        }

        if ($criteria->containsKey(SpyStockAddressTableMap::COL_ID_STOCK_ADDRESS) && $criteria->keyContainsValue(SpyStockAddressTableMap::COL_ID_STOCK_ADDRESS) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyStockAddressTableMap::COL_ID_STOCK_ADDRESS.')');
        }


        // Set the correct dbName
        $query = SpyStockAddressQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
