<?php

namespace Orm\Zed\CompanyBusinessUnit\Persistence\Map;

use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit;
use Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnitQuery;
use Orm\Zed\CompanyUnitAddress\Persistence\Map\SpyCompanyUnitAddressToCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyUser\Persistence\Map\SpyCompanyUserTableMap;
use Orm\Zed\MerchantRelationRequest\Persistence\Map\SpyMerchantRelationRequestTableMap;
use Orm\Zed\MerchantRelationRequest\Persistence\Map\SpyMerchantRelationRequestToCompanyBusinessUnitTableMap;
use Orm\Zed\MerchantRelationship\Persistence\Map\SpyMerchantRelationshipTableMap;
use Orm\Zed\MerchantRelationship\Persistence\Map\SpyMerchantRelationshipToCompanyBusinessUnitTableMap;
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
 * This class defines the structure of the 'spy_company_business_unit' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCompanyBusinessUnitTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CompanyBusinessUnit.Persistence.Map.SpyCompanyBusinessUnitTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_company_business_unit';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCompanyBusinessUnit';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CompanyBusinessUnit\\Persistence\\SpyCompanyBusinessUnit';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CompanyBusinessUnit.Persistence.SpyCompanyBusinessUnit';

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
     * the column name for the id_company_business_unit field
     */
    public const COL_ID_COMPANY_BUSINESS_UNIT = 'spy_company_business_unit.id_company_business_unit';

    /**
     * the column name for the fk_company field
     */
    public const COL_FK_COMPANY = 'spy_company_business_unit.fk_company';

    /**
     * the column name for the fk_parent_company_business_unit field
     */
    public const COL_FK_PARENT_COMPANY_BUSINESS_UNIT = 'spy_company_business_unit.fk_parent_company_business_unit';

    /**
     * the column name for the bic field
     */
    public const COL_BIC = 'spy_company_business_unit.bic';

    /**
     * the column name for the default_billing_address field
     */
    public const COL_DEFAULT_BILLING_ADDRESS = 'spy_company_business_unit.default_billing_address';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'spy_company_business_unit.email';

    /**
     * the column name for the external_url field
     */
    public const COL_EXTERNAL_URL = 'spy_company_business_unit.external_url';

    /**
     * the column name for the iban field
     */
    public const COL_IBAN = 'spy_company_business_unit.iban';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_company_business_unit.key';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_company_business_unit.name';

    /**
     * the column name for the phone field
     */
    public const COL_PHONE = 'spy_company_business_unit.phone';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_company_business_unit.uuid';

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
        self::TYPE_PHPNAME       => ['IdCompanyBusinessUnit', 'FkCompany', 'FkParentCompanyBusinessUnit', 'Bic', 'DefaultBillingAddress', 'Email', 'ExternalUrl', 'Iban', 'Key', 'Name', 'Phone', 'Uuid', ],
        self::TYPE_CAMELNAME     => ['idCompanyBusinessUnit', 'fkCompany', 'fkParentCompanyBusinessUnit', 'bic', 'defaultBillingAddress', 'email', 'externalUrl', 'iban', 'key', 'name', 'phone', 'uuid', ],
        self::TYPE_COLNAME       => [SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY, SpyCompanyBusinessUnitTableMap::COL_FK_PARENT_COMPANY_BUSINESS_UNIT, SpyCompanyBusinessUnitTableMap::COL_BIC, SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS, SpyCompanyBusinessUnitTableMap::COL_EMAIL, SpyCompanyBusinessUnitTableMap::COL_EXTERNAL_URL, SpyCompanyBusinessUnitTableMap::COL_IBAN, SpyCompanyBusinessUnitTableMap::COL_KEY, SpyCompanyBusinessUnitTableMap::COL_NAME, SpyCompanyBusinessUnitTableMap::COL_PHONE, SpyCompanyBusinessUnitTableMap::COL_UUID, ],
        self::TYPE_FIELDNAME     => ['id_company_business_unit', 'fk_company', 'fk_parent_company_business_unit', 'bic', 'default_billing_address', 'email', 'external_url', 'iban', 'key', 'name', 'phone', 'uuid', ],
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
        self::TYPE_PHPNAME       => ['IdCompanyBusinessUnit' => 0, 'FkCompany' => 1, 'FkParentCompanyBusinessUnit' => 2, 'Bic' => 3, 'DefaultBillingAddress' => 4, 'Email' => 5, 'ExternalUrl' => 6, 'Iban' => 7, 'Key' => 8, 'Name' => 9, 'Phone' => 10, 'Uuid' => 11, ],
        self::TYPE_CAMELNAME     => ['idCompanyBusinessUnit' => 0, 'fkCompany' => 1, 'fkParentCompanyBusinessUnit' => 2, 'bic' => 3, 'defaultBillingAddress' => 4, 'email' => 5, 'externalUrl' => 6, 'iban' => 7, 'key' => 8, 'name' => 9, 'phone' => 10, 'uuid' => 11, ],
        self::TYPE_COLNAME       => [SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT => 0, SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY => 1, SpyCompanyBusinessUnitTableMap::COL_FK_PARENT_COMPANY_BUSINESS_UNIT => 2, SpyCompanyBusinessUnitTableMap::COL_BIC => 3, SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS => 4, SpyCompanyBusinessUnitTableMap::COL_EMAIL => 5, SpyCompanyBusinessUnitTableMap::COL_EXTERNAL_URL => 6, SpyCompanyBusinessUnitTableMap::COL_IBAN => 7, SpyCompanyBusinessUnitTableMap::COL_KEY => 8, SpyCompanyBusinessUnitTableMap::COL_NAME => 9, SpyCompanyBusinessUnitTableMap::COL_PHONE => 10, SpyCompanyBusinessUnitTableMap::COL_UUID => 11, ],
        self::TYPE_FIELDNAME     => ['id_company_business_unit' => 0, 'fk_company' => 1, 'fk_parent_company_business_unit' => 2, 'bic' => 3, 'default_billing_address' => 4, 'email' => 5, 'external_url' => 6, 'iban' => 7, 'key' => 8, 'name' => 9, 'phone' => 10, 'uuid' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCompanyBusinessUnit' => 'ID_COMPANY_BUSINESS_UNIT',
        'SpyCompanyBusinessUnit.IdCompanyBusinessUnit' => 'ID_COMPANY_BUSINESS_UNIT',
        'idCompanyBusinessUnit' => 'ID_COMPANY_BUSINESS_UNIT',
        'spyCompanyBusinessUnit.idCompanyBusinessUnit' => 'ID_COMPANY_BUSINESS_UNIT',
        'SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT' => 'ID_COMPANY_BUSINESS_UNIT',
        'COL_ID_COMPANY_BUSINESS_UNIT' => 'ID_COMPANY_BUSINESS_UNIT',
        'id_company_business_unit' => 'ID_COMPANY_BUSINESS_UNIT',
        'spy_company_business_unit.id_company_business_unit' => 'ID_COMPANY_BUSINESS_UNIT',
        'FkCompany' => 'FK_COMPANY',
        'SpyCompanyBusinessUnit.FkCompany' => 'FK_COMPANY',
        'fkCompany' => 'FK_COMPANY',
        'spyCompanyBusinessUnit.fkCompany' => 'FK_COMPANY',
        'SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY' => 'FK_COMPANY',
        'COL_FK_COMPANY' => 'FK_COMPANY',
        'fk_company' => 'FK_COMPANY',
        'spy_company_business_unit.fk_company' => 'FK_COMPANY',
        'FkParentCompanyBusinessUnit' => 'FK_PARENT_COMPANY_BUSINESS_UNIT',
        'SpyCompanyBusinessUnit.FkParentCompanyBusinessUnit' => 'FK_PARENT_COMPANY_BUSINESS_UNIT',
        'fkParentCompanyBusinessUnit' => 'FK_PARENT_COMPANY_BUSINESS_UNIT',
        'spyCompanyBusinessUnit.fkParentCompanyBusinessUnit' => 'FK_PARENT_COMPANY_BUSINESS_UNIT',
        'SpyCompanyBusinessUnitTableMap::COL_FK_PARENT_COMPANY_BUSINESS_UNIT' => 'FK_PARENT_COMPANY_BUSINESS_UNIT',
        'COL_FK_PARENT_COMPANY_BUSINESS_UNIT' => 'FK_PARENT_COMPANY_BUSINESS_UNIT',
        'fk_parent_company_business_unit' => 'FK_PARENT_COMPANY_BUSINESS_UNIT',
        'spy_company_business_unit.fk_parent_company_business_unit' => 'FK_PARENT_COMPANY_BUSINESS_UNIT',
        'Bic' => 'BIC',
        'SpyCompanyBusinessUnit.Bic' => 'BIC',
        'bic' => 'BIC',
        'spyCompanyBusinessUnit.bic' => 'BIC',
        'SpyCompanyBusinessUnitTableMap::COL_BIC' => 'BIC',
        'COL_BIC' => 'BIC',
        'spy_company_business_unit.bic' => 'BIC',
        'DefaultBillingAddress' => 'DEFAULT_BILLING_ADDRESS',
        'SpyCompanyBusinessUnit.DefaultBillingAddress' => 'DEFAULT_BILLING_ADDRESS',
        'defaultBillingAddress' => 'DEFAULT_BILLING_ADDRESS',
        'spyCompanyBusinessUnit.defaultBillingAddress' => 'DEFAULT_BILLING_ADDRESS',
        'SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS' => 'DEFAULT_BILLING_ADDRESS',
        'COL_DEFAULT_BILLING_ADDRESS' => 'DEFAULT_BILLING_ADDRESS',
        'default_billing_address' => 'DEFAULT_BILLING_ADDRESS',
        'spy_company_business_unit.default_billing_address' => 'DEFAULT_BILLING_ADDRESS',
        'Email' => 'EMAIL',
        'SpyCompanyBusinessUnit.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'spyCompanyBusinessUnit.email' => 'EMAIL',
        'SpyCompanyBusinessUnitTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'spy_company_business_unit.email' => 'EMAIL',
        'ExternalUrl' => 'EXTERNAL_URL',
        'SpyCompanyBusinessUnit.ExternalUrl' => 'EXTERNAL_URL',
        'externalUrl' => 'EXTERNAL_URL',
        'spyCompanyBusinessUnit.externalUrl' => 'EXTERNAL_URL',
        'SpyCompanyBusinessUnitTableMap::COL_EXTERNAL_URL' => 'EXTERNAL_URL',
        'COL_EXTERNAL_URL' => 'EXTERNAL_URL',
        'external_url' => 'EXTERNAL_URL',
        'spy_company_business_unit.external_url' => 'EXTERNAL_URL',
        'Iban' => 'IBAN',
        'SpyCompanyBusinessUnit.Iban' => 'IBAN',
        'iban' => 'IBAN',
        'spyCompanyBusinessUnit.iban' => 'IBAN',
        'SpyCompanyBusinessUnitTableMap::COL_IBAN' => 'IBAN',
        'COL_IBAN' => 'IBAN',
        'spy_company_business_unit.iban' => 'IBAN',
        'Key' => 'KEY',
        'SpyCompanyBusinessUnit.Key' => 'KEY',
        'key' => 'KEY',
        'spyCompanyBusinessUnit.key' => 'KEY',
        'SpyCompanyBusinessUnitTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_company_business_unit.key' => 'KEY',
        'Name' => 'NAME',
        'SpyCompanyBusinessUnit.Name' => 'NAME',
        'name' => 'NAME',
        'spyCompanyBusinessUnit.name' => 'NAME',
        'SpyCompanyBusinessUnitTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_company_business_unit.name' => 'NAME',
        'Phone' => 'PHONE',
        'SpyCompanyBusinessUnit.Phone' => 'PHONE',
        'phone' => 'PHONE',
        'spyCompanyBusinessUnit.phone' => 'PHONE',
        'SpyCompanyBusinessUnitTableMap::COL_PHONE' => 'PHONE',
        'COL_PHONE' => 'PHONE',
        'spy_company_business_unit.phone' => 'PHONE',
        'Uuid' => 'UUID',
        'SpyCompanyBusinessUnit.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyCompanyBusinessUnit.uuid' => 'UUID',
        'SpyCompanyBusinessUnitTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_company_business_unit.uuid' => 'UUID',
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
        $this->setName('spy_company_business_unit');
        $this->setPhpName('SpyCompanyBusinessUnit');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\CompanyBusinessUnit\\Persistence\\SpyCompanyBusinessUnit');
        $this->setPackage('src.Orm.Zed.CompanyBusinessUnit.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_company_business_unit_pk_seq');
        // columns
        $this->addPrimaryKey('id_company_business_unit', 'IdCompanyBusinessUnit', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_company', 'FkCompany', 'INTEGER', 'spy_company', 'id_company', true, null, null);
        $this->addForeignKey('fk_parent_company_business_unit', 'FkParentCompanyBusinessUnit', 'INTEGER', 'spy_company_business_unit', 'id_company_business_unit', false, null, null);
        $this->addColumn('bic', 'Bic', 'VARCHAR', false, 255, null);
        $this->addForeignKey('default_billing_address', 'DefaultBillingAddress', 'INTEGER', 'spy_company_unit_address', 'id_company_unit_address', false, null, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 255, null);
        $this->addColumn('external_url', 'ExternalUrl', 'VARCHAR', false, 255, null);
        $this->addColumn('iban', 'Iban', 'VARCHAR', false, 255, null);
        $this->addColumn('key', 'Key', 'VARCHAR', false, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, 255, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 36, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Company', '\\Orm\\Zed\\Company\\Persistence\\SpyCompany', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_company',
    1 => ':id_company',
  ),
), null, null, null, false);
        $this->addRelation('ParentCompanyBusinessUnit', '\\Orm\\Zed\\CompanyBusinessUnit\\Persistence\\SpyCompanyBusinessUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_parent_company_business_unit',
    1 => ':id_company_business_unit',
  ),
), null, null, null, false);
        $this->addRelation('CompanyBusinessUnitDefaultBillingAddress', '\\Orm\\Zed\\CompanyUnitAddress\\Persistence\\SpyCompanyUnitAddress', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':default_billing_address',
    1 => ':id_company_unit_address',
  ),
), 'SET NULL', null, null, false);
        $this->addRelation('ChildrenCompanyBusinessUnits', '\\Orm\\Zed\\CompanyBusinessUnit\\Persistence\\SpyCompanyBusinessUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_parent_company_business_unit',
    1 => ':id_company_business_unit',
  ),
), null, null, 'ChildrenCompanyBusinessUnitss', false);
        $this->addRelation('SpyCompanyBusinessUnitFile', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpyCompanyBusinessUnitFile', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company_business_unit',
    1 => ':id_company_business_unit',
  ),
), null, null, 'SpyCompanyBusinessUnitFiles', false);
        $this->addRelation('SpyCompanyUnitAddressToCompanyBusinessUnit', '\\Orm\\Zed\\CompanyUnitAddress\\Persistence\\SpyCompanyUnitAddressToCompanyBusinessUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company_business_unit',
    1 => ':id_company_business_unit',
  ),
), 'CASCADE', null, 'SpyCompanyUnitAddressToCompanyBusinessUnits', false);
        $this->addRelation('CompanyUser', '\\Orm\\Zed\\CompanyUser\\Persistence\\SpyCompanyUser', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company_business_unit',
    1 => ':id_company_business_unit',
  ),
), 'SET NULL', null, 'CompanyUsers', false);
        $this->addRelation('SpyCompanyUserInvitation', '\\Orm\\Zed\\CompanyUserInvitation\\Persistence\\SpyCompanyUserInvitation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company_business_unit',
    1 => ':id_company_business_unit',
  ),
), null, null, 'SpyCompanyUserInvitations', false);
        $this->addRelation('SpyMerchantRelationRequest', '\\Orm\\Zed\\MerchantRelationRequest\\Persistence\\SpyMerchantRelationRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company_business_unit',
    1 => ':id_company_business_unit',
  ),
), 'CASCADE', null, 'SpyMerchantRelationRequests', false);
        $this->addRelation('SpyMerchantRelationRequestToCompanyBusinessUnit', '\\Orm\\Zed\\MerchantRelationRequest\\Persistence\\SpyMerchantRelationRequestToCompanyBusinessUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company_business_unit',
    1 => ':id_company_business_unit',
  ),
), 'CASCADE', null, 'SpyMerchantRelationRequestToCompanyBusinessUnits', false);
        $this->addRelation('SpyMerchantRelationship', '\\Orm\\Zed\\MerchantRelationship\\Persistence\\SpyMerchantRelationship', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company_business_unit',
    1 => ':id_company_business_unit',
  ),
), 'CASCADE', null, 'SpyMerchantRelationships', false);
        $this->addRelation('SpyMerchantRelationshipToCompanyBusinessUnit', '\\Orm\\Zed\\MerchantRelationship\\Persistence\\SpyMerchantRelationshipToCompanyBusinessUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company_business_unit',
    1 => ':id_company_business_unit',
  ),
), 'CASCADE', null, 'SpyMerchantRelationshipToCompanyBusinessUnits', false);
        $this->addRelation('SpyShoppingListCompanyBusinessUnit', '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListCompanyBusinessUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company_business_unit',
    1 => ':id_company_business_unit',
  ),
), null, null, 'SpyShoppingListCompanyBusinessUnits', false);
        $this->addRelation('SpySspAsset', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspAsset', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company_business_unit',
    1 => ':id_company_business_unit',
  ),
), null, null, 'SpySspAssets', false);
        $this->addRelation('SpySspAssetToCompanyBusinessUnit', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspAssetToCompanyBusinessUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_company_business_unit',
    1 => ':id_company_business_unit',
  ),
), null, null, 'SpySspAssetToCompanyBusinessUnits', false);
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_company_business_unit.fk_company'],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_company_business_unit     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyCompanyUnitAddressToCompanyBusinessUnitTableMap::clearInstancePool();
        SpyCompanyUserTableMap::clearInstancePool();
        SpyMerchantRelationRequestTableMap::clearInstancePool();
        SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::clearInstancePool();
        SpyMerchantRelationshipTableMap::clearInstancePool();
        SpyMerchantRelationshipToCompanyBusinessUnitTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCompanyBusinessUnitTableMap::CLASS_DEFAULT : SpyCompanyBusinessUnitTableMap::OM_CLASS;
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
     * @return array (SpyCompanyBusinessUnit object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCompanyBusinessUnitTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCompanyBusinessUnitTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCompanyBusinessUnitTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCompanyBusinessUnitTableMap::OM_CLASS;
            /** @var SpyCompanyBusinessUnit $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCompanyBusinessUnitTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCompanyBusinessUnitTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCompanyBusinessUnitTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCompanyBusinessUnit $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCompanyBusinessUnitTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT);
            $criteria->addSelectColumn(SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY);
            $criteria->addSelectColumn(SpyCompanyBusinessUnitTableMap::COL_FK_PARENT_COMPANY_BUSINESS_UNIT);
            $criteria->addSelectColumn(SpyCompanyBusinessUnitTableMap::COL_BIC);
            $criteria->addSelectColumn(SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS);
            $criteria->addSelectColumn(SpyCompanyBusinessUnitTableMap::COL_EMAIL);
            $criteria->addSelectColumn(SpyCompanyBusinessUnitTableMap::COL_EXTERNAL_URL);
            $criteria->addSelectColumn(SpyCompanyBusinessUnitTableMap::COL_IBAN);
            $criteria->addSelectColumn(SpyCompanyBusinessUnitTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyCompanyBusinessUnitTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyCompanyBusinessUnitTableMap::COL_PHONE);
            $criteria->addSelectColumn(SpyCompanyBusinessUnitTableMap::COL_UUID);
        } else {
            $criteria->addSelectColumn($alias . '.id_company_business_unit');
            $criteria->addSelectColumn($alias . '.fk_company');
            $criteria->addSelectColumn($alias . '.fk_parent_company_business_unit');
            $criteria->addSelectColumn($alias . '.bic');
            $criteria->addSelectColumn($alias . '.default_billing_address');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.external_url');
            $criteria->addSelectColumn($alias . '.iban');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.uuid');
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
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT);
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitTableMap::COL_FK_COMPANY);
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitTableMap::COL_FK_PARENT_COMPANY_BUSINESS_UNIT);
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitTableMap::COL_BIC);
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS);
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitTableMap::COL_EXTERNAL_URL);
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitTableMap::COL_IBAN);
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitTableMap::COL_PHONE);
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitTableMap::COL_UUID);
        } else {
            $criteria->removeSelectColumn($alias . '.id_company_business_unit');
            $criteria->removeSelectColumn($alias . '.fk_company');
            $criteria->removeSelectColumn($alias . '.fk_parent_company_business_unit');
            $criteria->removeSelectColumn($alias . '.bic');
            $criteria->removeSelectColumn($alias . '.default_billing_address');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.external_url');
            $criteria->removeSelectColumn($alias . '.iban');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.phone');
            $criteria->removeSelectColumn($alias . '.uuid');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCompanyBusinessUnitTableMap::DATABASE_NAME)->getTable(SpyCompanyBusinessUnitTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCompanyBusinessUnit or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCompanyBusinessUnit object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyBusinessUnitTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CompanyBusinessUnit\Persistence\SpyCompanyBusinessUnit) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCompanyBusinessUnitTableMap::DATABASE_NAME);
            $criteria->add(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT, (array) $values, Criteria::IN);
        }

        $query = SpyCompanyBusinessUnitQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCompanyBusinessUnitTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCompanyBusinessUnitTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_company_business_unit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCompanyBusinessUnitQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCompanyBusinessUnit or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCompanyBusinessUnit object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyBusinessUnitTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCompanyBusinessUnit object
        }

        if ($criteria->containsKey(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT) && $criteria->keyContainsValue(SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCompanyBusinessUnitTableMap::COL_ID_COMPANY_BUSINESS_UNIT.')');
        }


        // Set the correct dbName
        $query = SpyCompanyBusinessUnitQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
