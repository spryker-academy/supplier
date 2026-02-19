<?php

namespace Orm\Zed\Sales\Persistence\Map;

use Orm\Zed\Sales\Persistence\SpySalesOrderAddress;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddressQuery;
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
 * This class defines the structure of the 'spy_sales_order_address' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesOrderAddressTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Sales.Persistence.Map.SpySalesOrderAddressTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_order_address';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesOrderAddress';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderAddress';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Sales.Persistence.SpySalesOrderAddress';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 21;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 21;

    /**
     * the column name for the id_sales_order_address field
     */
    public const COL_ID_SALES_ORDER_ADDRESS = 'spy_sales_order_address.id_sales_order_address';

    /**
     * the column name for the fk_country field
     */
    public const COL_FK_COUNTRY = 'spy_sales_order_address.fk_country';

    /**
     * the column name for the fk_region field
     */
    public const COL_FK_REGION = 'spy_sales_order_address.fk_region';

    /**
     * the column name for the address1 field
     */
    public const COL_ADDRESS1 = 'spy_sales_order_address.address1';

    /**
     * the column name for the address2 field
     */
    public const COL_ADDRESS2 = 'spy_sales_order_address.address2';

    /**
     * the column name for the address3 field
     */
    public const COL_ADDRESS3 = 'spy_sales_order_address.address3';

    /**
     * the column name for the cell_phone field
     */
    public const COL_CELL_PHONE = 'spy_sales_order_address.cell_phone';

    /**
     * the column name for the city field
     */
    public const COL_CITY = 'spy_sales_order_address.city';

    /**
     * the column name for the comment field
     */
    public const COL_COMMENT = 'spy_sales_order_address.comment';

    /**
     * the column name for the company field
     */
    public const COL_COMPANY = 'spy_sales_order_address.company';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'spy_sales_order_address.description';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'spy_sales_order_address.email';

    /**
     * the column name for the first_name field
     */
    public const COL_FIRST_NAME = 'spy_sales_order_address.first_name';

    /**
     * the column name for the last_name field
     */
    public const COL_LAST_NAME = 'spy_sales_order_address.last_name';

    /**
     * the column name for the middle_name field
     */
    public const COL_MIDDLE_NAME = 'spy_sales_order_address.middle_name';

    /**
     * the column name for the phone field
     */
    public const COL_PHONE = 'spy_sales_order_address.phone';

    /**
     * the column name for the po_box field
     */
    public const COL_PO_BOX = 'spy_sales_order_address.po_box';

    /**
     * the column name for the salutation field
     */
    public const COL_SALUTATION = 'spy_sales_order_address.salutation';

    /**
     * the column name for the zip_code field
     */
    public const COL_ZIP_CODE = 'spy_sales_order_address.zip_code';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_order_address.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_order_address.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the salutation field */
    public const COL_SALUTATION_MR = 'Mr';
    public const COL_SALUTATION_MRS = 'Mrs';
    public const COL_SALUTATION_DR = 'Dr';
    public const COL_SALUTATION_MS = 'Ms';
    public const COL_SALUTATION_N_A = 'n/a';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdSalesOrderAddress', 'FkCountry', 'FkRegion', 'Address1', 'Address2', 'Address3', 'CellPhone', 'City', 'Comment', 'Company', 'Description', 'Email', 'FirstName', 'LastName', 'MiddleName', 'Phone', 'PoBox', 'Salutation', 'ZipCode', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesOrderAddress', 'fkCountry', 'fkRegion', 'address1', 'address2', 'address3', 'cellPhone', 'city', 'comment', 'company', 'description', 'email', 'firstName', 'lastName', 'middleName', 'phone', 'poBox', 'salutation', 'zipCode', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesOrderAddressTableMap::COL_ID_SALES_ORDER_ADDRESS, SpySalesOrderAddressTableMap::COL_FK_COUNTRY, SpySalesOrderAddressTableMap::COL_FK_REGION, SpySalesOrderAddressTableMap::COL_ADDRESS1, SpySalesOrderAddressTableMap::COL_ADDRESS2, SpySalesOrderAddressTableMap::COL_ADDRESS3, SpySalesOrderAddressTableMap::COL_CELL_PHONE, SpySalesOrderAddressTableMap::COL_CITY, SpySalesOrderAddressTableMap::COL_COMMENT, SpySalesOrderAddressTableMap::COL_COMPANY, SpySalesOrderAddressTableMap::COL_DESCRIPTION, SpySalesOrderAddressTableMap::COL_EMAIL, SpySalesOrderAddressTableMap::COL_FIRST_NAME, SpySalesOrderAddressTableMap::COL_LAST_NAME, SpySalesOrderAddressTableMap::COL_MIDDLE_NAME, SpySalesOrderAddressTableMap::COL_PHONE, SpySalesOrderAddressTableMap::COL_PO_BOX, SpySalesOrderAddressTableMap::COL_SALUTATION, SpySalesOrderAddressTableMap::COL_ZIP_CODE, SpySalesOrderAddressTableMap::COL_CREATED_AT, SpySalesOrderAddressTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_address', 'fk_country', 'fk_region', 'address1', 'address2', 'address3', 'cell_phone', 'city', 'comment', 'company', 'description', 'email', 'first_name', 'last_name', 'middle_name', 'phone', 'po_box', 'salutation', 'zip_code', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, ]
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
        self::TYPE_PHPNAME       => ['IdSalesOrderAddress' => 0, 'FkCountry' => 1, 'FkRegion' => 2, 'Address1' => 3, 'Address2' => 4, 'Address3' => 5, 'CellPhone' => 6, 'City' => 7, 'Comment' => 8, 'Company' => 9, 'Description' => 10, 'Email' => 11, 'FirstName' => 12, 'LastName' => 13, 'MiddleName' => 14, 'Phone' => 15, 'PoBox' => 16, 'Salutation' => 17, 'ZipCode' => 18, 'CreatedAt' => 19, 'UpdatedAt' => 20, ],
        self::TYPE_CAMELNAME     => ['idSalesOrderAddress' => 0, 'fkCountry' => 1, 'fkRegion' => 2, 'address1' => 3, 'address2' => 4, 'address3' => 5, 'cellPhone' => 6, 'city' => 7, 'comment' => 8, 'company' => 9, 'description' => 10, 'email' => 11, 'firstName' => 12, 'lastName' => 13, 'middleName' => 14, 'phone' => 15, 'poBox' => 16, 'salutation' => 17, 'zipCode' => 18, 'createdAt' => 19, 'updatedAt' => 20, ],
        self::TYPE_COLNAME       => [SpySalesOrderAddressTableMap::COL_ID_SALES_ORDER_ADDRESS => 0, SpySalesOrderAddressTableMap::COL_FK_COUNTRY => 1, SpySalesOrderAddressTableMap::COL_FK_REGION => 2, SpySalesOrderAddressTableMap::COL_ADDRESS1 => 3, SpySalesOrderAddressTableMap::COL_ADDRESS2 => 4, SpySalesOrderAddressTableMap::COL_ADDRESS3 => 5, SpySalesOrderAddressTableMap::COL_CELL_PHONE => 6, SpySalesOrderAddressTableMap::COL_CITY => 7, SpySalesOrderAddressTableMap::COL_COMMENT => 8, SpySalesOrderAddressTableMap::COL_COMPANY => 9, SpySalesOrderAddressTableMap::COL_DESCRIPTION => 10, SpySalesOrderAddressTableMap::COL_EMAIL => 11, SpySalesOrderAddressTableMap::COL_FIRST_NAME => 12, SpySalesOrderAddressTableMap::COL_LAST_NAME => 13, SpySalesOrderAddressTableMap::COL_MIDDLE_NAME => 14, SpySalesOrderAddressTableMap::COL_PHONE => 15, SpySalesOrderAddressTableMap::COL_PO_BOX => 16, SpySalesOrderAddressTableMap::COL_SALUTATION => 17, SpySalesOrderAddressTableMap::COL_ZIP_CODE => 18, SpySalesOrderAddressTableMap::COL_CREATED_AT => 19, SpySalesOrderAddressTableMap::COL_UPDATED_AT => 20, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_address' => 0, 'fk_country' => 1, 'fk_region' => 2, 'address1' => 3, 'address2' => 4, 'address3' => 5, 'cell_phone' => 6, 'city' => 7, 'comment' => 8, 'company' => 9, 'description' => 10, 'email' => 11, 'first_name' => 12, 'last_name' => 13, 'middle_name' => 14, 'phone' => 15, 'po_box' => 16, 'salutation' => 17, 'zip_code' => 18, 'created_at' => 19, 'updated_at' => 20, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesOrderAddress' => 'ID_SALES_ORDER_ADDRESS',
        'SpySalesOrderAddress.IdSalesOrderAddress' => 'ID_SALES_ORDER_ADDRESS',
        'idSalesOrderAddress' => 'ID_SALES_ORDER_ADDRESS',
        'spySalesOrderAddress.idSalesOrderAddress' => 'ID_SALES_ORDER_ADDRESS',
        'SpySalesOrderAddressTableMap::COL_ID_SALES_ORDER_ADDRESS' => 'ID_SALES_ORDER_ADDRESS',
        'COL_ID_SALES_ORDER_ADDRESS' => 'ID_SALES_ORDER_ADDRESS',
        'id_sales_order_address' => 'ID_SALES_ORDER_ADDRESS',
        'spy_sales_order_address.id_sales_order_address' => 'ID_SALES_ORDER_ADDRESS',
        'FkCountry' => 'FK_COUNTRY',
        'SpySalesOrderAddress.FkCountry' => 'FK_COUNTRY',
        'fkCountry' => 'FK_COUNTRY',
        'spySalesOrderAddress.fkCountry' => 'FK_COUNTRY',
        'SpySalesOrderAddressTableMap::COL_FK_COUNTRY' => 'FK_COUNTRY',
        'COL_FK_COUNTRY' => 'FK_COUNTRY',
        'fk_country' => 'FK_COUNTRY',
        'spy_sales_order_address.fk_country' => 'FK_COUNTRY',
        'FkRegion' => 'FK_REGION',
        'SpySalesOrderAddress.FkRegion' => 'FK_REGION',
        'fkRegion' => 'FK_REGION',
        'spySalesOrderAddress.fkRegion' => 'FK_REGION',
        'SpySalesOrderAddressTableMap::COL_FK_REGION' => 'FK_REGION',
        'COL_FK_REGION' => 'FK_REGION',
        'fk_region' => 'FK_REGION',
        'spy_sales_order_address.fk_region' => 'FK_REGION',
        'Address1' => 'ADDRESS1',
        'SpySalesOrderAddress.Address1' => 'ADDRESS1',
        'address1' => 'ADDRESS1',
        'spySalesOrderAddress.address1' => 'ADDRESS1',
        'SpySalesOrderAddressTableMap::COL_ADDRESS1' => 'ADDRESS1',
        'COL_ADDRESS1' => 'ADDRESS1',
        'spy_sales_order_address.address1' => 'ADDRESS1',
        'Address2' => 'ADDRESS2',
        'SpySalesOrderAddress.Address2' => 'ADDRESS2',
        'address2' => 'ADDRESS2',
        'spySalesOrderAddress.address2' => 'ADDRESS2',
        'SpySalesOrderAddressTableMap::COL_ADDRESS2' => 'ADDRESS2',
        'COL_ADDRESS2' => 'ADDRESS2',
        'spy_sales_order_address.address2' => 'ADDRESS2',
        'Address3' => 'ADDRESS3',
        'SpySalesOrderAddress.Address3' => 'ADDRESS3',
        'address3' => 'ADDRESS3',
        'spySalesOrderAddress.address3' => 'ADDRESS3',
        'SpySalesOrderAddressTableMap::COL_ADDRESS3' => 'ADDRESS3',
        'COL_ADDRESS3' => 'ADDRESS3',
        'spy_sales_order_address.address3' => 'ADDRESS3',
        'CellPhone' => 'CELL_PHONE',
        'SpySalesOrderAddress.CellPhone' => 'CELL_PHONE',
        'cellPhone' => 'CELL_PHONE',
        'spySalesOrderAddress.cellPhone' => 'CELL_PHONE',
        'SpySalesOrderAddressTableMap::COL_CELL_PHONE' => 'CELL_PHONE',
        'COL_CELL_PHONE' => 'CELL_PHONE',
        'cell_phone' => 'CELL_PHONE',
        'spy_sales_order_address.cell_phone' => 'CELL_PHONE',
        'City' => 'CITY',
        'SpySalesOrderAddress.City' => 'CITY',
        'city' => 'CITY',
        'spySalesOrderAddress.city' => 'CITY',
        'SpySalesOrderAddressTableMap::COL_CITY' => 'CITY',
        'COL_CITY' => 'CITY',
        'spy_sales_order_address.city' => 'CITY',
        'Comment' => 'COMMENT',
        'SpySalesOrderAddress.Comment' => 'COMMENT',
        'comment' => 'COMMENT',
        'spySalesOrderAddress.comment' => 'COMMENT',
        'SpySalesOrderAddressTableMap::COL_COMMENT' => 'COMMENT',
        'COL_COMMENT' => 'COMMENT',
        'spy_sales_order_address.comment' => 'COMMENT',
        'Company' => 'COMPANY',
        'SpySalesOrderAddress.Company' => 'COMPANY',
        'company' => 'COMPANY',
        'spySalesOrderAddress.company' => 'COMPANY',
        'SpySalesOrderAddressTableMap::COL_COMPANY' => 'COMPANY',
        'COL_COMPANY' => 'COMPANY',
        'spy_sales_order_address.company' => 'COMPANY',
        'Description' => 'DESCRIPTION',
        'SpySalesOrderAddress.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'spySalesOrderAddress.description' => 'DESCRIPTION',
        'SpySalesOrderAddressTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'spy_sales_order_address.description' => 'DESCRIPTION',
        'Email' => 'EMAIL',
        'SpySalesOrderAddress.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'spySalesOrderAddress.email' => 'EMAIL',
        'SpySalesOrderAddressTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'spy_sales_order_address.email' => 'EMAIL',
        'FirstName' => 'FIRST_NAME',
        'SpySalesOrderAddress.FirstName' => 'FIRST_NAME',
        'firstName' => 'FIRST_NAME',
        'spySalesOrderAddress.firstName' => 'FIRST_NAME',
        'SpySalesOrderAddressTableMap::COL_FIRST_NAME' => 'FIRST_NAME',
        'COL_FIRST_NAME' => 'FIRST_NAME',
        'first_name' => 'FIRST_NAME',
        'spy_sales_order_address.first_name' => 'FIRST_NAME',
        'LastName' => 'LAST_NAME',
        'SpySalesOrderAddress.LastName' => 'LAST_NAME',
        'lastName' => 'LAST_NAME',
        'spySalesOrderAddress.lastName' => 'LAST_NAME',
        'SpySalesOrderAddressTableMap::COL_LAST_NAME' => 'LAST_NAME',
        'COL_LAST_NAME' => 'LAST_NAME',
        'last_name' => 'LAST_NAME',
        'spy_sales_order_address.last_name' => 'LAST_NAME',
        'MiddleName' => 'MIDDLE_NAME',
        'SpySalesOrderAddress.MiddleName' => 'MIDDLE_NAME',
        'middleName' => 'MIDDLE_NAME',
        'spySalesOrderAddress.middleName' => 'MIDDLE_NAME',
        'SpySalesOrderAddressTableMap::COL_MIDDLE_NAME' => 'MIDDLE_NAME',
        'COL_MIDDLE_NAME' => 'MIDDLE_NAME',
        'middle_name' => 'MIDDLE_NAME',
        'spy_sales_order_address.middle_name' => 'MIDDLE_NAME',
        'Phone' => 'PHONE',
        'SpySalesOrderAddress.Phone' => 'PHONE',
        'phone' => 'PHONE',
        'spySalesOrderAddress.phone' => 'PHONE',
        'SpySalesOrderAddressTableMap::COL_PHONE' => 'PHONE',
        'COL_PHONE' => 'PHONE',
        'spy_sales_order_address.phone' => 'PHONE',
        'PoBox' => 'PO_BOX',
        'SpySalesOrderAddress.PoBox' => 'PO_BOX',
        'poBox' => 'PO_BOX',
        'spySalesOrderAddress.poBox' => 'PO_BOX',
        'SpySalesOrderAddressTableMap::COL_PO_BOX' => 'PO_BOX',
        'COL_PO_BOX' => 'PO_BOX',
        'po_box' => 'PO_BOX',
        'spy_sales_order_address.po_box' => 'PO_BOX',
        'Salutation' => 'SALUTATION',
        'SpySalesOrderAddress.Salutation' => 'SALUTATION',
        'salutation' => 'SALUTATION',
        'spySalesOrderAddress.salutation' => 'SALUTATION',
        'SpySalesOrderAddressTableMap::COL_SALUTATION' => 'SALUTATION',
        'COL_SALUTATION' => 'SALUTATION',
        'spy_sales_order_address.salutation' => 'SALUTATION',
        'ZipCode' => 'ZIP_CODE',
        'SpySalesOrderAddress.ZipCode' => 'ZIP_CODE',
        'zipCode' => 'ZIP_CODE',
        'spySalesOrderAddress.zipCode' => 'ZIP_CODE',
        'SpySalesOrderAddressTableMap::COL_ZIP_CODE' => 'ZIP_CODE',
        'COL_ZIP_CODE' => 'ZIP_CODE',
        'zip_code' => 'ZIP_CODE',
        'spy_sales_order_address.zip_code' => 'ZIP_CODE',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesOrderAddress.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesOrderAddress.createdAt' => 'CREATED_AT',
        'SpySalesOrderAddressTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_order_address.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesOrderAddress.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesOrderAddress.updatedAt' => 'UPDATED_AT',
        'SpySalesOrderAddressTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_order_address.updated_at' => 'UPDATED_AT',
    ];

    /**
     * The enumerated values for this table
     *
     * @var array<string, array<string>>
     */
    protected static $enumValueSets = [
                SpySalesOrderAddressTableMap::COL_SALUTATION => [
                            self::COL_SALUTATION_MR,
            self::COL_SALUTATION_MRS,
            self::COL_SALUTATION_DR,
            self::COL_SALUTATION_MS,
            self::COL_SALUTATION_N_A,
        ],
    ];

    /**
     * Gets the list of values for all ENUM and SET columns
     * @return array
     */
    public static function getValueSets(): array
    {
      return static::$enumValueSets;
    }

    /**
     * Gets the list of values for an ENUM or SET column
     * @param string $colname
     * @return array list of possible values for the column
     */
    public static function getValueSet(string $colname): array
    {
        $valueSets = self::getValueSets();

        return $valueSets[$colname];
    }

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
        $this->setName('spy_sales_order_address');
        $this->setPhpName('SpySalesOrderAddress');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderAddress');
        $this->setPackage('src.Orm.Zed.Sales.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_order_address_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_order_address', 'IdSalesOrderAddress', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_country', 'FkCountry', 'INTEGER', 'spy_country', 'id_country', true, null, null);
        $this->addForeignKey('fk_region', 'FkRegion', 'INTEGER', 'spy_region', 'id_region', false, null, null);
        $this->addColumn('address1', 'Address1', 'VARCHAR', false, 255, null);
        $this->addColumn('address2', 'Address2', 'VARCHAR', false, 255, null);
        $this->addColumn('address3', 'Address3', 'VARCHAR', false, 255, null);
        $this->addColumn('cell_phone', 'CellPhone', 'VARCHAR', false, 255, null);
        $this->addColumn('city', 'City', 'VARCHAR', true, 255, null);
        $this->addColumn('comment', 'Comment', 'VARCHAR', false, 255, null);
        $this->addColumn('company', 'Company', 'VARCHAR', false, 255, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 255, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 255, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', true, 100, null);
        $this->addColumn('last_name', 'LastName', 'VARCHAR', true, 100, null);
        $this->addColumn('middle_name', 'MiddleName', 'VARCHAR', false, 100, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, 255, null);
        $this->addColumn('po_box', 'PoBox', 'VARCHAR', false, 255, null);
        $this->addColumn('salutation', 'Salutation', 'ENUM', false, null, null);
        $this->getColumn('salutation')->setValueSet(array (
  0 => 'Mr',
  1 => 'Mrs',
  2 => 'Dr',
  3 => 'Ms',
  4 => 'n/a',
));
        $this->addColumn('zip_code', 'ZipCode', 'VARCHAR', true, 15, null);
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
        $this->addRelation('SpySalesOrderRelatedByFkSalesOrderAddressBilling', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrder', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_sales_order_address_billing',
    1 => ':id_sales_order_address',
  ),
), null, null, 'SpySalesOrdersRelatedByFkSalesOrderAddressBilling', false);
        $this->addRelation('SpySalesOrderRelatedByFkSalesOrderAddressShipping', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrder', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_sales_order_address_shipping',
    1 => ':id_sales_order_address',
  ),
), null, null, 'SpySalesOrdersRelatedByFkSalesOrderAddressShipping', false);
        $this->addRelation('SpySalesShipment', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesShipment', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_sales_order_address',
    1 => ':id_sales_order_address',
  ),
), null, null, 'SpySalesShipments', false);
        $this->addRelation('SalesOrderAddressHistory', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderAddressHistory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_sales_order_address',
    1 => ':id_sales_order_address',
  ),
), null, null, 'SalesOrderAddressHistories', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAddress', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAddress', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAddress', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAddress', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAddress', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAddress', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesOrderAddress', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesOrderAddressTableMap::CLASS_DEFAULT : SpySalesOrderAddressTableMap::OM_CLASS;
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
     * @return array (SpySalesOrderAddress object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesOrderAddressTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesOrderAddressTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesOrderAddressTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesOrderAddressTableMap::OM_CLASS;
            /** @var SpySalesOrderAddress $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesOrderAddressTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesOrderAddressTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesOrderAddressTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesOrderAddress $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesOrderAddressTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_ID_SALES_ORDER_ADDRESS);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_FK_COUNTRY);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_FK_REGION);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_ADDRESS1);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_ADDRESS2);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_ADDRESS3);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_CELL_PHONE);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_CITY);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_COMMENT);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_COMPANY);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_EMAIL);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_MIDDLE_NAME);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_PHONE);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_PO_BOX);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_SALUTATION);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_ZIP_CODE);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesOrderAddressTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_order_address');
            $criteria->addSelectColumn($alias . '.fk_country');
            $criteria->addSelectColumn($alias . '.fk_region');
            $criteria->addSelectColumn($alias . '.address1');
            $criteria->addSelectColumn($alias . '.address2');
            $criteria->addSelectColumn($alias . '.address3');
            $criteria->addSelectColumn($alias . '.cell_phone');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.comment');
            $criteria->addSelectColumn($alias . '.company');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.last_name');
            $criteria->addSelectColumn($alias . '.middle_name');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.po_box');
            $criteria->addSelectColumn($alias . '.salutation');
            $criteria->addSelectColumn($alias . '.zip_code');
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
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_ID_SALES_ORDER_ADDRESS);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_FK_COUNTRY);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_FK_REGION);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_ADDRESS1);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_ADDRESS2);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_ADDRESS3);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_CELL_PHONE);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_CITY);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_COMMENT);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_COMPANY);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_FIRST_NAME);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_LAST_NAME);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_MIDDLE_NAME);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_PHONE);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_PO_BOX);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_SALUTATION);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_ZIP_CODE);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesOrderAddressTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_order_address');
            $criteria->removeSelectColumn($alias . '.fk_country');
            $criteria->removeSelectColumn($alias . '.fk_region');
            $criteria->removeSelectColumn($alias . '.address1');
            $criteria->removeSelectColumn($alias . '.address2');
            $criteria->removeSelectColumn($alias . '.address3');
            $criteria->removeSelectColumn($alias . '.cell_phone');
            $criteria->removeSelectColumn($alias . '.city');
            $criteria->removeSelectColumn($alias . '.comment');
            $criteria->removeSelectColumn($alias . '.company');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.first_name');
            $criteria->removeSelectColumn($alias . '.last_name');
            $criteria->removeSelectColumn($alias . '.middle_name');
            $criteria->removeSelectColumn($alias . '.phone');
            $criteria->removeSelectColumn($alias . '.po_box');
            $criteria->removeSelectColumn($alias . '.salutation');
            $criteria->removeSelectColumn($alias . '.zip_code');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesOrderAddressTableMap::DATABASE_NAME)->getTable(SpySalesOrderAddressTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesOrderAddress or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesOrderAddress object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderAddressTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Sales\Persistence\SpySalesOrderAddress) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesOrderAddressTableMap::DATABASE_NAME);
            $criteria->add(SpySalesOrderAddressTableMap::COL_ID_SALES_ORDER_ADDRESS, (array) $values, Criteria::IN);
        }

        $query = SpySalesOrderAddressQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesOrderAddressTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesOrderAddressTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_order_address table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesOrderAddressQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesOrderAddress or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesOrderAddress object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderAddressTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesOrderAddress object
        }

        if ($criteria->containsKey(SpySalesOrderAddressTableMap::COL_ID_SALES_ORDER_ADDRESS) && $criteria->keyContainsValue(SpySalesOrderAddressTableMap::COL_ID_SALES_ORDER_ADDRESS) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesOrderAddressTableMap::COL_ID_SALES_ORDER_ADDRESS.')');
        }


        // Set the correct dbName
        $query = SpySalesOrderAddressQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
