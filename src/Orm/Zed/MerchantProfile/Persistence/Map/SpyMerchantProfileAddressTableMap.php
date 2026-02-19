<?php

namespace Orm\Zed\MerchantProfile\Persistence\Map;

use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress;
use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddressQuery;
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
 * This class defines the structure of the 'spy_merchant_profile_address' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyMerchantProfileAddressTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MerchantProfile.Persistence.Map.SpyMerchantProfileAddressTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_merchant_profile_address';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyMerchantProfileAddress';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MerchantProfile\\Persistence\\SpyMerchantProfileAddress';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MerchantProfile.Persistence.SpyMerchantProfileAddress';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id_merchant_profile_address field
     */
    public const COL_ID_MERCHANT_PROFILE_ADDRESS = 'spy_merchant_profile_address.id_merchant_profile_address';

    /**
     * the column name for the fk_country field
     */
    public const COL_FK_COUNTRY = 'spy_merchant_profile_address.fk_country';

    /**
     * the column name for the address1 field
     */
    public const COL_ADDRESS1 = 'spy_merchant_profile_address.address1';

    /**
     * the column name for the address2 field
     */
    public const COL_ADDRESS2 = 'spy_merchant_profile_address.address2';

    /**
     * the column name for the address3 field
     */
    public const COL_ADDRESS3 = 'spy_merchant_profile_address.address3';

    /**
     * the column name for the city field
     */
    public const COL_CITY = 'spy_merchant_profile_address.city';

    /**
     * the column name for the zip_code field
     */
    public const COL_ZIP_CODE = 'spy_merchant_profile_address.zip_code';

    /**
     * the column name for the fk_merchant_profile field
     */
    public const COL_FK_MERCHANT_PROFILE = 'spy_merchant_profile_address.fk_merchant_profile';

    /**
     * the column name for the longitude field
     */
    public const COL_LONGITUDE = 'spy_merchant_profile_address.longitude';

    /**
     * the column name for the latitude field
     */
    public const COL_LATITUDE = 'spy_merchant_profile_address.latitude';

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
        self::TYPE_PHPNAME       => ['IdMerchantProfileAddress', 'FkCountry', 'Address1', 'Address2', 'Address3', 'City', 'ZipCode', 'FkMerchantProfile', 'Longitude', 'Latitude', ],
        self::TYPE_CAMELNAME     => ['idMerchantProfileAddress', 'fkCountry', 'address1', 'address2', 'address3', 'city', 'zipCode', 'fkMerchantProfile', 'longitude', 'latitude', ],
        self::TYPE_COLNAME       => [SpyMerchantProfileAddressTableMap::COL_ID_MERCHANT_PROFILE_ADDRESS, SpyMerchantProfileAddressTableMap::COL_FK_COUNTRY, SpyMerchantProfileAddressTableMap::COL_ADDRESS1, SpyMerchantProfileAddressTableMap::COL_ADDRESS2, SpyMerchantProfileAddressTableMap::COL_ADDRESS3, SpyMerchantProfileAddressTableMap::COL_CITY, SpyMerchantProfileAddressTableMap::COL_ZIP_CODE, SpyMerchantProfileAddressTableMap::COL_FK_MERCHANT_PROFILE, SpyMerchantProfileAddressTableMap::COL_LONGITUDE, SpyMerchantProfileAddressTableMap::COL_LATITUDE, ],
        self::TYPE_FIELDNAME     => ['id_merchant_profile_address', 'fk_country', 'address1', 'address2', 'address3', 'city', 'zip_code', 'fk_merchant_profile', 'longitude', 'latitude', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['IdMerchantProfileAddress' => 0, 'FkCountry' => 1, 'Address1' => 2, 'Address2' => 3, 'Address3' => 4, 'City' => 5, 'ZipCode' => 6, 'FkMerchantProfile' => 7, 'Longitude' => 8, 'Latitude' => 9, ],
        self::TYPE_CAMELNAME     => ['idMerchantProfileAddress' => 0, 'fkCountry' => 1, 'address1' => 2, 'address2' => 3, 'address3' => 4, 'city' => 5, 'zipCode' => 6, 'fkMerchantProfile' => 7, 'longitude' => 8, 'latitude' => 9, ],
        self::TYPE_COLNAME       => [SpyMerchantProfileAddressTableMap::COL_ID_MERCHANT_PROFILE_ADDRESS => 0, SpyMerchantProfileAddressTableMap::COL_FK_COUNTRY => 1, SpyMerchantProfileAddressTableMap::COL_ADDRESS1 => 2, SpyMerchantProfileAddressTableMap::COL_ADDRESS2 => 3, SpyMerchantProfileAddressTableMap::COL_ADDRESS3 => 4, SpyMerchantProfileAddressTableMap::COL_CITY => 5, SpyMerchantProfileAddressTableMap::COL_ZIP_CODE => 6, SpyMerchantProfileAddressTableMap::COL_FK_MERCHANT_PROFILE => 7, SpyMerchantProfileAddressTableMap::COL_LONGITUDE => 8, SpyMerchantProfileAddressTableMap::COL_LATITUDE => 9, ],
        self::TYPE_FIELDNAME     => ['id_merchant_profile_address' => 0, 'fk_country' => 1, 'address1' => 2, 'address2' => 3, 'address3' => 4, 'city' => 5, 'zip_code' => 6, 'fk_merchant_profile' => 7, 'longitude' => 8, 'latitude' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdMerchantProfileAddress' => 'ID_MERCHANT_PROFILE_ADDRESS',
        'SpyMerchantProfileAddress.IdMerchantProfileAddress' => 'ID_MERCHANT_PROFILE_ADDRESS',
        'idMerchantProfileAddress' => 'ID_MERCHANT_PROFILE_ADDRESS',
        'spyMerchantProfileAddress.idMerchantProfileAddress' => 'ID_MERCHANT_PROFILE_ADDRESS',
        'SpyMerchantProfileAddressTableMap::COL_ID_MERCHANT_PROFILE_ADDRESS' => 'ID_MERCHANT_PROFILE_ADDRESS',
        'COL_ID_MERCHANT_PROFILE_ADDRESS' => 'ID_MERCHANT_PROFILE_ADDRESS',
        'id_merchant_profile_address' => 'ID_MERCHANT_PROFILE_ADDRESS',
        'spy_merchant_profile_address.id_merchant_profile_address' => 'ID_MERCHANT_PROFILE_ADDRESS',
        'FkCountry' => 'FK_COUNTRY',
        'SpyMerchantProfileAddress.FkCountry' => 'FK_COUNTRY',
        'fkCountry' => 'FK_COUNTRY',
        'spyMerchantProfileAddress.fkCountry' => 'FK_COUNTRY',
        'SpyMerchantProfileAddressTableMap::COL_FK_COUNTRY' => 'FK_COUNTRY',
        'COL_FK_COUNTRY' => 'FK_COUNTRY',
        'fk_country' => 'FK_COUNTRY',
        'spy_merchant_profile_address.fk_country' => 'FK_COUNTRY',
        'Address1' => 'ADDRESS1',
        'SpyMerchantProfileAddress.Address1' => 'ADDRESS1',
        'address1' => 'ADDRESS1',
        'spyMerchantProfileAddress.address1' => 'ADDRESS1',
        'SpyMerchantProfileAddressTableMap::COL_ADDRESS1' => 'ADDRESS1',
        'COL_ADDRESS1' => 'ADDRESS1',
        'spy_merchant_profile_address.address1' => 'ADDRESS1',
        'Address2' => 'ADDRESS2',
        'SpyMerchantProfileAddress.Address2' => 'ADDRESS2',
        'address2' => 'ADDRESS2',
        'spyMerchantProfileAddress.address2' => 'ADDRESS2',
        'SpyMerchantProfileAddressTableMap::COL_ADDRESS2' => 'ADDRESS2',
        'COL_ADDRESS2' => 'ADDRESS2',
        'spy_merchant_profile_address.address2' => 'ADDRESS2',
        'Address3' => 'ADDRESS3',
        'SpyMerchantProfileAddress.Address3' => 'ADDRESS3',
        'address3' => 'ADDRESS3',
        'spyMerchantProfileAddress.address3' => 'ADDRESS3',
        'SpyMerchantProfileAddressTableMap::COL_ADDRESS3' => 'ADDRESS3',
        'COL_ADDRESS3' => 'ADDRESS3',
        'spy_merchant_profile_address.address3' => 'ADDRESS3',
        'City' => 'CITY',
        'SpyMerchantProfileAddress.City' => 'CITY',
        'city' => 'CITY',
        'spyMerchantProfileAddress.city' => 'CITY',
        'SpyMerchantProfileAddressTableMap::COL_CITY' => 'CITY',
        'COL_CITY' => 'CITY',
        'spy_merchant_profile_address.city' => 'CITY',
        'ZipCode' => 'ZIP_CODE',
        'SpyMerchantProfileAddress.ZipCode' => 'ZIP_CODE',
        'zipCode' => 'ZIP_CODE',
        'spyMerchantProfileAddress.zipCode' => 'ZIP_CODE',
        'SpyMerchantProfileAddressTableMap::COL_ZIP_CODE' => 'ZIP_CODE',
        'COL_ZIP_CODE' => 'ZIP_CODE',
        'zip_code' => 'ZIP_CODE',
        'spy_merchant_profile_address.zip_code' => 'ZIP_CODE',
        'FkMerchantProfile' => 'FK_MERCHANT_PROFILE',
        'SpyMerchantProfileAddress.FkMerchantProfile' => 'FK_MERCHANT_PROFILE',
        'fkMerchantProfile' => 'FK_MERCHANT_PROFILE',
        'spyMerchantProfileAddress.fkMerchantProfile' => 'FK_MERCHANT_PROFILE',
        'SpyMerchantProfileAddressTableMap::COL_FK_MERCHANT_PROFILE' => 'FK_MERCHANT_PROFILE',
        'COL_FK_MERCHANT_PROFILE' => 'FK_MERCHANT_PROFILE',
        'fk_merchant_profile' => 'FK_MERCHANT_PROFILE',
        'spy_merchant_profile_address.fk_merchant_profile' => 'FK_MERCHANT_PROFILE',
        'Longitude' => 'LONGITUDE',
        'SpyMerchantProfileAddress.Longitude' => 'LONGITUDE',
        'longitude' => 'LONGITUDE',
        'spyMerchantProfileAddress.longitude' => 'LONGITUDE',
        'SpyMerchantProfileAddressTableMap::COL_LONGITUDE' => 'LONGITUDE',
        'COL_LONGITUDE' => 'LONGITUDE',
        'spy_merchant_profile_address.longitude' => 'LONGITUDE',
        'Latitude' => 'LATITUDE',
        'SpyMerchantProfileAddress.Latitude' => 'LATITUDE',
        'latitude' => 'LATITUDE',
        'spyMerchantProfileAddress.latitude' => 'LATITUDE',
        'SpyMerchantProfileAddressTableMap::COL_LATITUDE' => 'LATITUDE',
        'COL_LATITUDE' => 'LATITUDE',
        'spy_merchant_profile_address.latitude' => 'LATITUDE',
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
        $this->setName('spy_merchant_profile_address');
        $this->setPhpName('SpyMerchantProfileAddress');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\MerchantProfile\\Persistence\\SpyMerchantProfileAddress');
        $this->setPackage('src.Orm.Zed.MerchantProfile.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_merchant_profile_address_pk_seq');
        // columns
        $this->addPrimaryKey('id_merchant_profile_address', 'IdMerchantProfileAddress', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_country', 'FkCountry', 'INTEGER', 'spy_country', 'id_country', false, null, null);
        $this->addColumn('address1', 'Address1', 'VARCHAR', false, 255, null);
        $this->addColumn('address2', 'Address2', 'VARCHAR', false, 255, null);
        $this->addColumn('address3', 'Address3', 'VARCHAR', false, 255, null);
        $this->addColumn('city', 'City', 'VARCHAR', false, 255, null);
        $this->addColumn('zip_code', 'ZipCode', 'VARCHAR', false, 15, null);
        $this->addForeignKey('fk_merchant_profile', 'FkMerchantProfile', 'INTEGER', 'spy_merchant_profile', 'id_merchant_profile', true, null, null);
        $this->addColumn('longitude', 'Longitude', 'VARCHAR', false, 255, null);
        $this->addColumn('latitude', 'Latitude', 'VARCHAR', false, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyCountry', '\\Orm\\Zed\\Country\\Persistence\\SpyCountry', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_country',
    1 => ':id_country',
  ),
), null, null, null, false);
        $this->addRelation('SpyMerchantProfile', '\\Orm\\Zed\\MerchantProfile\\Persistence\\SpyMerchantProfile', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_merchant_profile',
    1 => ':id_merchant_profile',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantProfileAddress', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantProfileAddress', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantProfileAddress', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantProfileAddress', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantProfileAddress', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantProfileAddress', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdMerchantProfileAddress', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyMerchantProfileAddressTableMap::CLASS_DEFAULT : SpyMerchantProfileAddressTableMap::OM_CLASS;
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
     * @return array (SpyMerchantProfileAddress object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyMerchantProfileAddressTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyMerchantProfileAddressTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyMerchantProfileAddressTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyMerchantProfileAddressTableMap::OM_CLASS;
            /** @var SpyMerchantProfileAddress $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyMerchantProfileAddressTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyMerchantProfileAddressTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyMerchantProfileAddressTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyMerchantProfileAddress $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyMerchantProfileAddressTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyMerchantProfileAddressTableMap::COL_ID_MERCHANT_PROFILE_ADDRESS);
            $criteria->addSelectColumn(SpyMerchantProfileAddressTableMap::COL_FK_COUNTRY);
            $criteria->addSelectColumn(SpyMerchantProfileAddressTableMap::COL_ADDRESS1);
            $criteria->addSelectColumn(SpyMerchantProfileAddressTableMap::COL_ADDRESS2);
            $criteria->addSelectColumn(SpyMerchantProfileAddressTableMap::COL_ADDRESS3);
            $criteria->addSelectColumn(SpyMerchantProfileAddressTableMap::COL_CITY);
            $criteria->addSelectColumn(SpyMerchantProfileAddressTableMap::COL_ZIP_CODE);
            $criteria->addSelectColumn(SpyMerchantProfileAddressTableMap::COL_FK_MERCHANT_PROFILE);
            $criteria->addSelectColumn(SpyMerchantProfileAddressTableMap::COL_LONGITUDE);
            $criteria->addSelectColumn(SpyMerchantProfileAddressTableMap::COL_LATITUDE);
        } else {
            $criteria->addSelectColumn($alias . '.id_merchant_profile_address');
            $criteria->addSelectColumn($alias . '.fk_country');
            $criteria->addSelectColumn($alias . '.address1');
            $criteria->addSelectColumn($alias . '.address2');
            $criteria->addSelectColumn($alias . '.address3');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.zip_code');
            $criteria->addSelectColumn($alias . '.fk_merchant_profile');
            $criteria->addSelectColumn($alias . '.longitude');
            $criteria->addSelectColumn($alias . '.latitude');
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
            $criteria->removeSelectColumn(SpyMerchantProfileAddressTableMap::COL_ID_MERCHANT_PROFILE_ADDRESS);
            $criteria->removeSelectColumn(SpyMerchantProfileAddressTableMap::COL_FK_COUNTRY);
            $criteria->removeSelectColumn(SpyMerchantProfileAddressTableMap::COL_ADDRESS1);
            $criteria->removeSelectColumn(SpyMerchantProfileAddressTableMap::COL_ADDRESS2);
            $criteria->removeSelectColumn(SpyMerchantProfileAddressTableMap::COL_ADDRESS3);
            $criteria->removeSelectColumn(SpyMerchantProfileAddressTableMap::COL_CITY);
            $criteria->removeSelectColumn(SpyMerchantProfileAddressTableMap::COL_ZIP_CODE);
            $criteria->removeSelectColumn(SpyMerchantProfileAddressTableMap::COL_FK_MERCHANT_PROFILE);
            $criteria->removeSelectColumn(SpyMerchantProfileAddressTableMap::COL_LONGITUDE);
            $criteria->removeSelectColumn(SpyMerchantProfileAddressTableMap::COL_LATITUDE);
        } else {
            $criteria->removeSelectColumn($alias . '.id_merchant_profile_address');
            $criteria->removeSelectColumn($alias . '.fk_country');
            $criteria->removeSelectColumn($alias . '.address1');
            $criteria->removeSelectColumn($alias . '.address2');
            $criteria->removeSelectColumn($alias . '.address3');
            $criteria->removeSelectColumn($alias . '.city');
            $criteria->removeSelectColumn($alias . '.zip_code');
            $criteria->removeSelectColumn($alias . '.fk_merchant_profile');
            $criteria->removeSelectColumn($alias . '.longitude');
            $criteria->removeSelectColumn($alias . '.latitude');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyMerchantProfileAddressTableMap::DATABASE_NAME)->getTable(SpyMerchantProfileAddressTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyMerchantProfileAddress or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyMerchantProfileAddress object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantProfileAddressTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileAddress) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyMerchantProfileAddressTableMap::DATABASE_NAME);
            $criteria->add(SpyMerchantProfileAddressTableMap::COL_ID_MERCHANT_PROFILE_ADDRESS, (array) $values, Criteria::IN);
        }

        $query = SpyMerchantProfileAddressQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyMerchantProfileAddressTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyMerchantProfileAddressTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_merchant_profile_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyMerchantProfileAddressQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyMerchantProfileAddress or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyMerchantProfileAddress object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantProfileAddressTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyMerchantProfileAddress object
        }

        if ($criteria->containsKey(SpyMerchantProfileAddressTableMap::COL_ID_MERCHANT_PROFILE_ADDRESS) && $criteria->keyContainsValue(SpyMerchantProfileAddressTableMap::COL_ID_MERCHANT_PROFILE_ADDRESS) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyMerchantProfileAddressTableMap::COL_ID_MERCHANT_PROFILE_ADDRESS.')');
        }


        // Set the correct dbName
        $query = SpyMerchantProfileAddressQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
