<?php

namespace Orm\Zed\Sales\Persistence\Map;

use Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistory;
use Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistoryQuery;
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
 * This class defines the structure of the 'spy_sales_order_address_history' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySalesOrderAddressHistoryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Sales.Persistence.Map.SpySalesOrderAddressHistoryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_sales_order_address_history';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySalesOrderAddressHistory';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderAddressHistory';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Sales.Persistence.SpySalesOrderAddressHistory';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 23;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 23;

    /**
     * the column name for the id_sales_order_address_history field
     */
    public const COL_ID_SALES_ORDER_ADDRESS_HISTORY = 'spy_sales_order_address_history.id_sales_order_address_history';

    /**
     * the column name for the fk_country field
     */
    public const COL_FK_COUNTRY = 'spy_sales_order_address_history.fk_country';

    /**
     * the column name for the fk_region field
     */
    public const COL_FK_REGION = 'spy_sales_order_address_history.fk_region';

    /**
     * the column name for the fk_sales_order_address field
     */
    public const COL_FK_SALES_ORDER_ADDRESS = 'spy_sales_order_address_history.fk_sales_order_address';

    /**
     * the column name for the address1 field
     */
    public const COL_ADDRESS1 = 'spy_sales_order_address_history.address1';

    /**
     * the column name for the address2 field
     */
    public const COL_ADDRESS2 = 'spy_sales_order_address_history.address2';

    /**
     * the column name for the address3 field
     */
    public const COL_ADDRESS3 = 'spy_sales_order_address_history.address3';

    /**
     * the column name for the cell_phone field
     */
    public const COL_CELL_PHONE = 'spy_sales_order_address_history.cell_phone';

    /**
     * the column name for the city field
     */
    public const COL_CITY = 'spy_sales_order_address_history.city';

    /**
     * the column name for the comment field
     */
    public const COL_COMMENT = 'spy_sales_order_address_history.comment';

    /**
     * the column name for the company field
     */
    public const COL_COMPANY = 'spy_sales_order_address_history.company';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'spy_sales_order_address_history.description';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'spy_sales_order_address_history.email';

    /**
     * the column name for the first_name field
     */
    public const COL_FIRST_NAME = 'spy_sales_order_address_history.first_name';

    /**
     * the column name for the is_billing field
     */
    public const COL_IS_BILLING = 'spy_sales_order_address_history.is_billing';

    /**
     * the column name for the last_name field
     */
    public const COL_LAST_NAME = 'spy_sales_order_address_history.last_name';

    /**
     * the column name for the middle_name field
     */
    public const COL_MIDDLE_NAME = 'spy_sales_order_address_history.middle_name';

    /**
     * the column name for the phone field
     */
    public const COL_PHONE = 'spy_sales_order_address_history.phone';

    /**
     * the column name for the po_box field
     */
    public const COL_PO_BOX = 'spy_sales_order_address_history.po_box';

    /**
     * the column name for the salutation field
     */
    public const COL_SALUTATION = 'spy_sales_order_address_history.salutation';

    /**
     * the column name for the zip_code field
     */
    public const COL_ZIP_CODE = 'spy_sales_order_address_history.zip_code';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_sales_order_address_history.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_sales_order_address_history.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSalesOrderAddressHistory', 'FkCountry', 'FkRegion', 'FkSalesOrderAddress', 'Address1', 'Address2', 'Address3', 'CellPhone', 'City', 'Comment', 'Company', 'Description', 'Email', 'FirstName', 'IsBilling', 'LastName', 'MiddleName', 'Phone', 'PoBox', 'Salutation', 'ZipCode', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSalesOrderAddressHistory', 'fkCountry', 'fkRegion', 'fkSalesOrderAddress', 'address1', 'address2', 'address3', 'cellPhone', 'city', 'comment', 'company', 'description', 'email', 'firstName', 'isBilling', 'lastName', 'middleName', 'phone', 'poBox', 'salutation', 'zipCode', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySalesOrderAddressHistoryTableMap::COL_ID_SALES_ORDER_ADDRESS_HISTORY, SpySalesOrderAddressHistoryTableMap::COL_FK_COUNTRY, SpySalesOrderAddressHistoryTableMap::COL_FK_REGION, SpySalesOrderAddressHistoryTableMap::COL_FK_SALES_ORDER_ADDRESS, SpySalesOrderAddressHistoryTableMap::COL_ADDRESS1, SpySalesOrderAddressHistoryTableMap::COL_ADDRESS2, SpySalesOrderAddressHistoryTableMap::COL_ADDRESS3, SpySalesOrderAddressHistoryTableMap::COL_CELL_PHONE, SpySalesOrderAddressHistoryTableMap::COL_CITY, SpySalesOrderAddressHistoryTableMap::COL_COMMENT, SpySalesOrderAddressHistoryTableMap::COL_COMPANY, SpySalesOrderAddressHistoryTableMap::COL_DESCRIPTION, SpySalesOrderAddressHistoryTableMap::COL_EMAIL, SpySalesOrderAddressHistoryTableMap::COL_FIRST_NAME, SpySalesOrderAddressHistoryTableMap::COL_IS_BILLING, SpySalesOrderAddressHistoryTableMap::COL_LAST_NAME, SpySalesOrderAddressHistoryTableMap::COL_MIDDLE_NAME, SpySalesOrderAddressHistoryTableMap::COL_PHONE, SpySalesOrderAddressHistoryTableMap::COL_PO_BOX, SpySalesOrderAddressHistoryTableMap::COL_SALUTATION, SpySalesOrderAddressHistoryTableMap::COL_ZIP_CODE, SpySalesOrderAddressHistoryTableMap::COL_CREATED_AT, SpySalesOrderAddressHistoryTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_address_history', 'fk_country', 'fk_region', 'fk_sales_order_address', 'address1', 'address2', 'address3', 'cell_phone', 'city', 'comment', 'company', 'description', 'email', 'first_name', 'is_billing', 'last_name', 'middle_name', 'phone', 'po_box', 'salutation', 'zip_code', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, ]
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
        self::TYPE_PHPNAME       => ['IdSalesOrderAddressHistory' => 0, 'FkCountry' => 1, 'FkRegion' => 2, 'FkSalesOrderAddress' => 3, 'Address1' => 4, 'Address2' => 5, 'Address3' => 6, 'CellPhone' => 7, 'City' => 8, 'Comment' => 9, 'Company' => 10, 'Description' => 11, 'Email' => 12, 'FirstName' => 13, 'IsBilling' => 14, 'LastName' => 15, 'MiddleName' => 16, 'Phone' => 17, 'PoBox' => 18, 'Salutation' => 19, 'ZipCode' => 20, 'CreatedAt' => 21, 'UpdatedAt' => 22, ],
        self::TYPE_CAMELNAME     => ['idSalesOrderAddressHistory' => 0, 'fkCountry' => 1, 'fkRegion' => 2, 'fkSalesOrderAddress' => 3, 'address1' => 4, 'address2' => 5, 'address3' => 6, 'cellPhone' => 7, 'city' => 8, 'comment' => 9, 'company' => 10, 'description' => 11, 'email' => 12, 'firstName' => 13, 'isBilling' => 14, 'lastName' => 15, 'middleName' => 16, 'phone' => 17, 'poBox' => 18, 'salutation' => 19, 'zipCode' => 20, 'createdAt' => 21, 'updatedAt' => 22, ],
        self::TYPE_COLNAME       => [SpySalesOrderAddressHistoryTableMap::COL_ID_SALES_ORDER_ADDRESS_HISTORY => 0, SpySalesOrderAddressHistoryTableMap::COL_FK_COUNTRY => 1, SpySalesOrderAddressHistoryTableMap::COL_FK_REGION => 2, SpySalesOrderAddressHistoryTableMap::COL_FK_SALES_ORDER_ADDRESS => 3, SpySalesOrderAddressHistoryTableMap::COL_ADDRESS1 => 4, SpySalesOrderAddressHistoryTableMap::COL_ADDRESS2 => 5, SpySalesOrderAddressHistoryTableMap::COL_ADDRESS3 => 6, SpySalesOrderAddressHistoryTableMap::COL_CELL_PHONE => 7, SpySalesOrderAddressHistoryTableMap::COL_CITY => 8, SpySalesOrderAddressHistoryTableMap::COL_COMMENT => 9, SpySalesOrderAddressHistoryTableMap::COL_COMPANY => 10, SpySalesOrderAddressHistoryTableMap::COL_DESCRIPTION => 11, SpySalesOrderAddressHistoryTableMap::COL_EMAIL => 12, SpySalesOrderAddressHistoryTableMap::COL_FIRST_NAME => 13, SpySalesOrderAddressHistoryTableMap::COL_IS_BILLING => 14, SpySalesOrderAddressHistoryTableMap::COL_LAST_NAME => 15, SpySalesOrderAddressHistoryTableMap::COL_MIDDLE_NAME => 16, SpySalesOrderAddressHistoryTableMap::COL_PHONE => 17, SpySalesOrderAddressHistoryTableMap::COL_PO_BOX => 18, SpySalesOrderAddressHistoryTableMap::COL_SALUTATION => 19, SpySalesOrderAddressHistoryTableMap::COL_ZIP_CODE => 20, SpySalesOrderAddressHistoryTableMap::COL_CREATED_AT => 21, SpySalesOrderAddressHistoryTableMap::COL_UPDATED_AT => 22, ],
        self::TYPE_FIELDNAME     => ['id_sales_order_address_history' => 0, 'fk_country' => 1, 'fk_region' => 2, 'fk_sales_order_address' => 3, 'address1' => 4, 'address2' => 5, 'address3' => 6, 'cell_phone' => 7, 'city' => 8, 'comment' => 9, 'company' => 10, 'description' => 11, 'email' => 12, 'first_name' => 13, 'is_billing' => 14, 'last_name' => 15, 'middle_name' => 16, 'phone' => 17, 'po_box' => 18, 'salutation' => 19, 'zip_code' => 20, 'created_at' => 21, 'updated_at' => 22, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSalesOrderAddressHistory' => 'ID_SALES_ORDER_ADDRESS_HISTORY',
        'SpySalesOrderAddressHistory.IdSalesOrderAddressHistory' => 'ID_SALES_ORDER_ADDRESS_HISTORY',
        'idSalesOrderAddressHistory' => 'ID_SALES_ORDER_ADDRESS_HISTORY',
        'spySalesOrderAddressHistory.idSalesOrderAddressHistory' => 'ID_SALES_ORDER_ADDRESS_HISTORY',
        'SpySalesOrderAddressHistoryTableMap::COL_ID_SALES_ORDER_ADDRESS_HISTORY' => 'ID_SALES_ORDER_ADDRESS_HISTORY',
        'COL_ID_SALES_ORDER_ADDRESS_HISTORY' => 'ID_SALES_ORDER_ADDRESS_HISTORY',
        'id_sales_order_address_history' => 'ID_SALES_ORDER_ADDRESS_HISTORY',
        'spy_sales_order_address_history.id_sales_order_address_history' => 'ID_SALES_ORDER_ADDRESS_HISTORY',
        'FkCountry' => 'FK_COUNTRY',
        'SpySalesOrderAddressHistory.FkCountry' => 'FK_COUNTRY',
        'fkCountry' => 'FK_COUNTRY',
        'spySalesOrderAddressHistory.fkCountry' => 'FK_COUNTRY',
        'SpySalesOrderAddressHistoryTableMap::COL_FK_COUNTRY' => 'FK_COUNTRY',
        'COL_FK_COUNTRY' => 'FK_COUNTRY',
        'fk_country' => 'FK_COUNTRY',
        'spy_sales_order_address_history.fk_country' => 'FK_COUNTRY',
        'FkRegion' => 'FK_REGION',
        'SpySalesOrderAddressHistory.FkRegion' => 'FK_REGION',
        'fkRegion' => 'FK_REGION',
        'spySalesOrderAddressHistory.fkRegion' => 'FK_REGION',
        'SpySalesOrderAddressHistoryTableMap::COL_FK_REGION' => 'FK_REGION',
        'COL_FK_REGION' => 'FK_REGION',
        'fk_region' => 'FK_REGION',
        'spy_sales_order_address_history.fk_region' => 'FK_REGION',
        'FkSalesOrderAddress' => 'FK_SALES_ORDER_ADDRESS',
        'SpySalesOrderAddressHistory.FkSalesOrderAddress' => 'FK_SALES_ORDER_ADDRESS',
        'fkSalesOrderAddress' => 'FK_SALES_ORDER_ADDRESS',
        'spySalesOrderAddressHistory.fkSalesOrderAddress' => 'FK_SALES_ORDER_ADDRESS',
        'SpySalesOrderAddressHistoryTableMap::COL_FK_SALES_ORDER_ADDRESS' => 'FK_SALES_ORDER_ADDRESS',
        'COL_FK_SALES_ORDER_ADDRESS' => 'FK_SALES_ORDER_ADDRESS',
        'fk_sales_order_address' => 'FK_SALES_ORDER_ADDRESS',
        'spy_sales_order_address_history.fk_sales_order_address' => 'FK_SALES_ORDER_ADDRESS',
        'Address1' => 'ADDRESS1',
        'SpySalesOrderAddressHistory.Address1' => 'ADDRESS1',
        'address1' => 'ADDRESS1',
        'spySalesOrderAddressHistory.address1' => 'ADDRESS1',
        'SpySalesOrderAddressHistoryTableMap::COL_ADDRESS1' => 'ADDRESS1',
        'COL_ADDRESS1' => 'ADDRESS1',
        'spy_sales_order_address_history.address1' => 'ADDRESS1',
        'Address2' => 'ADDRESS2',
        'SpySalesOrderAddressHistory.Address2' => 'ADDRESS2',
        'address2' => 'ADDRESS2',
        'spySalesOrderAddressHistory.address2' => 'ADDRESS2',
        'SpySalesOrderAddressHistoryTableMap::COL_ADDRESS2' => 'ADDRESS2',
        'COL_ADDRESS2' => 'ADDRESS2',
        'spy_sales_order_address_history.address2' => 'ADDRESS2',
        'Address3' => 'ADDRESS3',
        'SpySalesOrderAddressHistory.Address3' => 'ADDRESS3',
        'address3' => 'ADDRESS3',
        'spySalesOrderAddressHistory.address3' => 'ADDRESS3',
        'SpySalesOrderAddressHistoryTableMap::COL_ADDRESS3' => 'ADDRESS3',
        'COL_ADDRESS3' => 'ADDRESS3',
        'spy_sales_order_address_history.address3' => 'ADDRESS3',
        'CellPhone' => 'CELL_PHONE',
        'SpySalesOrderAddressHistory.CellPhone' => 'CELL_PHONE',
        'cellPhone' => 'CELL_PHONE',
        'spySalesOrderAddressHistory.cellPhone' => 'CELL_PHONE',
        'SpySalesOrderAddressHistoryTableMap::COL_CELL_PHONE' => 'CELL_PHONE',
        'COL_CELL_PHONE' => 'CELL_PHONE',
        'cell_phone' => 'CELL_PHONE',
        'spy_sales_order_address_history.cell_phone' => 'CELL_PHONE',
        'City' => 'CITY',
        'SpySalesOrderAddressHistory.City' => 'CITY',
        'city' => 'CITY',
        'spySalesOrderAddressHistory.city' => 'CITY',
        'SpySalesOrderAddressHistoryTableMap::COL_CITY' => 'CITY',
        'COL_CITY' => 'CITY',
        'spy_sales_order_address_history.city' => 'CITY',
        'Comment' => 'COMMENT',
        'SpySalesOrderAddressHistory.Comment' => 'COMMENT',
        'comment' => 'COMMENT',
        'spySalesOrderAddressHistory.comment' => 'COMMENT',
        'SpySalesOrderAddressHistoryTableMap::COL_COMMENT' => 'COMMENT',
        'COL_COMMENT' => 'COMMENT',
        'spy_sales_order_address_history.comment' => 'COMMENT',
        'Company' => 'COMPANY',
        'SpySalesOrderAddressHistory.Company' => 'COMPANY',
        'company' => 'COMPANY',
        'spySalesOrderAddressHistory.company' => 'COMPANY',
        'SpySalesOrderAddressHistoryTableMap::COL_COMPANY' => 'COMPANY',
        'COL_COMPANY' => 'COMPANY',
        'spy_sales_order_address_history.company' => 'COMPANY',
        'Description' => 'DESCRIPTION',
        'SpySalesOrderAddressHistory.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'spySalesOrderAddressHistory.description' => 'DESCRIPTION',
        'SpySalesOrderAddressHistoryTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'spy_sales_order_address_history.description' => 'DESCRIPTION',
        'Email' => 'EMAIL',
        'SpySalesOrderAddressHistory.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'spySalesOrderAddressHistory.email' => 'EMAIL',
        'SpySalesOrderAddressHistoryTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'spy_sales_order_address_history.email' => 'EMAIL',
        'FirstName' => 'FIRST_NAME',
        'SpySalesOrderAddressHistory.FirstName' => 'FIRST_NAME',
        'firstName' => 'FIRST_NAME',
        'spySalesOrderAddressHistory.firstName' => 'FIRST_NAME',
        'SpySalesOrderAddressHistoryTableMap::COL_FIRST_NAME' => 'FIRST_NAME',
        'COL_FIRST_NAME' => 'FIRST_NAME',
        'first_name' => 'FIRST_NAME',
        'spy_sales_order_address_history.first_name' => 'FIRST_NAME',
        'IsBilling' => 'IS_BILLING',
        'SpySalesOrderAddressHistory.IsBilling' => 'IS_BILLING',
        'isBilling' => 'IS_BILLING',
        'spySalesOrderAddressHistory.isBilling' => 'IS_BILLING',
        'SpySalesOrderAddressHistoryTableMap::COL_IS_BILLING' => 'IS_BILLING',
        'COL_IS_BILLING' => 'IS_BILLING',
        'is_billing' => 'IS_BILLING',
        'spy_sales_order_address_history.is_billing' => 'IS_BILLING',
        'LastName' => 'LAST_NAME',
        'SpySalesOrderAddressHistory.LastName' => 'LAST_NAME',
        'lastName' => 'LAST_NAME',
        'spySalesOrderAddressHistory.lastName' => 'LAST_NAME',
        'SpySalesOrderAddressHistoryTableMap::COL_LAST_NAME' => 'LAST_NAME',
        'COL_LAST_NAME' => 'LAST_NAME',
        'last_name' => 'LAST_NAME',
        'spy_sales_order_address_history.last_name' => 'LAST_NAME',
        'MiddleName' => 'MIDDLE_NAME',
        'SpySalesOrderAddressHistory.MiddleName' => 'MIDDLE_NAME',
        'middleName' => 'MIDDLE_NAME',
        'spySalesOrderAddressHistory.middleName' => 'MIDDLE_NAME',
        'SpySalesOrderAddressHistoryTableMap::COL_MIDDLE_NAME' => 'MIDDLE_NAME',
        'COL_MIDDLE_NAME' => 'MIDDLE_NAME',
        'middle_name' => 'MIDDLE_NAME',
        'spy_sales_order_address_history.middle_name' => 'MIDDLE_NAME',
        'Phone' => 'PHONE',
        'SpySalesOrderAddressHistory.Phone' => 'PHONE',
        'phone' => 'PHONE',
        'spySalesOrderAddressHistory.phone' => 'PHONE',
        'SpySalesOrderAddressHistoryTableMap::COL_PHONE' => 'PHONE',
        'COL_PHONE' => 'PHONE',
        'spy_sales_order_address_history.phone' => 'PHONE',
        'PoBox' => 'PO_BOX',
        'SpySalesOrderAddressHistory.PoBox' => 'PO_BOX',
        'poBox' => 'PO_BOX',
        'spySalesOrderAddressHistory.poBox' => 'PO_BOX',
        'SpySalesOrderAddressHistoryTableMap::COL_PO_BOX' => 'PO_BOX',
        'COL_PO_BOX' => 'PO_BOX',
        'po_box' => 'PO_BOX',
        'spy_sales_order_address_history.po_box' => 'PO_BOX',
        'Salutation' => 'SALUTATION',
        'SpySalesOrderAddressHistory.Salutation' => 'SALUTATION',
        'salutation' => 'SALUTATION',
        'spySalesOrderAddressHistory.salutation' => 'SALUTATION',
        'SpySalesOrderAddressHistoryTableMap::COL_SALUTATION' => 'SALUTATION',
        'COL_SALUTATION' => 'SALUTATION',
        'spy_sales_order_address_history.salutation' => 'SALUTATION',
        'ZipCode' => 'ZIP_CODE',
        'SpySalesOrderAddressHistory.ZipCode' => 'ZIP_CODE',
        'zipCode' => 'ZIP_CODE',
        'spySalesOrderAddressHistory.zipCode' => 'ZIP_CODE',
        'SpySalesOrderAddressHistoryTableMap::COL_ZIP_CODE' => 'ZIP_CODE',
        'COL_ZIP_CODE' => 'ZIP_CODE',
        'zip_code' => 'ZIP_CODE',
        'spy_sales_order_address_history.zip_code' => 'ZIP_CODE',
        'CreatedAt' => 'CREATED_AT',
        'SpySalesOrderAddressHistory.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySalesOrderAddressHistory.createdAt' => 'CREATED_AT',
        'SpySalesOrderAddressHistoryTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_sales_order_address_history.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySalesOrderAddressHistory.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySalesOrderAddressHistory.updatedAt' => 'UPDATED_AT',
        'SpySalesOrderAddressHistoryTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_sales_order_address_history.updated_at' => 'UPDATED_AT',
    ];

    /**
     * The enumerated values for this table
     *
     * @var array<string, array<string>>
     */
    protected static $enumValueSets = [
                SpySalesOrderAddressHistoryTableMap::COL_SALUTATION => [
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
        $this->setName('spy_sales_order_address_history');
        $this->setPhpName('SpySalesOrderAddressHistory');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderAddressHistory');
        $this->setPackage('src.Orm.Zed.Sales.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_sales_order_address_history_pk_seq');
        // columns
        $this->addPrimaryKey('id_sales_order_address_history', 'IdSalesOrderAddressHistory', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_country', 'FkCountry', 'INTEGER', 'spy_country', 'id_country', true, null, null);
        $this->addForeignKey('fk_region', 'FkRegion', 'INTEGER', 'spy_region', 'id_region', false, null, null);
        $this->addForeignKey('fk_sales_order_address', 'FkSalesOrderAddress', 'INTEGER', 'spy_sales_order_address', 'id_sales_order_address', true, null, null);
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
        $this->addColumn('is_billing', 'IsBilling', 'BOOLEAN', false, 1, false);
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
        $this->addRelation('SalesOrderAddress', '\\Orm\\Zed\\Sales\\Persistence\\SpySalesOrderAddress', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_sales_order_address',
    1 => ':id_sales_order_address',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAddressHistory', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAddressHistory', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAddressHistory', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAddressHistory', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAddressHistory', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSalesOrderAddressHistory', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSalesOrderAddressHistory', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySalesOrderAddressHistoryTableMap::CLASS_DEFAULT : SpySalesOrderAddressHistoryTableMap::OM_CLASS;
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
     * @return array (SpySalesOrderAddressHistory object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySalesOrderAddressHistoryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySalesOrderAddressHistoryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySalesOrderAddressHistoryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySalesOrderAddressHistoryTableMap::OM_CLASS;
            /** @var SpySalesOrderAddressHistory $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySalesOrderAddressHistoryTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySalesOrderAddressHistoryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySalesOrderAddressHistoryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySalesOrderAddressHistory $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySalesOrderAddressHistoryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_ID_SALES_ORDER_ADDRESS_HISTORY);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_FK_COUNTRY);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_FK_REGION);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_FK_SALES_ORDER_ADDRESS);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_ADDRESS1);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_ADDRESS2);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_ADDRESS3);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_CELL_PHONE);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_CITY);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_COMMENT);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_COMPANY);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_EMAIL);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_IS_BILLING);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_MIDDLE_NAME);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_PHONE);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_PO_BOX);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_SALUTATION);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_ZIP_CODE);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_sales_order_address_history');
            $criteria->addSelectColumn($alias . '.fk_country');
            $criteria->addSelectColumn($alias . '.fk_region');
            $criteria->addSelectColumn($alias . '.fk_sales_order_address');
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
            $criteria->addSelectColumn($alias . '.is_billing');
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
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_ID_SALES_ORDER_ADDRESS_HISTORY);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_FK_COUNTRY);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_FK_REGION);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_FK_SALES_ORDER_ADDRESS);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_ADDRESS1);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_ADDRESS2);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_ADDRESS3);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_CELL_PHONE);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_CITY);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_COMMENT);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_COMPANY);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_FIRST_NAME);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_IS_BILLING);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_LAST_NAME);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_MIDDLE_NAME);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_PHONE);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_PO_BOX);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_SALUTATION);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_ZIP_CODE);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySalesOrderAddressHistoryTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_sales_order_address_history');
            $criteria->removeSelectColumn($alias . '.fk_country');
            $criteria->removeSelectColumn($alias . '.fk_region');
            $criteria->removeSelectColumn($alias . '.fk_sales_order_address');
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
            $criteria->removeSelectColumn($alias . '.is_billing');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySalesOrderAddressHistoryTableMap::DATABASE_NAME)->getTable(SpySalesOrderAddressHistoryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySalesOrderAddressHistory or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySalesOrderAddressHistory object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderAddressHistoryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Sales\Persistence\SpySalesOrderAddressHistory) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySalesOrderAddressHistoryTableMap::DATABASE_NAME);
            $criteria->add(SpySalesOrderAddressHistoryTableMap::COL_ID_SALES_ORDER_ADDRESS_HISTORY, (array) $values, Criteria::IN);
        }

        $query = SpySalesOrderAddressHistoryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySalesOrderAddressHistoryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySalesOrderAddressHistoryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_sales_order_address_history table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySalesOrderAddressHistoryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySalesOrderAddressHistory or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySalesOrderAddressHistory object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySalesOrderAddressHistoryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySalesOrderAddressHistory object
        }

        if ($criteria->containsKey(SpySalesOrderAddressHistoryTableMap::COL_ID_SALES_ORDER_ADDRESS_HISTORY) && $criteria->keyContainsValue(SpySalesOrderAddressHistoryTableMap::COL_ID_SALES_ORDER_ADDRESS_HISTORY) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySalesOrderAddressHistoryTableMap::COL_ID_SALES_ORDER_ADDRESS_HISTORY.')');
        }


        // Set the correct dbName
        $query = SpySalesOrderAddressHistoryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
