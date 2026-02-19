<?php

namespace Orm\Zed\Merchant\Persistence\Map;

use Orm\Zed\MerchantOpeningHours\Persistence\Map\SpyMerchantOpeningHoursDateScheduleTableMap;
use Orm\Zed\MerchantOpeningHours\Persistence\Map\SpyMerchantOpeningHoursWeekdayScheduleTableMap;
use Orm\Zed\MerchantProduct\Persistence\Map\SpyMerchantProductAbstractTableMap;
use Orm\Zed\MerchantRelationRequest\Persistence\Map\SpyMerchantRelationRequestTableMap;
use Orm\Zed\MerchantRelationship\Persistence\Map\SpyMerchantRelationshipTableMap;
use Orm\Zed\MerchantStock\Persistence\Map\SpyMerchantStockTableMap;
use Orm\Zed\Merchant\Persistence\SpyMerchant;
use Orm\Zed\Merchant\Persistence\SpyMerchantQuery;
use Orm\Zed\Url\Persistence\Map\SpyUrlTableMap;
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
 * This class defines the structure of the 'spy_merchant' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyMerchantTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Merchant.Persistence.Map.SpyMerchantTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_merchant';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyMerchant';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Merchant\\Persistence\\SpyMerchant';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Merchant.Persistence.SpyMerchant';

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
     * the column name for the id_merchant field
     */
    public const COL_ID_MERCHANT = 'spy_merchant.id_merchant';

    /**
     * the column name for the fk_state_machine_process field
     */
    public const COL_FK_STATE_MACHINE_PROCESS = 'spy_merchant.fk_state_machine_process';

    /**
     * the column name for the default_product_abstract_approval_status field
     */
    public const COL_DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS = 'spy_merchant.default_product_abstract_approval_status';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'spy_merchant.email';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_merchant.is_active';

    /**
     * the column name for the is_open_for_relation_request field
     */
    public const COL_IS_OPEN_FOR_RELATION_REQUEST = 'spy_merchant.is_open_for_relation_request';

    /**
     * the column name for the merchant_reference field
     */
    public const COL_MERCHANT_REFERENCE = 'spy_merchant.merchant_reference';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_merchant.name';

    /**
     * the column name for the registration_number field
     */
    public const COL_REGISTRATION_NUMBER = 'spy_merchant.registration_number';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'spy_merchant.status';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_merchant.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_merchant.updated_at';

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
        self::TYPE_PHPNAME       => ['IdMerchant', 'FkStateMachineProcess', 'DefaultProductAbstractApprovalStatus', 'Email', 'IsActive', 'IsOpenForRelationRequest', 'MerchantReference', 'Name', 'RegistrationNumber', 'Status', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idMerchant', 'fkStateMachineProcess', 'defaultProductAbstractApprovalStatus', 'email', 'isActive', 'isOpenForRelationRequest', 'merchantReference', 'name', 'registrationNumber', 'status', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyMerchantTableMap::COL_ID_MERCHANT, SpyMerchantTableMap::COL_FK_STATE_MACHINE_PROCESS, SpyMerchantTableMap::COL_DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS, SpyMerchantTableMap::COL_EMAIL, SpyMerchantTableMap::COL_IS_ACTIVE, SpyMerchantTableMap::COL_IS_OPEN_FOR_RELATION_REQUEST, SpyMerchantTableMap::COL_MERCHANT_REFERENCE, SpyMerchantTableMap::COL_NAME, SpyMerchantTableMap::COL_REGISTRATION_NUMBER, SpyMerchantTableMap::COL_STATUS, SpyMerchantTableMap::COL_CREATED_AT, SpyMerchantTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_merchant', 'fk_state_machine_process', 'default_product_abstract_approval_status', 'email', 'is_active', 'is_open_for_relation_request', 'merchant_reference', 'name', 'registration_number', 'status', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdMerchant' => 0, 'FkStateMachineProcess' => 1, 'DefaultProductAbstractApprovalStatus' => 2, 'Email' => 3, 'IsActive' => 4, 'IsOpenForRelationRequest' => 5, 'MerchantReference' => 6, 'Name' => 7, 'RegistrationNumber' => 8, 'Status' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ],
        self::TYPE_CAMELNAME     => ['idMerchant' => 0, 'fkStateMachineProcess' => 1, 'defaultProductAbstractApprovalStatus' => 2, 'email' => 3, 'isActive' => 4, 'isOpenForRelationRequest' => 5, 'merchantReference' => 6, 'name' => 7, 'registrationNumber' => 8, 'status' => 9, 'createdAt' => 10, 'updatedAt' => 11, ],
        self::TYPE_COLNAME       => [SpyMerchantTableMap::COL_ID_MERCHANT => 0, SpyMerchantTableMap::COL_FK_STATE_MACHINE_PROCESS => 1, SpyMerchantTableMap::COL_DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS => 2, SpyMerchantTableMap::COL_EMAIL => 3, SpyMerchantTableMap::COL_IS_ACTIVE => 4, SpyMerchantTableMap::COL_IS_OPEN_FOR_RELATION_REQUEST => 5, SpyMerchantTableMap::COL_MERCHANT_REFERENCE => 6, SpyMerchantTableMap::COL_NAME => 7, SpyMerchantTableMap::COL_REGISTRATION_NUMBER => 8, SpyMerchantTableMap::COL_STATUS => 9, SpyMerchantTableMap::COL_CREATED_AT => 10, SpyMerchantTableMap::COL_UPDATED_AT => 11, ],
        self::TYPE_FIELDNAME     => ['id_merchant' => 0, 'fk_state_machine_process' => 1, 'default_product_abstract_approval_status' => 2, 'email' => 3, 'is_active' => 4, 'is_open_for_relation_request' => 5, 'merchant_reference' => 6, 'name' => 7, 'registration_number' => 8, 'status' => 9, 'created_at' => 10, 'updated_at' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdMerchant' => 'ID_MERCHANT',
        'SpyMerchant.IdMerchant' => 'ID_MERCHANT',
        'idMerchant' => 'ID_MERCHANT',
        'spyMerchant.idMerchant' => 'ID_MERCHANT',
        'SpyMerchantTableMap::COL_ID_MERCHANT' => 'ID_MERCHANT',
        'COL_ID_MERCHANT' => 'ID_MERCHANT',
        'id_merchant' => 'ID_MERCHANT',
        'spy_merchant.id_merchant' => 'ID_MERCHANT',
        'FkStateMachineProcess' => 'FK_STATE_MACHINE_PROCESS',
        'SpyMerchant.FkStateMachineProcess' => 'FK_STATE_MACHINE_PROCESS',
        'fkStateMachineProcess' => 'FK_STATE_MACHINE_PROCESS',
        'spyMerchant.fkStateMachineProcess' => 'FK_STATE_MACHINE_PROCESS',
        'SpyMerchantTableMap::COL_FK_STATE_MACHINE_PROCESS' => 'FK_STATE_MACHINE_PROCESS',
        'COL_FK_STATE_MACHINE_PROCESS' => 'FK_STATE_MACHINE_PROCESS',
        'fk_state_machine_process' => 'FK_STATE_MACHINE_PROCESS',
        'spy_merchant.fk_state_machine_process' => 'FK_STATE_MACHINE_PROCESS',
        'DefaultProductAbstractApprovalStatus' => 'DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS',
        'SpyMerchant.DefaultProductAbstractApprovalStatus' => 'DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS',
        'defaultProductAbstractApprovalStatus' => 'DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS',
        'spyMerchant.defaultProductAbstractApprovalStatus' => 'DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS',
        'SpyMerchantTableMap::COL_DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS' => 'DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS',
        'COL_DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS' => 'DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS',
        'default_product_abstract_approval_status' => 'DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS',
        'spy_merchant.default_product_abstract_approval_status' => 'DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS',
        'Email' => 'EMAIL',
        'SpyMerchant.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'spyMerchant.email' => 'EMAIL',
        'SpyMerchantTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'spy_merchant.email' => 'EMAIL',
        'IsActive' => 'IS_ACTIVE',
        'SpyMerchant.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyMerchant.isActive' => 'IS_ACTIVE',
        'SpyMerchantTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_merchant.is_active' => 'IS_ACTIVE',
        'IsOpenForRelationRequest' => 'IS_OPEN_FOR_RELATION_REQUEST',
        'SpyMerchant.IsOpenForRelationRequest' => 'IS_OPEN_FOR_RELATION_REQUEST',
        'isOpenForRelationRequest' => 'IS_OPEN_FOR_RELATION_REQUEST',
        'spyMerchant.isOpenForRelationRequest' => 'IS_OPEN_FOR_RELATION_REQUEST',
        'SpyMerchantTableMap::COL_IS_OPEN_FOR_RELATION_REQUEST' => 'IS_OPEN_FOR_RELATION_REQUEST',
        'COL_IS_OPEN_FOR_RELATION_REQUEST' => 'IS_OPEN_FOR_RELATION_REQUEST',
        'is_open_for_relation_request' => 'IS_OPEN_FOR_RELATION_REQUEST',
        'spy_merchant.is_open_for_relation_request' => 'IS_OPEN_FOR_RELATION_REQUEST',
        'MerchantReference' => 'MERCHANT_REFERENCE',
        'SpyMerchant.MerchantReference' => 'MERCHANT_REFERENCE',
        'merchantReference' => 'MERCHANT_REFERENCE',
        'spyMerchant.merchantReference' => 'MERCHANT_REFERENCE',
        'SpyMerchantTableMap::COL_MERCHANT_REFERENCE' => 'MERCHANT_REFERENCE',
        'COL_MERCHANT_REFERENCE' => 'MERCHANT_REFERENCE',
        'merchant_reference' => 'MERCHANT_REFERENCE',
        'spy_merchant.merchant_reference' => 'MERCHANT_REFERENCE',
        'Name' => 'NAME',
        'SpyMerchant.Name' => 'NAME',
        'name' => 'NAME',
        'spyMerchant.name' => 'NAME',
        'SpyMerchantTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_merchant.name' => 'NAME',
        'RegistrationNumber' => 'REGISTRATION_NUMBER',
        'SpyMerchant.RegistrationNumber' => 'REGISTRATION_NUMBER',
        'registrationNumber' => 'REGISTRATION_NUMBER',
        'spyMerchant.registrationNumber' => 'REGISTRATION_NUMBER',
        'SpyMerchantTableMap::COL_REGISTRATION_NUMBER' => 'REGISTRATION_NUMBER',
        'COL_REGISTRATION_NUMBER' => 'REGISTRATION_NUMBER',
        'registration_number' => 'REGISTRATION_NUMBER',
        'spy_merchant.registration_number' => 'REGISTRATION_NUMBER',
        'Status' => 'STATUS',
        'SpyMerchant.Status' => 'STATUS',
        'status' => 'STATUS',
        'spyMerchant.status' => 'STATUS',
        'SpyMerchantTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'spy_merchant.status' => 'STATUS',
        'CreatedAt' => 'CREATED_AT',
        'SpyMerchant.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyMerchant.createdAt' => 'CREATED_AT',
        'SpyMerchantTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_merchant.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyMerchant.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyMerchant.updatedAt' => 'UPDATED_AT',
        'SpyMerchantTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_merchant.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_merchant');
        $this->setPhpName('SpyMerchant');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Merchant\\Persistence\\SpyMerchant');
        $this->setPackage('src.Orm.Zed.Merchant.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_merchant_pk_seq');
        // columns
        $this->addPrimaryKey('id_merchant', 'IdMerchant', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_state_machine_process', 'FkStateMachineProcess', 'INTEGER', 'spy_state_machine_process', 'id_state_machine_process', false, null, null);
        $this->addColumn('default_product_abstract_approval_status', 'DefaultProductAbstractApprovalStatus', 'VARCHAR', false, 64, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 255, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', false, 1, false);
        $this->addColumn('is_open_for_relation_request', 'IsOpenForRelationRequest', 'BOOLEAN', false, 1, null);
        $this->addColumn('merchant_reference', 'MerchantReference', 'VARCHAR', true, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('registration_number', 'RegistrationNumber', 'VARCHAR', false, 255, null);
        $this->addColumn('status', 'Status', 'VARCHAR', true, 64, null);
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
        $this->addRelation('SpyStateMachineProcess', '\\Orm\\Zed\\StateMachine\\Persistence\\SpyStateMachineProcess', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_state_machine_process',
    1 => ':id_state_machine_process',
  ),
), null, null, null, false);
        $this->addRelation('PyzMerchantToSupplier', '\\Orm\\Zed\\Supplier\\Persistence\\PyzMerchantToSupplier', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant',
    1 => ':id_merchant',
  ),
), null, null, 'PyzMerchantToSuppliers', false);
        $this->addRelation('SpyMerchantStore', '\\Orm\\Zed\\Merchant\\Persistence\\SpyMerchantStore', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant',
    1 => ':id_merchant',
  ),
), null, null, 'SpyMerchantStores', false);
        $this->addRelation('SpyMerchantAppOnboardingStatus', '\\Orm\\Zed\\MerchantApp\\Persistence\\SpyMerchantAppOnboardingStatus', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':merchant_reference',
    1 => ':merchant_reference',
  ),
), null, null, 'SpyMerchantAppOnboardingStatuses', false);
        $this->addRelation('SpyMerchantCategory', '\\Orm\\Zed\\MerchantCategory\\Persistence\\SpyMerchantCategory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant',
    1 => ':id_merchant',
  ),
), null, null, 'SpyMerchantCategories', false);
        $this->addRelation('MerchantCommission', '\\Orm\\Zed\\MerchantCommission\\Persistence\\SpyMerchantCommissionMerchant', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant',
    1 => ':id_merchant',
  ),
), null, null, 'MerchantCommissions', false);
        $this->addRelation('SpyMerchantOpeningHoursWeekdaySchedule', '\\Orm\\Zed\\MerchantOpeningHours\\Persistence\\SpyMerchantOpeningHoursWeekdaySchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant',
    1 => ':id_merchant',
  ),
), 'CASCADE', null, 'SpyMerchantOpeningHoursWeekdaySchedules', false);
        $this->addRelation('SpyMerchantOpeningHoursDateSchedule', '\\Orm\\Zed\\MerchantOpeningHours\\Persistence\\SpyMerchantOpeningHoursDateSchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant',
    1 => ':id_merchant',
  ),
), 'CASCADE', null, 'SpyMerchantOpeningHoursDateSchedules', false);
        $this->addRelation('SpyMerchantProductAbstract', '\\Orm\\Zed\\MerchantProduct\\Persistence\\SpyMerchantProductAbstract', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant',
    1 => ':id_merchant',
  ),
), 'CASCADE', null, 'SpyMerchantProductAbstracts', false);
        $this->addRelation('SpyMerchantProfile', '\\Orm\\Zed\\MerchantProfile\\Persistence\\SpyMerchantProfile', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant',
    1 => ':id_merchant',
  ),
), null, null, 'SpyMerchantProfiles', false);
        $this->addRelation('SpyMerchantRelationRequest', '\\Orm\\Zed\\MerchantRelationRequest\\Persistence\\SpyMerchantRelationRequest', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant',
    1 => ':id_merchant',
  ),
), 'CASCADE', null, 'SpyMerchantRelationRequests', false);
        $this->addRelation('SpyMerchantRelationship', '\\Orm\\Zed\\MerchantRelationship\\Persistence\\SpyMerchantRelationship', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant',
    1 => ':id_merchant',
  ),
), 'CASCADE', null, 'SpyMerchantRelationships', false);
        $this->addRelation('SpyMerchantStock', '\\Orm\\Zed\\MerchantStock\\Persistence\\SpyMerchantStock', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant',
    1 => ':id_merchant',
  ),
), 'CASCADE', null, 'SpyMerchantStocks', false);
        $this->addRelation('SpyMerchantUser', '\\Orm\\Zed\\MerchantUser\\Persistence\\SpyMerchantUser', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant',
    1 => ':id_merchant',
  ),
), null, null, 'SpyMerchantUsers', false);
        $this->addRelation('ProductOffer', '\\Orm\\Zed\\ProductOffer\\Persistence\\SpyProductOffer', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':merchant_reference',
    1 => ':merchant_reference',
  ),
), null, null, 'ProductOffers', false);
        $this->addRelation('SpySalesPaymentMerchantPayout', '\\Orm\\Zed\\SalesPaymentMerchant\\Persistence\\SpySalesPaymentMerchantPayout', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':merchant_reference',
    1 => ':merchant_reference',
  ),
), null, null, 'SpySalesPaymentMerchantPayouts', false);
        $this->addRelation('SpySalesPaymentMerchantPayoutReversal', '\\Orm\\Zed\\SalesPaymentMerchant\\Persistence\\SpySalesPaymentMerchantPayoutReversal', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':merchant_reference',
    1 => ':merchant_reference',
  ),
), null, null, 'SpySalesPaymentMerchantPayoutReversals', false);
        $this->addRelation('SpyUrl', '\\Orm\\Zed\\Url\\Persistence\\SpyUrl', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_resource_merchant',
    1 => ':id_merchant',
  ),
), 'CASCADE', null, 'SpyUrls', false);
        $this->addRelation('SpyAclEntitySegmentMerchant', '\\Orm\\Zed\\Merchant\\Persistence\\SpyAclEntitySegmentMerchant', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant',
    1 => ':id_merchant',
  ),
), 'CASCADE', null, 'SpyAclEntitySegmentMerchants', false);
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
            'event' => ['spy_merchant-name' => ['column' => 'name'], 'spy_merchant-is_active' => ['column' => 'is_active']],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_merchant     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyMerchantOpeningHoursWeekdayScheduleTableMap::clearInstancePool();
        SpyMerchantOpeningHoursDateScheduleTableMap::clearInstancePool();
        SpyMerchantProductAbstractTableMap::clearInstancePool();
        SpyMerchantRelationRequestTableMap::clearInstancePool();
        SpyMerchantRelationshipTableMap::clearInstancePool();
        SpyMerchantStockTableMap::clearInstancePool();
        SpyUrlTableMap::clearInstancePool();
        SpyAclEntitySegmentMerchantTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchant', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchant', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchant', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchant', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchant', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchant', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdMerchant', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyMerchantTableMap::CLASS_DEFAULT : SpyMerchantTableMap::OM_CLASS;
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
     * @return array (SpyMerchant object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyMerchantTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyMerchantTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyMerchantTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyMerchantTableMap::OM_CLASS;
            /** @var SpyMerchant $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyMerchantTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyMerchantTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyMerchantTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyMerchant $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyMerchantTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyMerchantTableMap::COL_ID_MERCHANT);
            $criteria->addSelectColumn(SpyMerchantTableMap::COL_FK_STATE_MACHINE_PROCESS);
            $criteria->addSelectColumn(SpyMerchantTableMap::COL_DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS);
            $criteria->addSelectColumn(SpyMerchantTableMap::COL_EMAIL);
            $criteria->addSelectColumn(SpyMerchantTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyMerchantTableMap::COL_IS_OPEN_FOR_RELATION_REQUEST);
            $criteria->addSelectColumn(SpyMerchantTableMap::COL_MERCHANT_REFERENCE);
            $criteria->addSelectColumn(SpyMerchantTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyMerchantTableMap::COL_REGISTRATION_NUMBER);
            $criteria->addSelectColumn(SpyMerchantTableMap::COL_STATUS);
            $criteria->addSelectColumn(SpyMerchantTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyMerchantTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_merchant');
            $criteria->addSelectColumn($alias . '.fk_state_machine_process');
            $criteria->addSelectColumn($alias . '.default_product_abstract_approval_status');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.is_open_for_relation_request');
            $criteria->addSelectColumn($alias . '.merchant_reference');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.registration_number');
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
            $criteria->removeSelectColumn(SpyMerchantTableMap::COL_ID_MERCHANT);
            $criteria->removeSelectColumn(SpyMerchantTableMap::COL_FK_STATE_MACHINE_PROCESS);
            $criteria->removeSelectColumn(SpyMerchantTableMap::COL_DEFAULT_PRODUCT_ABSTRACT_APPROVAL_STATUS);
            $criteria->removeSelectColumn(SpyMerchantTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(SpyMerchantTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyMerchantTableMap::COL_IS_OPEN_FOR_RELATION_REQUEST);
            $criteria->removeSelectColumn(SpyMerchantTableMap::COL_MERCHANT_REFERENCE);
            $criteria->removeSelectColumn(SpyMerchantTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyMerchantTableMap::COL_REGISTRATION_NUMBER);
            $criteria->removeSelectColumn(SpyMerchantTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SpyMerchantTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyMerchantTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_merchant');
            $criteria->removeSelectColumn($alias . '.fk_state_machine_process');
            $criteria->removeSelectColumn($alias . '.default_product_abstract_approval_status');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.is_open_for_relation_request');
            $criteria->removeSelectColumn($alias . '.merchant_reference');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.registration_number');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyMerchantTableMap::DATABASE_NAME)->getTable(SpyMerchantTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyMerchant or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyMerchant object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Merchant\Persistence\SpyMerchant) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyMerchantTableMap::DATABASE_NAME);
            $criteria->add(SpyMerchantTableMap::COL_ID_MERCHANT, (array) $values, Criteria::IN);
        }

        $query = SpyMerchantQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyMerchantTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyMerchantTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_merchant table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyMerchantQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyMerchant or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyMerchant object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyMerchant object
        }

        if ($criteria->containsKey(SpyMerchantTableMap::COL_ID_MERCHANT) && $criteria->keyContainsValue(SpyMerchantTableMap::COL_ID_MERCHANT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyMerchantTableMap::COL_ID_MERCHANT.')');
        }


        // Set the correct dbName
        $query = SpyMerchantQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
