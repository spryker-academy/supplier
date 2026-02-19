<?php

namespace Orm\Zed\CompanyUnitAddress\Persistence\Map;

use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyUnitAddressLabel\Persistence\Map\SpyCompanyUnitAddressLabelToCompanyUnitAddressTableMap;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
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
 * This class defines the structure of the 'spy_company_unit_address' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCompanyUnitAddressTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CompanyUnitAddress.Persistence.Map.SpyCompanyUnitAddressTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_company_unit_address';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCompanyUnitAddress';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CompanyUnitAddress\\Persistence\\SpyCompanyUnitAddress';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CompanyUnitAddress.Persistence.SpyCompanyUnitAddress';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the id_company_unit_address field
     */
    public const COL_ID_COMPANY_UNIT_ADDRESS = 'spy_company_unit_address.id_company_unit_address';

    /**
     * the column name for the fk_company field
     */
    public const COL_FK_COMPANY = 'spy_company_unit_address.fk_company';

    /**
     * the column name for the fk_country field
     */
    public const COL_FK_COUNTRY = 'spy_company_unit_address.fk_country';

    /**
     * the column name for the fk_region field
     */
    public const COL_FK_REGION = 'spy_company_unit_address.fk_region';

    /**
     * the column name for the address1 field
     */
    public const COL_ADDRESS1 = 'spy_company_unit_address.address1';

    /**
     * the column name for the address2 field
     */
    public const COL_ADDRESS2 = 'spy_company_unit_address.address2';

    /**
     * the column name for the address3 field
     */
    public const COL_ADDRESS3 = 'spy_company_unit_address.address3';

    /**
     * the column name for the city field
     */
    public const COL_CITY = 'spy_company_unit_address.city';

    /**
     * the column name for the comment field
     */
    public const COL_COMMENT = 'spy_company_unit_address.comment';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_company_unit_address.key';

    /**
     * the column name for the phone field
     */
    public const COL_PHONE = 'spy_company_unit_address.phone';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_company_unit_address.uuid';

    /**
     * the column name for the zip_code field
     */
    public const COL_ZIP_CODE = 'spy_company_unit_address.zip_code';

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
        self::TYPE_PHPNAME       => ['IdCompanyUnitAddress', 'FkCompany', 'FkCountry', 'FkRegion', 'Address1', 'Address2', 'Address3', 'City', 'Comment', 'Key', 'Phone', 'Uuid', 'ZipCode', ],
        self::TYPE_CAMELNAME     => ['idCompanyUnitAddress', 'fkCompany', 'fkCountry', 'fkRegion', 'address1', 'address2', 'address3', 'city', 'comment', 'key', 'phone', 'uuid', 'zipCode', ],
        self::TYPE_COLNAME       => [SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS, SpyCompanyUnitAddressTableMap::COL_FK_COMPANY, SpyCompanyUnitAddressTableMap::COL_FK_COUNTRY, SpyCompanyUnitAddressTableMap::COL_FK_REGION, SpyCompanyUnitAddressTableMap::COL_ADDRESS1, SpyCompanyUnitAddressTableMap::COL_ADDRESS2, SpyCompanyUnitAddressTableMap::COL_ADDRESS3, SpyCompanyUnitAddressTableMap::COL_CITY, SpyCompanyUnitAddressTableMap::COL_COMMENT, SpyCompanyUnitAddressTableMap::COL_KEY, SpyCompanyUnitAddressTableMap::COL_PHONE, SpyCompanyUnitAddressTableMap::COL_UUID, SpyCompanyUnitAddressTableMap::COL_ZIP_CODE, ],
        self::TYPE_FIELDNAME     => ['id_company_unit_address', 'fk_company', 'fk_country', 'fk_region', 'address1', 'address2', 'address3', 'city', 'comment', 'key', 'phone', 'uuid', 'zip_code', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
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
        self::TYPE_PHPNAME       => ['IdCompanyUnitAddress' => 0, 'FkCompany' => 1, 'FkCountry' => 2, 'FkRegion' => 3, 'Address1' => 4, 'Address2' => 5, 'Address3' => 6, 'City' => 7, 'Comment' => 8, 'Key' => 9, 'Phone' => 10, 'Uuid' => 11, 'ZipCode' => 12, ],
        self::TYPE_CAMELNAME     => ['idCompanyUnitAddress' => 0, 'fkCompany' => 1, 'fkCountry' => 2, 'fkRegion' => 3, 'address1' => 4, 'address2' => 5, 'address3' => 6, 'city' => 7, 'comment' => 8, 'key' => 9, 'phone' => 10, 'uuid' => 11, 'zipCode' => 12, ],
        self::TYPE_COLNAME       => [SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS => 0, SpyCompanyUnitAddressTableMap::COL_FK_COMPANY => 1, SpyCompanyUnitAddressTableMap::COL_FK_COUNTRY => 2, SpyCompanyUnitAddressTableMap::COL_FK_REGION => 3, SpyCompanyUnitAddressTableMap::COL_ADDRESS1 => 4, SpyCompanyUnitAddressTableMap::COL_ADDRESS2 => 5, SpyCompanyUnitAddressTableMap::COL_ADDRESS3 => 6, SpyCompanyUnitAddressTableMap::COL_CITY => 7, SpyCompanyUnitAddressTableMap::COL_COMMENT => 8, SpyCompanyUnitAddressTableMap::COL_KEY => 9, SpyCompanyUnitAddressTableMap::COL_PHONE => 10, SpyCompanyUnitAddressTableMap::COL_UUID => 11, SpyCompanyUnitAddressTableMap::COL_ZIP_CODE => 12, ],
        self::TYPE_FIELDNAME     => ['id_company_unit_address' => 0, 'fk_company' => 1, 'fk_country' => 2, 'fk_region' => 3, 'address1' => 4, 'address2' => 5, 'address3' => 6, 'city' => 7, 'comment' => 8, 'key' => 9, 'phone' => 10, 'uuid' => 11, 'zip_code' => 12, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCompanyUnitAddress' => 'ID_COMPANY_UNIT_ADDRESS',
        'SpyCompanyUnitAddress.IdCompanyUnitAddress' => 'ID_COMPANY_UNIT_ADDRESS',
        'idCompanyUnitAddress' => 'ID_COMPANY_UNIT_ADDRESS',
        'spyCompanyUnitAddress.idCompanyUnitAddress' => 'ID_COMPANY_UNIT_ADDRESS',
        'SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS' => 'ID_COMPANY_UNIT_ADDRESS',
        'COL_ID_COMPANY_UNIT_ADDRESS' => 'ID_COMPANY_UNIT_ADDRESS',
        'id_company_unit_address' => 'ID_COMPANY_UNIT_ADDRESS',
        'spy_company_unit_address.id_company_unit_address' => 'ID_COMPANY_UNIT_ADDRESS',
        'FkCompany' => 'FK_COMPANY',
        'SpyCompanyUnitAddress.FkCompany' => 'FK_COMPANY',
        'fkCompany' => 'FK_COMPANY',
        'spyCompanyUnitAddress.fkCompany' => 'FK_COMPANY',
        'SpyCompanyUnitAddressTableMap::COL_FK_COMPANY' => 'FK_COMPANY',
        'COL_FK_COMPANY' => 'FK_COMPANY',
        'fk_company' => 'FK_COMPANY',
        'spy_company_unit_address.fk_company' => 'FK_COMPANY',
        'FkCountry' => 'FK_COUNTRY',
        'SpyCompanyUnitAddress.FkCountry' => 'FK_COUNTRY',
        'fkCountry' => 'FK_COUNTRY',
        'spyCompanyUnitAddress.fkCountry' => 'FK_COUNTRY',
        'SpyCompanyUnitAddressTableMap::COL_FK_COUNTRY' => 'FK_COUNTRY',
        'COL_FK_COUNTRY' => 'FK_COUNTRY',
        'fk_country' => 'FK_COUNTRY',
        'spy_company_unit_address.fk_country' => 'FK_COUNTRY',
        'FkRegion' => 'FK_REGION',
        'SpyCompanyUnitAddress.FkRegion' => 'FK_REGION',
        'fkRegion' => 'FK_REGION',
        'spyCompanyUnitAddress.fkRegion' => 'FK_REGION',
        'SpyCompanyUnitAddressTableMap::COL_FK_REGION' => 'FK_REGION',
        'COL_FK_REGION' => 'FK_REGION',
        'fk_region' => 'FK_REGION',
        'spy_company_unit_address.fk_region' => 'FK_REGION',
        'Address1' => 'ADDRESS1',
        'SpyCompanyUnitAddress.Address1' => 'ADDRESS1',
        'address1' => 'ADDRESS1',
        'spyCompanyUnitAddress.address1' => 'ADDRESS1',
        'SpyCompanyUnitAddressTableMap::COL_ADDRESS1' => 'ADDRESS1',
        'COL_ADDRESS1' => 'ADDRESS1',
        'spy_company_unit_address.address1' => 'ADDRESS1',
        'Address2' => 'ADDRESS2',
        'SpyCompanyUnitAddress.Address2' => 'ADDRESS2',
        'address2' => 'ADDRESS2',
        'spyCompanyUnitAddress.address2' => 'ADDRESS2',
        'SpyCompanyUnitAddressTableMap::COL_ADDRESS2' => 'ADDRESS2',
        'COL_ADDRESS2' => 'ADDRESS2',
        'spy_company_unit_address.address2' => 'ADDRESS2',
        'Address3' => 'ADDRESS3',
        'SpyCompanyUnitAddress.Address3' => 'ADDRESS3',
        'address3' => 'ADDRESS3',
        'spyCompanyUnitAddress.address3' => 'ADDRESS3',
        'SpyCompanyUnitAddressTableMap::COL_ADDRESS3' => 'ADDRESS3',
        'COL_ADDRESS3' => 'ADDRESS3',
        'spy_company_unit_address.address3' => 'ADDRESS3',
        'City' => 'CITY',
        'SpyCompanyUnitAddress.City' => 'CITY',
        'city' => 'CITY',
        'spyCompanyUnitAddress.city' => 'CITY',
        'SpyCompanyUnitAddressTableMap::COL_CITY' => 'CITY',
        'COL_CITY' => 'CITY',
        'spy_company_unit_address.city' => 'CITY',
        'Comment' => 'COMMENT',
        'SpyCompanyUnitAddress.Comment' => 'COMMENT',
        'comment' => 'COMMENT',
        'spyCompanyUnitAddress.comment' => 'COMMENT',
        'SpyCompanyUnitAddressTableMap::COL_COMMENT' => 'COMMENT',
        'COL_COMMENT' => 'COMMENT',
        'spy_company_unit_address.comment' => 'COMMENT',
        'Key' => 'KEY',
        'SpyCompanyUnitAddress.Key' => 'KEY',
        'key' => 'KEY',
        'spyCompanyUnitAddress.key' => 'KEY',
        'SpyCompanyUnitAddressTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_company_unit_address.key' => 'KEY',
        'Phone' => 'PHONE',
        'SpyCompanyUnitAddress.Phone' => 'PHONE',
        'phone' => 'PHONE',
        'spyCompanyUnitAddress.phone' => 'PHONE',
        'SpyCompanyUnitAddressTableMap::COL_PHONE' => 'PHONE',
        'COL_PHONE' => 'PHONE',
        'spy_company_unit_address.phone' => 'PHONE',
        'Uuid' => 'UUID',
        'SpyCompanyUnitAddress.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyCompanyUnitAddress.uuid' => 'UUID',
        'SpyCompanyUnitAddressTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_company_unit_address.uuid' => 'UUID',
        'ZipCode' => 'ZIP_CODE',
        'SpyCompanyUnitAddress.ZipCode' => 'ZIP_CODE',
        'zipCode' => 'ZIP_CODE',
        'spyCompanyUnitAddress.zipCode' => 'ZIP_CODE',
        'SpyCompanyUnitAddressTableMap::COL_ZIP_CODE' => 'ZIP_CODE',
        'COL_ZIP_CODE' => 'ZIP_CODE',
        'zip_code' => 'ZIP_CODE',
        'spy_company_unit_address.zip_code' => 'ZIP_CODE',
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
        $this->setName('spy_company_unit_address');
        $this->setPhpName('SpyCompanyUnitAddress');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\CompanyUnitAddress\\Persistence\\SpyCompanyUnitAddress');
        $this->setPackage('src.Orm.Zed.CompanyUnitAddress.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_company_unit_address_pk_seq');
        // columns
        $this->addPrimaryKey('id_company_unit_address', 'IdCompanyUnitAddress', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_company', 'FkCompany', 'INTEGER', 'spy_company', 'id_company', false, null, null);
        $this->addForeignKey('fk_country', 'FkCountry', 'INTEGER', 'spy_country', 'id_country', true, null, null);
        $this->addForeignKey('fk_region', 'FkRegion', 'INTEGER', 'spy_region', 'id_region', false, null, null);
        $this->addColumn('address1', 'Address1', 'VARCHAR', false, 255, null);
        $this->addColumn('address2', 'Address2', 'VARCHAR', false, 255, null);
        $this->addColumn('address3', 'Address3', 'VARCHAR', false, 255, null);
        $this->addColumn('city', 'City', 'VARCHAR', false, 255, null);
        $this->addColumn('comment', 'Comment', 'VARCHAR', false, 255, null);
        $this->addColumn('key', 'Key', 'VARCHAR', false, 255, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, 255, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 36, null);
        $this->addColumn('zip_code', 'ZipCode', 'VARCHAR', false, 15, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
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
        $this->addRelation('Company', '\\Orm\\Zed\\Company\\Persistence\\SpyCompany', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_company',
    1 => ':id_company',
  ),
), null, null, null, false);
        $this->addRelation('SpyCompanyBusinessUnit', '\\Orm\\Zed\\CompanyBusinessUnit\\Persistence\\SpyCompanyBusinessUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':default_billing_address',
    1 => ':id_company_unit_address',
  ),
), 'SET NULL', null, 'SpyCompanyBusinessUnits', false);
        $this->addRelation('SpyCompanyUnitAddressToCompanyBusinessUnit', '\\Orm\\Zed\\CompanyUnitAddress\\Persistence\\SpyCompanyUnitAddressToCompanyBusinessUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company_unit_address',
    1 => ':id_company_unit_address',
  ),
), 'CASCADE', null, 'SpyCompanyUnitAddressToCompanyBusinessUnits', false);
        $this->addRelation('SpyCompanyUnitAddressLabelToCompanyUnitAddress', '\\Orm\\Zed\\CompanyUnitAddressLabel\\Persistence\\SpyCompanyUnitAddressLabelToCompanyUnitAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company_unit_address',
    1 => ':id_company_unit_address',
  ),
), 'CASCADE', null, 'SpyCompanyUnitAddressLabelToCompanyUnitAddresses', false);
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_company_unit_address.fk_company'],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_company_unit_address     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyCompanyBusinessUnitTableMap::clearInstancePool();
        SpyCompanyUnitAddressToCompanyBusinessUnitTableMap::clearInstancePool();
        SpyCompanyUnitAddressLabelToCompanyUnitAddressTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyUnitAddress', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyUnitAddress', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyUnitAddress', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyUnitAddress', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyUnitAddress', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyUnitAddress', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCompanyUnitAddress', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCompanyUnitAddressTableMap::CLASS_DEFAULT : SpyCompanyUnitAddressTableMap::OM_CLASS;
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
     * @return array (SpyCompanyUnitAddress object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCompanyUnitAddressTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCompanyUnitAddressTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCompanyUnitAddressTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCompanyUnitAddressTableMap::OM_CLASS;
            /** @var SpyCompanyUnitAddress $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCompanyUnitAddressTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCompanyUnitAddressTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCompanyUnitAddressTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCompanyUnitAddress $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCompanyUnitAddressTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS);
            $criteria->addSelectColumn(SpyCompanyUnitAddressTableMap::COL_FK_COMPANY);
            $criteria->addSelectColumn(SpyCompanyUnitAddressTableMap::COL_FK_COUNTRY);
            $criteria->addSelectColumn(SpyCompanyUnitAddressTableMap::COL_FK_REGION);
            $criteria->addSelectColumn(SpyCompanyUnitAddressTableMap::COL_ADDRESS1);
            $criteria->addSelectColumn(SpyCompanyUnitAddressTableMap::COL_ADDRESS2);
            $criteria->addSelectColumn(SpyCompanyUnitAddressTableMap::COL_ADDRESS3);
            $criteria->addSelectColumn(SpyCompanyUnitAddressTableMap::COL_CITY);
            $criteria->addSelectColumn(SpyCompanyUnitAddressTableMap::COL_COMMENT);
            $criteria->addSelectColumn(SpyCompanyUnitAddressTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyCompanyUnitAddressTableMap::COL_PHONE);
            $criteria->addSelectColumn(SpyCompanyUnitAddressTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyCompanyUnitAddressTableMap::COL_ZIP_CODE);
        } else {
            $criteria->addSelectColumn($alias . '.id_company_unit_address');
            $criteria->addSelectColumn($alias . '.fk_company');
            $criteria->addSelectColumn($alias . '.fk_country');
            $criteria->addSelectColumn($alias . '.fk_region');
            $criteria->addSelectColumn($alias . '.address1');
            $criteria->addSelectColumn($alias . '.address2');
            $criteria->addSelectColumn($alias . '.address3');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.comment');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.phone');
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
            $criteria->removeSelectColumn(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS);
            $criteria->removeSelectColumn(SpyCompanyUnitAddressTableMap::COL_FK_COMPANY);
            $criteria->removeSelectColumn(SpyCompanyUnitAddressTableMap::COL_FK_COUNTRY);
            $criteria->removeSelectColumn(SpyCompanyUnitAddressTableMap::COL_FK_REGION);
            $criteria->removeSelectColumn(SpyCompanyUnitAddressTableMap::COL_ADDRESS1);
            $criteria->removeSelectColumn(SpyCompanyUnitAddressTableMap::COL_ADDRESS2);
            $criteria->removeSelectColumn(SpyCompanyUnitAddressTableMap::COL_ADDRESS3);
            $criteria->removeSelectColumn(SpyCompanyUnitAddressTableMap::COL_CITY);
            $criteria->removeSelectColumn(SpyCompanyUnitAddressTableMap::COL_COMMENT);
            $criteria->removeSelectColumn(SpyCompanyUnitAddressTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyCompanyUnitAddressTableMap::COL_PHONE);
            $criteria->removeSelectColumn(SpyCompanyUnitAddressTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyCompanyUnitAddressTableMap::COL_ZIP_CODE);
        } else {
            $criteria->removeSelectColumn($alias . '.id_company_unit_address');
            $criteria->removeSelectColumn($alias . '.fk_company');
            $criteria->removeSelectColumn($alias . '.fk_country');
            $criteria->removeSelectColumn($alias . '.fk_region');
            $criteria->removeSelectColumn($alias . '.address1');
            $criteria->removeSelectColumn($alias . '.address2');
            $criteria->removeSelectColumn($alias . '.address3');
            $criteria->removeSelectColumn($alias . '.city');
            $criteria->removeSelectColumn($alias . '.comment');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.phone');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCompanyUnitAddressTableMap::DATABASE_NAME)->getTable(SpyCompanyUnitAddressTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCompanyUnitAddress or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCompanyUnitAddress object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyUnitAddressTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCompanyUnitAddressTableMap::DATABASE_NAME);
            $criteria->add(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS, (array) $values, Criteria::IN);
        }

        $query = SpyCompanyUnitAddressQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCompanyUnitAddressTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCompanyUnitAddressTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_company_unit_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCompanyUnitAddressQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCompanyUnitAddress or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCompanyUnitAddress object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyUnitAddressTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCompanyUnitAddress object
        }

        if ($criteria->containsKey(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS) && $criteria->keyContainsValue(SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS.')');
        }


        // Set the correct dbName
        $query = SpyCompanyUnitAddressQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
