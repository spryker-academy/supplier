<?php

namespace Orm\Zed\MerchantRegistrationRequest\Persistence\Map;

use Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest;
use Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequestQuery;
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
 * This class defines the structure of the 'spy_merchant_registration_request' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyMerchantRegistrationRequestTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MerchantRegistrationRequest.Persistence.Map.SpyMerchantRegistrationRequestTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_merchant_registration_request';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyMerchantRegistrationRequest';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MerchantRegistrationRequest\\Persistence\\SpyMerchantRegistrationRequest';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MerchantRegistrationRequest.Persistence.SpyMerchantRegistrationRequest';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 18;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 18;

    /**
     * the column name for the id_merchant_registration_request field
     */
    public const COL_ID_MERCHANT_REGISTRATION_REQUEST = 'spy_merchant_registration_request.id_merchant_registration_request';

    /**
     * the column name for the fk_country field
     */
    public const COL_FK_COUNTRY = 'spy_merchant_registration_request.fk_country';

    /**
     * the column name for the fk_store field
     */
    public const COL_FK_STORE = 'spy_merchant_registration_request.fk_store';

    /**
     * the column name for the company_name field
     */
    public const COL_COMPANY_NAME = 'spy_merchant_registration_request.company_name';

    /**
     * the column name for the registration_number field
     */
    public const COL_REGISTRATION_NUMBER = 'spy_merchant_registration_request.registration_number';

    /**
     * the column name for the address1 field
     */
    public const COL_ADDRESS1 = 'spy_merchant_registration_request.address1';

    /**
     * the column name for the address2 field
     */
    public const COL_ADDRESS2 = 'spy_merchant_registration_request.address2';

    /**
     * the column name for the zip_code field
     */
    public const COL_ZIP_CODE = 'spy_merchant_registration_request.zip_code';

    /**
     * the column name for the city field
     */
    public const COL_CITY = 'spy_merchant_registration_request.city';

    /**
     * the column name for the contact_person_title field
     */
    public const COL_CONTACT_PERSON_TITLE = 'spy_merchant_registration_request.contact_person_title';

    /**
     * the column name for the contact_person_first_name field
     */
    public const COL_CONTACT_PERSON_FIRST_NAME = 'spy_merchant_registration_request.contact_person_first_name';

    /**
     * the column name for the contact_person_last_name field
     */
    public const COL_CONTACT_PERSON_LAST_NAME = 'spy_merchant_registration_request.contact_person_last_name';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'spy_merchant_registration_request.email';

    /**
     * the column name for the contact_person_phone field
     */
    public const COL_CONTACT_PERSON_PHONE = 'spy_merchant_registration_request.contact_person_phone';

    /**
     * the column name for the contact_person_role field
     */
    public const COL_CONTACT_PERSON_ROLE = 'spy_merchant_registration_request.contact_person_role';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'spy_merchant_registration_request.status';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_merchant_registration_request.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_merchant_registration_request.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the contact_person_title field */
    public const COL_CONTACT_PERSON_TITLE_MR = 'Mr';
    public const COL_CONTACT_PERSON_TITLE_MRS = 'Mrs';
    public const COL_CONTACT_PERSON_TITLE_DR = 'Dr';
    public const COL_CONTACT_PERSON_TITLE_MS = 'Ms';
    public const COL_CONTACT_PERSON_TITLE_N_A = 'n/a';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdMerchantRegistrationRequest', 'FkCountry', 'FkStore', 'CompanyName', 'RegistrationNumber', 'Address1', 'Address2', 'ZipCode', 'City', 'ContactPersonTitle', 'ContactPersonFirstName', 'ContactPersonLastName', 'Email', 'ContactPersonPhone', 'ContactPersonRole', 'Status', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idMerchantRegistrationRequest', 'fkCountry', 'fkStore', 'companyName', 'registrationNumber', 'address1', 'address2', 'zipCode', 'city', 'contactPersonTitle', 'contactPersonFirstName', 'contactPersonLastName', 'email', 'contactPersonPhone', 'contactPersonRole', 'status', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyMerchantRegistrationRequestTableMap::COL_ID_MERCHANT_REGISTRATION_REQUEST, SpyMerchantRegistrationRequestTableMap::COL_FK_COUNTRY, SpyMerchantRegistrationRequestTableMap::COL_FK_STORE, SpyMerchantRegistrationRequestTableMap::COL_COMPANY_NAME, SpyMerchantRegistrationRequestTableMap::COL_REGISTRATION_NUMBER, SpyMerchantRegistrationRequestTableMap::COL_ADDRESS1, SpyMerchantRegistrationRequestTableMap::COL_ADDRESS2, SpyMerchantRegistrationRequestTableMap::COL_ZIP_CODE, SpyMerchantRegistrationRequestTableMap::COL_CITY, SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_TITLE, SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_FIRST_NAME, SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_LAST_NAME, SpyMerchantRegistrationRequestTableMap::COL_EMAIL, SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_PHONE, SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_ROLE, SpyMerchantRegistrationRequestTableMap::COL_STATUS, SpyMerchantRegistrationRequestTableMap::COL_CREATED_AT, SpyMerchantRegistrationRequestTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_merchant_registration_request', 'fk_country', 'fk_store', 'company_name', 'registration_number', 'address1', 'address2', 'zip_code', 'city', 'contact_person_title', 'contact_person_first_name', 'contact_person_last_name', 'email', 'contact_person_phone', 'contact_person_role', 'status', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
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
        self::TYPE_PHPNAME       => ['IdMerchantRegistrationRequest' => 0, 'FkCountry' => 1, 'FkStore' => 2, 'CompanyName' => 3, 'RegistrationNumber' => 4, 'Address1' => 5, 'Address2' => 6, 'ZipCode' => 7, 'City' => 8, 'ContactPersonTitle' => 9, 'ContactPersonFirstName' => 10, 'ContactPersonLastName' => 11, 'Email' => 12, 'ContactPersonPhone' => 13, 'ContactPersonRole' => 14, 'Status' => 15, 'CreatedAt' => 16, 'UpdatedAt' => 17, ],
        self::TYPE_CAMELNAME     => ['idMerchantRegistrationRequest' => 0, 'fkCountry' => 1, 'fkStore' => 2, 'companyName' => 3, 'registrationNumber' => 4, 'address1' => 5, 'address2' => 6, 'zipCode' => 7, 'city' => 8, 'contactPersonTitle' => 9, 'contactPersonFirstName' => 10, 'contactPersonLastName' => 11, 'email' => 12, 'contactPersonPhone' => 13, 'contactPersonRole' => 14, 'status' => 15, 'createdAt' => 16, 'updatedAt' => 17, ],
        self::TYPE_COLNAME       => [SpyMerchantRegistrationRequestTableMap::COL_ID_MERCHANT_REGISTRATION_REQUEST => 0, SpyMerchantRegistrationRequestTableMap::COL_FK_COUNTRY => 1, SpyMerchantRegistrationRequestTableMap::COL_FK_STORE => 2, SpyMerchantRegistrationRequestTableMap::COL_COMPANY_NAME => 3, SpyMerchantRegistrationRequestTableMap::COL_REGISTRATION_NUMBER => 4, SpyMerchantRegistrationRequestTableMap::COL_ADDRESS1 => 5, SpyMerchantRegistrationRequestTableMap::COL_ADDRESS2 => 6, SpyMerchantRegistrationRequestTableMap::COL_ZIP_CODE => 7, SpyMerchantRegistrationRequestTableMap::COL_CITY => 8, SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_TITLE => 9, SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_FIRST_NAME => 10, SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_LAST_NAME => 11, SpyMerchantRegistrationRequestTableMap::COL_EMAIL => 12, SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_PHONE => 13, SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_ROLE => 14, SpyMerchantRegistrationRequestTableMap::COL_STATUS => 15, SpyMerchantRegistrationRequestTableMap::COL_CREATED_AT => 16, SpyMerchantRegistrationRequestTableMap::COL_UPDATED_AT => 17, ],
        self::TYPE_FIELDNAME     => ['id_merchant_registration_request' => 0, 'fk_country' => 1, 'fk_store' => 2, 'company_name' => 3, 'registration_number' => 4, 'address1' => 5, 'address2' => 6, 'zip_code' => 7, 'city' => 8, 'contact_person_title' => 9, 'contact_person_first_name' => 10, 'contact_person_last_name' => 11, 'email' => 12, 'contact_person_phone' => 13, 'contact_person_role' => 14, 'status' => 15, 'created_at' => 16, 'updated_at' => 17, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdMerchantRegistrationRequest' => 'ID_MERCHANT_REGISTRATION_REQUEST',
        'SpyMerchantRegistrationRequest.IdMerchantRegistrationRequest' => 'ID_MERCHANT_REGISTRATION_REQUEST',
        'idMerchantRegistrationRequest' => 'ID_MERCHANT_REGISTRATION_REQUEST',
        'spyMerchantRegistrationRequest.idMerchantRegistrationRequest' => 'ID_MERCHANT_REGISTRATION_REQUEST',
        'SpyMerchantRegistrationRequestTableMap::COL_ID_MERCHANT_REGISTRATION_REQUEST' => 'ID_MERCHANT_REGISTRATION_REQUEST',
        'COL_ID_MERCHANT_REGISTRATION_REQUEST' => 'ID_MERCHANT_REGISTRATION_REQUEST',
        'id_merchant_registration_request' => 'ID_MERCHANT_REGISTRATION_REQUEST',
        'spy_merchant_registration_request.id_merchant_registration_request' => 'ID_MERCHANT_REGISTRATION_REQUEST',
        'FkCountry' => 'FK_COUNTRY',
        'SpyMerchantRegistrationRequest.FkCountry' => 'FK_COUNTRY',
        'fkCountry' => 'FK_COUNTRY',
        'spyMerchantRegistrationRequest.fkCountry' => 'FK_COUNTRY',
        'SpyMerchantRegistrationRequestTableMap::COL_FK_COUNTRY' => 'FK_COUNTRY',
        'COL_FK_COUNTRY' => 'FK_COUNTRY',
        'fk_country' => 'FK_COUNTRY',
        'spy_merchant_registration_request.fk_country' => 'FK_COUNTRY',
        'FkStore' => 'FK_STORE',
        'SpyMerchantRegistrationRequest.FkStore' => 'FK_STORE',
        'fkStore' => 'FK_STORE',
        'spyMerchantRegistrationRequest.fkStore' => 'FK_STORE',
        'SpyMerchantRegistrationRequestTableMap::COL_FK_STORE' => 'FK_STORE',
        'COL_FK_STORE' => 'FK_STORE',
        'fk_store' => 'FK_STORE',
        'spy_merchant_registration_request.fk_store' => 'FK_STORE',
        'CompanyName' => 'COMPANY_NAME',
        'SpyMerchantRegistrationRequest.CompanyName' => 'COMPANY_NAME',
        'companyName' => 'COMPANY_NAME',
        'spyMerchantRegistrationRequest.companyName' => 'COMPANY_NAME',
        'SpyMerchantRegistrationRequestTableMap::COL_COMPANY_NAME' => 'COMPANY_NAME',
        'COL_COMPANY_NAME' => 'COMPANY_NAME',
        'company_name' => 'COMPANY_NAME',
        'spy_merchant_registration_request.company_name' => 'COMPANY_NAME',
        'RegistrationNumber' => 'REGISTRATION_NUMBER',
        'SpyMerchantRegistrationRequest.RegistrationNumber' => 'REGISTRATION_NUMBER',
        'registrationNumber' => 'REGISTRATION_NUMBER',
        'spyMerchantRegistrationRequest.registrationNumber' => 'REGISTRATION_NUMBER',
        'SpyMerchantRegistrationRequestTableMap::COL_REGISTRATION_NUMBER' => 'REGISTRATION_NUMBER',
        'COL_REGISTRATION_NUMBER' => 'REGISTRATION_NUMBER',
        'registration_number' => 'REGISTRATION_NUMBER',
        'spy_merchant_registration_request.registration_number' => 'REGISTRATION_NUMBER',
        'Address1' => 'ADDRESS1',
        'SpyMerchantRegistrationRequest.Address1' => 'ADDRESS1',
        'address1' => 'ADDRESS1',
        'spyMerchantRegistrationRequest.address1' => 'ADDRESS1',
        'SpyMerchantRegistrationRequestTableMap::COL_ADDRESS1' => 'ADDRESS1',
        'COL_ADDRESS1' => 'ADDRESS1',
        'spy_merchant_registration_request.address1' => 'ADDRESS1',
        'Address2' => 'ADDRESS2',
        'SpyMerchantRegistrationRequest.Address2' => 'ADDRESS2',
        'address2' => 'ADDRESS2',
        'spyMerchantRegistrationRequest.address2' => 'ADDRESS2',
        'SpyMerchantRegistrationRequestTableMap::COL_ADDRESS2' => 'ADDRESS2',
        'COL_ADDRESS2' => 'ADDRESS2',
        'spy_merchant_registration_request.address2' => 'ADDRESS2',
        'ZipCode' => 'ZIP_CODE',
        'SpyMerchantRegistrationRequest.ZipCode' => 'ZIP_CODE',
        'zipCode' => 'ZIP_CODE',
        'spyMerchantRegistrationRequest.zipCode' => 'ZIP_CODE',
        'SpyMerchantRegistrationRequestTableMap::COL_ZIP_CODE' => 'ZIP_CODE',
        'COL_ZIP_CODE' => 'ZIP_CODE',
        'zip_code' => 'ZIP_CODE',
        'spy_merchant_registration_request.zip_code' => 'ZIP_CODE',
        'City' => 'CITY',
        'SpyMerchantRegistrationRequest.City' => 'CITY',
        'city' => 'CITY',
        'spyMerchantRegistrationRequest.city' => 'CITY',
        'SpyMerchantRegistrationRequestTableMap::COL_CITY' => 'CITY',
        'COL_CITY' => 'CITY',
        'spy_merchant_registration_request.city' => 'CITY',
        'ContactPersonTitle' => 'CONTACT_PERSON_TITLE',
        'SpyMerchantRegistrationRequest.ContactPersonTitle' => 'CONTACT_PERSON_TITLE',
        'contactPersonTitle' => 'CONTACT_PERSON_TITLE',
        'spyMerchantRegistrationRequest.contactPersonTitle' => 'CONTACT_PERSON_TITLE',
        'SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_TITLE' => 'CONTACT_PERSON_TITLE',
        'COL_CONTACT_PERSON_TITLE' => 'CONTACT_PERSON_TITLE',
        'contact_person_title' => 'CONTACT_PERSON_TITLE',
        'spy_merchant_registration_request.contact_person_title' => 'CONTACT_PERSON_TITLE',
        'ContactPersonFirstName' => 'CONTACT_PERSON_FIRST_NAME',
        'SpyMerchantRegistrationRequest.ContactPersonFirstName' => 'CONTACT_PERSON_FIRST_NAME',
        'contactPersonFirstName' => 'CONTACT_PERSON_FIRST_NAME',
        'spyMerchantRegistrationRequest.contactPersonFirstName' => 'CONTACT_PERSON_FIRST_NAME',
        'SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_FIRST_NAME' => 'CONTACT_PERSON_FIRST_NAME',
        'COL_CONTACT_PERSON_FIRST_NAME' => 'CONTACT_PERSON_FIRST_NAME',
        'contact_person_first_name' => 'CONTACT_PERSON_FIRST_NAME',
        'spy_merchant_registration_request.contact_person_first_name' => 'CONTACT_PERSON_FIRST_NAME',
        'ContactPersonLastName' => 'CONTACT_PERSON_LAST_NAME',
        'SpyMerchantRegistrationRequest.ContactPersonLastName' => 'CONTACT_PERSON_LAST_NAME',
        'contactPersonLastName' => 'CONTACT_PERSON_LAST_NAME',
        'spyMerchantRegistrationRequest.contactPersonLastName' => 'CONTACT_PERSON_LAST_NAME',
        'SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_LAST_NAME' => 'CONTACT_PERSON_LAST_NAME',
        'COL_CONTACT_PERSON_LAST_NAME' => 'CONTACT_PERSON_LAST_NAME',
        'contact_person_last_name' => 'CONTACT_PERSON_LAST_NAME',
        'spy_merchant_registration_request.contact_person_last_name' => 'CONTACT_PERSON_LAST_NAME',
        'Email' => 'EMAIL',
        'SpyMerchantRegistrationRequest.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'spyMerchantRegistrationRequest.email' => 'EMAIL',
        'SpyMerchantRegistrationRequestTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'spy_merchant_registration_request.email' => 'EMAIL',
        'ContactPersonPhone' => 'CONTACT_PERSON_PHONE',
        'SpyMerchantRegistrationRequest.ContactPersonPhone' => 'CONTACT_PERSON_PHONE',
        'contactPersonPhone' => 'CONTACT_PERSON_PHONE',
        'spyMerchantRegistrationRequest.contactPersonPhone' => 'CONTACT_PERSON_PHONE',
        'SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_PHONE' => 'CONTACT_PERSON_PHONE',
        'COL_CONTACT_PERSON_PHONE' => 'CONTACT_PERSON_PHONE',
        'contact_person_phone' => 'CONTACT_PERSON_PHONE',
        'spy_merchant_registration_request.contact_person_phone' => 'CONTACT_PERSON_PHONE',
        'ContactPersonRole' => 'CONTACT_PERSON_ROLE',
        'SpyMerchantRegistrationRequest.ContactPersonRole' => 'CONTACT_PERSON_ROLE',
        'contactPersonRole' => 'CONTACT_PERSON_ROLE',
        'spyMerchantRegistrationRequest.contactPersonRole' => 'CONTACT_PERSON_ROLE',
        'SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_ROLE' => 'CONTACT_PERSON_ROLE',
        'COL_CONTACT_PERSON_ROLE' => 'CONTACT_PERSON_ROLE',
        'contact_person_role' => 'CONTACT_PERSON_ROLE',
        'spy_merchant_registration_request.contact_person_role' => 'CONTACT_PERSON_ROLE',
        'Status' => 'STATUS',
        'SpyMerchantRegistrationRequest.Status' => 'STATUS',
        'status' => 'STATUS',
        'spyMerchantRegistrationRequest.status' => 'STATUS',
        'SpyMerchantRegistrationRequestTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'spy_merchant_registration_request.status' => 'STATUS',
        'CreatedAt' => 'CREATED_AT',
        'SpyMerchantRegistrationRequest.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyMerchantRegistrationRequest.createdAt' => 'CREATED_AT',
        'SpyMerchantRegistrationRequestTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_merchant_registration_request.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyMerchantRegistrationRequest.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyMerchantRegistrationRequest.updatedAt' => 'UPDATED_AT',
        'SpyMerchantRegistrationRequestTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_merchant_registration_request.updated_at' => 'UPDATED_AT',
    ];

    /**
     * The enumerated values for this table
     *
     * @var array<string, array<string>>
     */
    protected static $enumValueSets = [
                SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_TITLE => [
                            self::COL_CONTACT_PERSON_TITLE_MR,
            self::COL_CONTACT_PERSON_TITLE_MRS,
            self::COL_CONTACT_PERSON_TITLE_DR,
            self::COL_CONTACT_PERSON_TITLE_MS,
            self::COL_CONTACT_PERSON_TITLE_N_A,
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
        $this->setName('spy_merchant_registration_request');
        $this->setPhpName('SpyMerchantRegistrationRequest');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\MerchantRegistrationRequest\\Persistence\\SpyMerchantRegistrationRequest');
        $this->setPackage('src.Orm.Zed.MerchantRegistrationRequest.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_merchant_registration_request_pk_seq');
        // columns
        $this->addPrimaryKey('id_merchant_registration_request', 'IdMerchantRegistrationRequest', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_country', 'FkCountry', 'INTEGER', 'spy_country', 'id_country', true, null, null);
        $this->addForeignKey('fk_store', 'FkStore', 'INTEGER', 'spy_store', 'id_store', true, null, null);
        $this->addColumn('company_name', 'CompanyName', 'VARCHAR', true, 255, null);
        $this->addColumn('registration_number', 'RegistrationNumber', 'VARCHAR', true, 50, null);
        $this->addColumn('address1', 'Address1', 'VARCHAR', true, 255, null);
        $this->addColumn('address2', 'Address2', 'VARCHAR', true, 255, null);
        $this->addColumn('zip_code', 'ZipCode', 'VARCHAR', true, 15, null);
        $this->addColumn('city', 'City', 'VARCHAR', true, 255, null);
        $this->addColumn('contact_person_title', 'ContactPersonTitle', 'ENUM', true, null, null);
        $this->getColumn('contact_person_title')->setValueSet(array (
  0 => 'Mr',
  1 => 'Mrs',
  2 => 'Dr',
  3 => 'Ms',
  4 => 'n/a',
));
        $this->addColumn('contact_person_first_name', 'ContactPersonFirstName', 'VARCHAR', true, 100, null);
        $this->addColumn('contact_person_last_name', 'ContactPersonLastName', 'VARCHAR', true, 100, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 255, null);
        $this->addColumn('contact_person_phone', 'ContactPersonPhone', 'VARCHAR', false, 255, null);
        $this->addColumn('contact_person_role', 'ContactPersonRole', 'VARCHAR', true, 255, null);
        $this->addColumn('status', 'Status', 'VARCHAR', true, 255, null);
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
        $this->addRelation('Store', '\\Orm\\Zed\\Store\\Persistence\\SpyStore', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_store',
    1 => ':id_store',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRegistrationRequest', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRegistrationRequest', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRegistrationRequest', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRegistrationRequest', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRegistrationRequest', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRegistrationRequest', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdMerchantRegistrationRequest', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyMerchantRegistrationRequestTableMap::CLASS_DEFAULT : SpyMerchantRegistrationRequestTableMap::OM_CLASS;
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
     * @return array (SpyMerchantRegistrationRequest object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyMerchantRegistrationRequestTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyMerchantRegistrationRequestTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyMerchantRegistrationRequestTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyMerchantRegistrationRequestTableMap::OM_CLASS;
            /** @var SpyMerchantRegistrationRequest $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyMerchantRegistrationRequestTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyMerchantRegistrationRequestTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyMerchantRegistrationRequestTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyMerchantRegistrationRequest $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyMerchantRegistrationRequestTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_ID_MERCHANT_REGISTRATION_REQUEST);
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_FK_COUNTRY);
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_FK_STORE);
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_COMPANY_NAME);
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_REGISTRATION_NUMBER);
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_ADDRESS1);
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_ADDRESS2);
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_ZIP_CODE);
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_CITY);
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_TITLE);
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_FIRST_NAME);
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_LAST_NAME);
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_EMAIL);
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_PHONE);
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_ROLE);
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_STATUS);
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_merchant_registration_request');
            $criteria->addSelectColumn($alias . '.fk_country');
            $criteria->addSelectColumn($alias . '.fk_store');
            $criteria->addSelectColumn($alias . '.company_name');
            $criteria->addSelectColumn($alias . '.registration_number');
            $criteria->addSelectColumn($alias . '.address1');
            $criteria->addSelectColumn($alias . '.address2');
            $criteria->addSelectColumn($alias . '.zip_code');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.contact_person_title');
            $criteria->addSelectColumn($alias . '.contact_person_first_name');
            $criteria->addSelectColumn($alias . '.contact_person_last_name');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.contact_person_phone');
            $criteria->addSelectColumn($alias . '.contact_person_role');
            $criteria->addSelectColumn($alias . '.status');
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
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_ID_MERCHANT_REGISTRATION_REQUEST);
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_FK_COUNTRY);
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_FK_STORE);
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_COMPANY_NAME);
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_REGISTRATION_NUMBER);
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_ADDRESS1);
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_ADDRESS2);
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_ZIP_CODE);
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_CITY);
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_TITLE);
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_FIRST_NAME);
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_LAST_NAME);
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_PHONE);
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_CONTACT_PERSON_ROLE);
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyMerchantRegistrationRequestTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_merchant_registration_request');
            $criteria->removeSelectColumn($alias . '.fk_country');
            $criteria->removeSelectColumn($alias . '.fk_store');
            $criteria->removeSelectColumn($alias . '.company_name');
            $criteria->removeSelectColumn($alias . '.registration_number');
            $criteria->removeSelectColumn($alias . '.address1');
            $criteria->removeSelectColumn($alias . '.address2');
            $criteria->removeSelectColumn($alias . '.zip_code');
            $criteria->removeSelectColumn($alias . '.city');
            $criteria->removeSelectColumn($alias . '.contact_person_title');
            $criteria->removeSelectColumn($alias . '.contact_person_first_name');
            $criteria->removeSelectColumn($alias . '.contact_person_last_name');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.contact_person_phone');
            $criteria->removeSelectColumn($alias . '.contact_person_role');
            $criteria->removeSelectColumn($alias . '.status');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyMerchantRegistrationRequestTableMap::DATABASE_NAME)->getTable(SpyMerchantRegistrationRequestTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyMerchantRegistrationRequest or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyMerchantRegistrationRequest object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantRegistrationRequestTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MerchantRegistrationRequest\Persistence\SpyMerchantRegistrationRequest) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyMerchantRegistrationRequestTableMap::DATABASE_NAME);
            $criteria->add(SpyMerchantRegistrationRequestTableMap::COL_ID_MERCHANT_REGISTRATION_REQUEST, (array) $values, Criteria::IN);
        }

        $query = SpyMerchantRegistrationRequestQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyMerchantRegistrationRequestTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyMerchantRegistrationRequestTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_merchant_registration_request table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyMerchantRegistrationRequestQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyMerchantRegistrationRequest or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyMerchantRegistrationRequest object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantRegistrationRequestTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyMerchantRegistrationRequest object
        }

        if ($criteria->containsKey(SpyMerchantRegistrationRequestTableMap::COL_ID_MERCHANT_REGISTRATION_REQUEST) && $criteria->keyContainsValue(SpyMerchantRegistrationRequestTableMap::COL_ID_MERCHANT_REGISTRATION_REQUEST) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyMerchantRegistrationRequestTableMap::COL_ID_MERCHANT_REGISTRATION_REQUEST.')');
        }


        // Set the correct dbName
        $query = SpyMerchantRegistrationRequestQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
