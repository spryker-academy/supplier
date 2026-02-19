<?php

namespace Orm\Zed\ServicePoint\Persistence\Map;

use Orm\Zed\ServicePoint\Persistence\SpyServicePointAddress;
use Orm\Zed\ServicePoint\Persistence\SpyServicePointAddressQuery;
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
 * This class defines the structure of the 'spy_service_point_address' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyServicePointAddressTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ServicePoint.Persistence.Map.SpyServicePointAddressTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_service_point_address';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyServicePointAddress';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ServicePoint\\Persistence\\SpyServicePointAddress';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ServicePoint.Persistence.SpyServicePointAddress';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the id_service_point_address field
     */
    public const COL_ID_SERVICE_POINT_ADDRESS = 'spy_service_point_address.id_service_point_address';

    /**
     * the column name for the fk_country field
     */
    public const COL_FK_COUNTRY = 'spy_service_point_address.fk_country';

    /**
     * the column name for the fk_region field
     */
    public const COL_FK_REGION = 'spy_service_point_address.fk_region';

    /**
     * the column name for the fk_service_point field
     */
    public const COL_FK_SERVICE_POINT = 'spy_service_point_address.fk_service_point';

    /**
     * the column name for the address1 field
     */
    public const COL_ADDRESS1 = 'spy_service_point_address.address1';

    /**
     * the column name for the address2 field
     */
    public const COL_ADDRESS2 = 'spy_service_point_address.address2';

    /**
     * the column name for the address3 field
     */
    public const COL_ADDRESS3 = 'spy_service_point_address.address3';

    /**
     * the column name for the city field
     */
    public const COL_CITY = 'spy_service_point_address.city';

    /**
     * the column name for the latitude field
     */
    public const COL_LATITUDE = 'spy_service_point_address.latitude';

    /**
     * the column name for the longitude field
     */
    public const COL_LONGITUDE = 'spy_service_point_address.longitude';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_service_point_address.uuid';

    /**
     * the column name for the zip_code field
     */
    public const COL_ZIP_CODE = 'spy_service_point_address.zip_code';

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
        self::TYPE_PHPNAME       => ['IdServicePointAddress', 'FkCountry', 'FkRegion', 'FkServicePoint', 'Address1', 'Address2', 'Address3', 'City', 'Latitude', 'Longitude', 'Uuid', 'ZipCode', ],
        self::TYPE_CAMELNAME     => ['idServicePointAddress', 'fkCountry', 'fkRegion', 'fkServicePoint', 'address1', 'address2', 'address3', 'city', 'latitude', 'longitude', 'uuid', 'zipCode', ],
        self::TYPE_COLNAME       => [SpyServicePointAddressTableMap::COL_ID_SERVICE_POINT_ADDRESS, SpyServicePointAddressTableMap::COL_FK_COUNTRY, SpyServicePointAddressTableMap::COL_FK_REGION, SpyServicePointAddressTableMap::COL_FK_SERVICE_POINT, SpyServicePointAddressTableMap::COL_ADDRESS1, SpyServicePointAddressTableMap::COL_ADDRESS2, SpyServicePointAddressTableMap::COL_ADDRESS3, SpyServicePointAddressTableMap::COL_CITY, SpyServicePointAddressTableMap::COL_LATITUDE, SpyServicePointAddressTableMap::COL_LONGITUDE, SpyServicePointAddressTableMap::COL_UUID, SpyServicePointAddressTableMap::COL_ZIP_CODE, ],
        self::TYPE_FIELDNAME     => ['id_service_point_address', 'fk_country', 'fk_region', 'fk_service_point', 'address1', 'address2', 'address3', 'city', 'latitude', 'longitude', 'uuid', 'zip_code', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
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
        self::TYPE_PHPNAME       => ['IdServicePointAddress' => 0, 'FkCountry' => 1, 'FkRegion' => 2, 'FkServicePoint' => 3, 'Address1' => 4, 'Address2' => 5, 'Address3' => 6, 'City' => 7, 'Latitude' => 8, 'Longitude' => 9, 'Uuid' => 10, 'ZipCode' => 11, ],
        self::TYPE_CAMELNAME     => ['idServicePointAddress' => 0, 'fkCountry' => 1, 'fkRegion' => 2, 'fkServicePoint' => 3, 'address1' => 4, 'address2' => 5, 'address3' => 6, 'city' => 7, 'latitude' => 8, 'longitude' => 9, 'uuid' => 10, 'zipCode' => 11, ],
        self::TYPE_COLNAME       => [SpyServicePointAddressTableMap::COL_ID_SERVICE_POINT_ADDRESS => 0, SpyServicePointAddressTableMap::COL_FK_COUNTRY => 1, SpyServicePointAddressTableMap::COL_FK_REGION => 2, SpyServicePointAddressTableMap::COL_FK_SERVICE_POINT => 3, SpyServicePointAddressTableMap::COL_ADDRESS1 => 4, SpyServicePointAddressTableMap::COL_ADDRESS2 => 5, SpyServicePointAddressTableMap::COL_ADDRESS3 => 6, SpyServicePointAddressTableMap::COL_CITY => 7, SpyServicePointAddressTableMap::COL_LATITUDE => 8, SpyServicePointAddressTableMap::COL_LONGITUDE => 9, SpyServicePointAddressTableMap::COL_UUID => 10, SpyServicePointAddressTableMap::COL_ZIP_CODE => 11, ],
        self::TYPE_FIELDNAME     => ['id_service_point_address' => 0, 'fk_country' => 1, 'fk_region' => 2, 'fk_service_point' => 3, 'address1' => 4, 'address2' => 5, 'address3' => 6, 'city' => 7, 'latitude' => 8, 'longitude' => 9, 'uuid' => 10, 'zip_code' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdServicePointAddress' => 'ID_SERVICE_POINT_ADDRESS',
        'SpyServicePointAddress.IdServicePointAddress' => 'ID_SERVICE_POINT_ADDRESS',
        'idServicePointAddress' => 'ID_SERVICE_POINT_ADDRESS',
        'spyServicePointAddress.idServicePointAddress' => 'ID_SERVICE_POINT_ADDRESS',
        'SpyServicePointAddressTableMap::COL_ID_SERVICE_POINT_ADDRESS' => 'ID_SERVICE_POINT_ADDRESS',
        'COL_ID_SERVICE_POINT_ADDRESS' => 'ID_SERVICE_POINT_ADDRESS',
        'id_service_point_address' => 'ID_SERVICE_POINT_ADDRESS',
        'spy_service_point_address.id_service_point_address' => 'ID_SERVICE_POINT_ADDRESS',
        'FkCountry' => 'FK_COUNTRY',
        'SpyServicePointAddress.FkCountry' => 'FK_COUNTRY',
        'fkCountry' => 'FK_COUNTRY',
        'spyServicePointAddress.fkCountry' => 'FK_COUNTRY',
        'SpyServicePointAddressTableMap::COL_FK_COUNTRY' => 'FK_COUNTRY',
        'COL_FK_COUNTRY' => 'FK_COUNTRY',
        'fk_country' => 'FK_COUNTRY',
        'spy_service_point_address.fk_country' => 'FK_COUNTRY',
        'FkRegion' => 'FK_REGION',
        'SpyServicePointAddress.FkRegion' => 'FK_REGION',
        'fkRegion' => 'FK_REGION',
        'spyServicePointAddress.fkRegion' => 'FK_REGION',
        'SpyServicePointAddressTableMap::COL_FK_REGION' => 'FK_REGION',
        'COL_FK_REGION' => 'FK_REGION',
        'fk_region' => 'FK_REGION',
        'spy_service_point_address.fk_region' => 'FK_REGION',
        'FkServicePoint' => 'FK_SERVICE_POINT',
        'SpyServicePointAddress.FkServicePoint' => 'FK_SERVICE_POINT',
        'fkServicePoint' => 'FK_SERVICE_POINT',
        'spyServicePointAddress.fkServicePoint' => 'FK_SERVICE_POINT',
        'SpyServicePointAddressTableMap::COL_FK_SERVICE_POINT' => 'FK_SERVICE_POINT',
        'COL_FK_SERVICE_POINT' => 'FK_SERVICE_POINT',
        'fk_service_point' => 'FK_SERVICE_POINT',
        'spy_service_point_address.fk_service_point' => 'FK_SERVICE_POINT',
        'Address1' => 'ADDRESS1',
        'SpyServicePointAddress.Address1' => 'ADDRESS1',
        'address1' => 'ADDRESS1',
        'spyServicePointAddress.address1' => 'ADDRESS1',
        'SpyServicePointAddressTableMap::COL_ADDRESS1' => 'ADDRESS1',
        'COL_ADDRESS1' => 'ADDRESS1',
        'spy_service_point_address.address1' => 'ADDRESS1',
        'Address2' => 'ADDRESS2',
        'SpyServicePointAddress.Address2' => 'ADDRESS2',
        'address2' => 'ADDRESS2',
        'spyServicePointAddress.address2' => 'ADDRESS2',
        'SpyServicePointAddressTableMap::COL_ADDRESS2' => 'ADDRESS2',
        'COL_ADDRESS2' => 'ADDRESS2',
        'spy_service_point_address.address2' => 'ADDRESS2',
        'Address3' => 'ADDRESS3',
        'SpyServicePointAddress.Address3' => 'ADDRESS3',
        'address3' => 'ADDRESS3',
        'spyServicePointAddress.address3' => 'ADDRESS3',
        'SpyServicePointAddressTableMap::COL_ADDRESS3' => 'ADDRESS3',
        'COL_ADDRESS3' => 'ADDRESS3',
        'spy_service_point_address.address3' => 'ADDRESS3',
        'City' => 'CITY',
        'SpyServicePointAddress.City' => 'CITY',
        'city' => 'CITY',
        'spyServicePointAddress.city' => 'CITY',
        'SpyServicePointAddressTableMap::COL_CITY' => 'CITY',
        'COL_CITY' => 'CITY',
        'spy_service_point_address.city' => 'CITY',
        'Latitude' => 'LATITUDE',
        'SpyServicePointAddress.Latitude' => 'LATITUDE',
        'latitude' => 'LATITUDE',
        'spyServicePointAddress.latitude' => 'LATITUDE',
        'SpyServicePointAddressTableMap::COL_LATITUDE' => 'LATITUDE',
        'COL_LATITUDE' => 'LATITUDE',
        'spy_service_point_address.latitude' => 'LATITUDE',
        'Longitude' => 'LONGITUDE',
        'SpyServicePointAddress.Longitude' => 'LONGITUDE',
        'longitude' => 'LONGITUDE',
        'spyServicePointAddress.longitude' => 'LONGITUDE',
        'SpyServicePointAddressTableMap::COL_LONGITUDE' => 'LONGITUDE',
        'COL_LONGITUDE' => 'LONGITUDE',
        'spy_service_point_address.longitude' => 'LONGITUDE',
        'Uuid' => 'UUID',
        'SpyServicePointAddress.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyServicePointAddress.uuid' => 'UUID',
        'SpyServicePointAddressTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_service_point_address.uuid' => 'UUID',
        'ZipCode' => 'ZIP_CODE',
        'SpyServicePointAddress.ZipCode' => 'ZIP_CODE',
        'zipCode' => 'ZIP_CODE',
        'spyServicePointAddress.zipCode' => 'ZIP_CODE',
        'SpyServicePointAddressTableMap::COL_ZIP_CODE' => 'ZIP_CODE',
        'COL_ZIP_CODE' => 'ZIP_CODE',
        'zip_code' => 'ZIP_CODE',
        'spy_service_point_address.zip_code' => 'ZIP_CODE',
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
        $this->setName('spy_service_point_address');
        $this->setPhpName('SpyServicePointAddress');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ServicePoint\\Persistence\\SpyServicePointAddress');
        $this->setPackage('src.Orm.Zed.ServicePoint.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_service_point_address_pk_seq');
        // columns
        $this->addPrimaryKey('id_service_point_address', 'IdServicePointAddress', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_country', 'FkCountry', 'INTEGER', 'spy_country', 'id_country', true, null, null);
        $this->addForeignKey('fk_region', 'FkRegion', 'INTEGER', 'spy_region', 'id_region', false, null, null);
        $this->addForeignKey('fk_service_point', 'FkServicePoint', 'INTEGER', 'spy_service_point', 'id_service_point', true, null, null);
        $this->addColumn('address1', 'Address1', 'VARCHAR', true, 255, null);
        $this->addColumn('address2', 'Address2', 'VARCHAR', true, 255, null);
        $this->addColumn('address3', 'Address3', 'VARCHAR', false, 255, null);
        $this->addColumn('city', 'City', 'VARCHAR', true, 255, null);
        $this->addColumn('latitude', 'Latitude', 'VARCHAR', false, 255, null);
        $this->addColumn('longitude', 'Longitude', 'VARCHAR', false, 255, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 36, null);
        $this->addColumn('zip_code', 'ZipCode', 'VARCHAR', true, 15, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('ServicePoint', '\\Orm\\Zed\\ServicePoint\\Persistence\\SpyServicePoint', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_service_point',
    1 => ':id_service_point',
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_service_point_address'],
            'event' => ['spy_service_point_address_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdServicePointAddress', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdServicePointAddress', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdServicePointAddress', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdServicePointAddress', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdServicePointAddress', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdServicePointAddress', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdServicePointAddress', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyServicePointAddressTableMap::CLASS_DEFAULT : SpyServicePointAddressTableMap::OM_CLASS;
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
     * @return array (SpyServicePointAddress object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyServicePointAddressTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyServicePointAddressTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyServicePointAddressTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyServicePointAddressTableMap::OM_CLASS;
            /** @var SpyServicePointAddress $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyServicePointAddressTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyServicePointAddressTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyServicePointAddressTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyServicePointAddress $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyServicePointAddressTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyServicePointAddressTableMap::COL_ID_SERVICE_POINT_ADDRESS);
            $criteria->addSelectColumn(SpyServicePointAddressTableMap::COL_FK_COUNTRY);
            $criteria->addSelectColumn(SpyServicePointAddressTableMap::COL_FK_REGION);
            $criteria->addSelectColumn(SpyServicePointAddressTableMap::COL_FK_SERVICE_POINT);
            $criteria->addSelectColumn(SpyServicePointAddressTableMap::COL_ADDRESS1);
            $criteria->addSelectColumn(SpyServicePointAddressTableMap::COL_ADDRESS2);
            $criteria->addSelectColumn(SpyServicePointAddressTableMap::COL_ADDRESS3);
            $criteria->addSelectColumn(SpyServicePointAddressTableMap::COL_CITY);
            $criteria->addSelectColumn(SpyServicePointAddressTableMap::COL_LATITUDE);
            $criteria->addSelectColumn(SpyServicePointAddressTableMap::COL_LONGITUDE);
            $criteria->addSelectColumn(SpyServicePointAddressTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyServicePointAddressTableMap::COL_ZIP_CODE);
        } else {
            $criteria->addSelectColumn($alias . '.id_service_point_address');
            $criteria->addSelectColumn($alias . '.fk_country');
            $criteria->addSelectColumn($alias . '.fk_region');
            $criteria->addSelectColumn($alias . '.fk_service_point');
            $criteria->addSelectColumn($alias . '.address1');
            $criteria->addSelectColumn($alias . '.address2');
            $criteria->addSelectColumn($alias . '.address3');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.latitude');
            $criteria->addSelectColumn($alias . '.longitude');
            $criteria->addSelectColumn($alias . '.uuid');
            $criteria->addSelectColumn($alias . '.zip_code');
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
            $criteria->removeSelectColumn(SpyServicePointAddressTableMap::COL_ID_SERVICE_POINT_ADDRESS);
            $criteria->removeSelectColumn(SpyServicePointAddressTableMap::COL_FK_COUNTRY);
            $criteria->removeSelectColumn(SpyServicePointAddressTableMap::COL_FK_REGION);
            $criteria->removeSelectColumn(SpyServicePointAddressTableMap::COL_FK_SERVICE_POINT);
            $criteria->removeSelectColumn(SpyServicePointAddressTableMap::COL_ADDRESS1);
            $criteria->removeSelectColumn(SpyServicePointAddressTableMap::COL_ADDRESS2);
            $criteria->removeSelectColumn(SpyServicePointAddressTableMap::COL_ADDRESS3);
            $criteria->removeSelectColumn(SpyServicePointAddressTableMap::COL_CITY);
            $criteria->removeSelectColumn(SpyServicePointAddressTableMap::COL_LATITUDE);
            $criteria->removeSelectColumn(SpyServicePointAddressTableMap::COL_LONGITUDE);
            $criteria->removeSelectColumn(SpyServicePointAddressTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyServicePointAddressTableMap::COL_ZIP_CODE);
        } else {
            $criteria->removeSelectColumn($alias . '.id_service_point_address');
            $criteria->removeSelectColumn($alias . '.fk_country');
            $criteria->removeSelectColumn($alias . '.fk_region');
            $criteria->removeSelectColumn($alias . '.fk_service_point');
            $criteria->removeSelectColumn($alias . '.address1');
            $criteria->removeSelectColumn($alias . '.address2');
            $criteria->removeSelectColumn($alias . '.address3');
            $criteria->removeSelectColumn($alias . '.city');
            $criteria->removeSelectColumn($alias . '.latitude');
            $criteria->removeSelectColumn($alias . '.longitude');
            $criteria->removeSelectColumn($alias . '.uuid');
            $criteria->removeSelectColumn($alias . '.zip_code');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyServicePointAddressTableMap::DATABASE_NAME)->getTable(SpyServicePointAddressTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyServicePointAddress or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyServicePointAddress object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyServicePointAddressTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ServicePoint\Persistence\SpyServicePointAddress) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyServicePointAddressTableMap::DATABASE_NAME);
            $criteria->add(SpyServicePointAddressTableMap::COL_ID_SERVICE_POINT_ADDRESS, (array) $values, Criteria::IN);
        }

        $query = SpyServicePointAddressQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyServicePointAddressTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyServicePointAddressTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_service_point_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyServicePointAddressQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyServicePointAddress or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyServicePointAddress object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyServicePointAddressTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyServicePointAddress object
        }

        if ($criteria->containsKey(SpyServicePointAddressTableMap::COL_ID_SERVICE_POINT_ADDRESS) && $criteria->keyContainsValue(SpyServicePointAddressTableMap::COL_ID_SERVICE_POINT_ADDRESS) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyServicePointAddressTableMap::COL_ID_SERVICE_POINT_ADDRESS.')');
        }


        // Set the correct dbName
        $query = SpyServicePointAddressQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
