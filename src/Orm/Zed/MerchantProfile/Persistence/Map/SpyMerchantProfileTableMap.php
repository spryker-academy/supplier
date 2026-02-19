<?php

namespace Orm\Zed\MerchantProfile\Persistence\Map;

use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile;
use Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfileQuery;
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
 * This class defines the structure of the 'spy_merchant_profile' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyMerchantProfileTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MerchantProfile.Persistence.Map.SpyMerchantProfileTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_merchant_profile';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyMerchantProfile';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MerchantProfile\\Persistence\\SpyMerchantProfile';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MerchantProfile.Persistence.SpyMerchantProfile';

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
     * the column name for the id_merchant_profile field
     */
    public const COL_ID_MERCHANT_PROFILE = 'spy_merchant_profile.id_merchant_profile';

    /**
     * the column name for the contact_person_role field
     */
    public const COL_CONTACT_PERSON_ROLE = 'spy_merchant_profile.contact_person_role';

    /**
     * the column name for the contact_person_title field
     */
    public const COL_CONTACT_PERSON_TITLE = 'spy_merchant_profile.contact_person_title';

    /**
     * the column name for the contact_person_first_name field
     */
    public const COL_CONTACT_PERSON_FIRST_NAME = 'spy_merchant_profile.contact_person_first_name';

    /**
     * the column name for the contact_person_last_name field
     */
    public const COL_CONTACT_PERSON_LAST_NAME = 'spy_merchant_profile.contact_person_last_name';

    /**
     * the column name for the contact_person_phone field
     */
    public const COL_CONTACT_PERSON_PHONE = 'spy_merchant_profile.contact_person_phone';

    /**
     * the column name for the logo_url field
     */
    public const COL_LOGO_URL = 'spy_merchant_profile.logo_url';

    /**
     * the column name for the public_email field
     */
    public const COL_PUBLIC_EMAIL = 'spy_merchant_profile.public_email';

    /**
     * the column name for the public_phone field
     */
    public const COL_PUBLIC_PHONE = 'spy_merchant_profile.public_phone';

    /**
     * the column name for the fax_number field
     */
    public const COL_FAX_NUMBER = 'spy_merchant_profile.fax_number';

    /**
     * the column name for the description_glossary_key field
     */
    public const COL_DESCRIPTION_GLOSSARY_KEY = 'spy_merchant_profile.description_glossary_key';

    /**
     * the column name for the banner_url_glossary_key field
     */
    public const COL_BANNER_URL_GLOSSARY_KEY = 'spy_merchant_profile.banner_url_glossary_key';

    /**
     * the column name for the delivery_time_glossary_key field
     */
    public const COL_DELIVERY_TIME_GLOSSARY_KEY = 'spy_merchant_profile.delivery_time_glossary_key';

    /**
     * the column name for the terms_conditions_glossary_key field
     */
    public const COL_TERMS_CONDITIONS_GLOSSARY_KEY = 'spy_merchant_profile.terms_conditions_glossary_key';

    /**
     * the column name for the cancellation_policy_glossary_key field
     */
    public const COL_CANCELLATION_POLICY_GLOSSARY_KEY = 'spy_merchant_profile.cancellation_policy_glossary_key';

    /**
     * the column name for the imprint_glossary_key field
     */
    public const COL_IMPRINT_GLOSSARY_KEY = 'spy_merchant_profile.imprint_glossary_key';

    /**
     * the column name for the data_privacy_glossary_key field
     */
    public const COL_DATA_PRIVACY_GLOSSARY_KEY = 'spy_merchant_profile.data_privacy_glossary_key';

    /**
     * the column name for the fk_merchant field
     */
    public const COL_FK_MERCHANT = 'spy_merchant_profile.fk_merchant';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the contact_person_title field */
    public const COL_CONTACT_PERSON_TITLE_MR = 'Mr';
    public const COL_CONTACT_PERSON_TITLE_MRS = 'Mrs';
    public const COL_CONTACT_PERSON_TITLE_DR = 'Dr';
    public const COL_CONTACT_PERSON_TITLE_MS = 'Ms';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdMerchantProfile', 'ContactPersonRole', 'ContactPersonTitle', 'ContactPersonFirstName', 'ContactPersonLastName', 'ContactPersonPhone', 'LogoUrl', 'PublicEmail', 'PublicPhone', 'FaxNumber', 'DescriptionGlossaryKey', 'BannerUrlGlossaryKey', 'DeliveryTimeGlossaryKey', 'TermsConditionsGlossaryKey', 'CancellationPolicyGlossaryKey', 'ImprintGlossaryKey', 'DataPrivacyGlossaryKey', 'FkMerchant', ],
        self::TYPE_CAMELNAME     => ['idMerchantProfile', 'contactPersonRole', 'contactPersonTitle', 'contactPersonFirstName', 'contactPersonLastName', 'contactPersonPhone', 'logoUrl', 'publicEmail', 'publicPhone', 'faxNumber', 'descriptionGlossaryKey', 'bannerUrlGlossaryKey', 'deliveryTimeGlossaryKey', 'termsConditionsGlossaryKey', 'cancellationPolicyGlossaryKey', 'imprintGlossaryKey', 'dataPrivacyGlossaryKey', 'fkMerchant', ],
        self::TYPE_COLNAME       => [SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE, SpyMerchantProfileTableMap::COL_CONTACT_PERSON_ROLE, SpyMerchantProfileTableMap::COL_CONTACT_PERSON_TITLE, SpyMerchantProfileTableMap::COL_CONTACT_PERSON_FIRST_NAME, SpyMerchantProfileTableMap::COL_CONTACT_PERSON_LAST_NAME, SpyMerchantProfileTableMap::COL_CONTACT_PERSON_PHONE, SpyMerchantProfileTableMap::COL_LOGO_URL, SpyMerchantProfileTableMap::COL_PUBLIC_EMAIL, SpyMerchantProfileTableMap::COL_PUBLIC_PHONE, SpyMerchantProfileTableMap::COL_FAX_NUMBER, SpyMerchantProfileTableMap::COL_DESCRIPTION_GLOSSARY_KEY, SpyMerchantProfileTableMap::COL_BANNER_URL_GLOSSARY_KEY, SpyMerchantProfileTableMap::COL_DELIVERY_TIME_GLOSSARY_KEY, SpyMerchantProfileTableMap::COL_TERMS_CONDITIONS_GLOSSARY_KEY, SpyMerchantProfileTableMap::COL_CANCELLATION_POLICY_GLOSSARY_KEY, SpyMerchantProfileTableMap::COL_IMPRINT_GLOSSARY_KEY, SpyMerchantProfileTableMap::COL_DATA_PRIVACY_GLOSSARY_KEY, SpyMerchantProfileTableMap::COL_FK_MERCHANT, ],
        self::TYPE_FIELDNAME     => ['id_merchant_profile', 'contact_person_role', 'contact_person_title', 'contact_person_first_name', 'contact_person_last_name', 'contact_person_phone', 'logo_url', 'public_email', 'public_phone', 'fax_number', 'description_glossary_key', 'banner_url_glossary_key', 'delivery_time_glossary_key', 'terms_conditions_glossary_key', 'cancellation_policy_glossary_key', 'imprint_glossary_key', 'data_privacy_glossary_key', 'fk_merchant', ],
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
        self::TYPE_PHPNAME       => ['IdMerchantProfile' => 0, 'ContactPersonRole' => 1, 'ContactPersonTitle' => 2, 'ContactPersonFirstName' => 3, 'ContactPersonLastName' => 4, 'ContactPersonPhone' => 5, 'LogoUrl' => 6, 'PublicEmail' => 7, 'PublicPhone' => 8, 'FaxNumber' => 9, 'DescriptionGlossaryKey' => 10, 'BannerUrlGlossaryKey' => 11, 'DeliveryTimeGlossaryKey' => 12, 'TermsConditionsGlossaryKey' => 13, 'CancellationPolicyGlossaryKey' => 14, 'ImprintGlossaryKey' => 15, 'DataPrivacyGlossaryKey' => 16, 'FkMerchant' => 17, ],
        self::TYPE_CAMELNAME     => ['idMerchantProfile' => 0, 'contactPersonRole' => 1, 'contactPersonTitle' => 2, 'contactPersonFirstName' => 3, 'contactPersonLastName' => 4, 'contactPersonPhone' => 5, 'logoUrl' => 6, 'publicEmail' => 7, 'publicPhone' => 8, 'faxNumber' => 9, 'descriptionGlossaryKey' => 10, 'bannerUrlGlossaryKey' => 11, 'deliveryTimeGlossaryKey' => 12, 'termsConditionsGlossaryKey' => 13, 'cancellationPolicyGlossaryKey' => 14, 'imprintGlossaryKey' => 15, 'dataPrivacyGlossaryKey' => 16, 'fkMerchant' => 17, ],
        self::TYPE_COLNAME       => [SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE => 0, SpyMerchantProfileTableMap::COL_CONTACT_PERSON_ROLE => 1, SpyMerchantProfileTableMap::COL_CONTACT_PERSON_TITLE => 2, SpyMerchantProfileTableMap::COL_CONTACT_PERSON_FIRST_NAME => 3, SpyMerchantProfileTableMap::COL_CONTACT_PERSON_LAST_NAME => 4, SpyMerchantProfileTableMap::COL_CONTACT_PERSON_PHONE => 5, SpyMerchantProfileTableMap::COL_LOGO_URL => 6, SpyMerchantProfileTableMap::COL_PUBLIC_EMAIL => 7, SpyMerchantProfileTableMap::COL_PUBLIC_PHONE => 8, SpyMerchantProfileTableMap::COL_FAX_NUMBER => 9, SpyMerchantProfileTableMap::COL_DESCRIPTION_GLOSSARY_KEY => 10, SpyMerchantProfileTableMap::COL_BANNER_URL_GLOSSARY_KEY => 11, SpyMerchantProfileTableMap::COL_DELIVERY_TIME_GLOSSARY_KEY => 12, SpyMerchantProfileTableMap::COL_TERMS_CONDITIONS_GLOSSARY_KEY => 13, SpyMerchantProfileTableMap::COL_CANCELLATION_POLICY_GLOSSARY_KEY => 14, SpyMerchantProfileTableMap::COL_IMPRINT_GLOSSARY_KEY => 15, SpyMerchantProfileTableMap::COL_DATA_PRIVACY_GLOSSARY_KEY => 16, SpyMerchantProfileTableMap::COL_FK_MERCHANT => 17, ],
        self::TYPE_FIELDNAME     => ['id_merchant_profile' => 0, 'contact_person_role' => 1, 'contact_person_title' => 2, 'contact_person_first_name' => 3, 'contact_person_last_name' => 4, 'contact_person_phone' => 5, 'logo_url' => 6, 'public_email' => 7, 'public_phone' => 8, 'fax_number' => 9, 'description_glossary_key' => 10, 'banner_url_glossary_key' => 11, 'delivery_time_glossary_key' => 12, 'terms_conditions_glossary_key' => 13, 'cancellation_policy_glossary_key' => 14, 'imprint_glossary_key' => 15, 'data_privacy_glossary_key' => 16, 'fk_merchant' => 17, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdMerchantProfile' => 'ID_MERCHANT_PROFILE',
        'SpyMerchantProfile.IdMerchantProfile' => 'ID_MERCHANT_PROFILE',
        'idMerchantProfile' => 'ID_MERCHANT_PROFILE',
        'spyMerchantProfile.idMerchantProfile' => 'ID_MERCHANT_PROFILE',
        'SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE' => 'ID_MERCHANT_PROFILE',
        'COL_ID_MERCHANT_PROFILE' => 'ID_MERCHANT_PROFILE',
        'id_merchant_profile' => 'ID_MERCHANT_PROFILE',
        'spy_merchant_profile.id_merchant_profile' => 'ID_MERCHANT_PROFILE',
        'ContactPersonRole' => 'CONTACT_PERSON_ROLE',
        'SpyMerchantProfile.ContactPersonRole' => 'CONTACT_PERSON_ROLE',
        'contactPersonRole' => 'CONTACT_PERSON_ROLE',
        'spyMerchantProfile.contactPersonRole' => 'CONTACT_PERSON_ROLE',
        'SpyMerchantProfileTableMap::COL_CONTACT_PERSON_ROLE' => 'CONTACT_PERSON_ROLE',
        'COL_CONTACT_PERSON_ROLE' => 'CONTACT_PERSON_ROLE',
        'contact_person_role' => 'CONTACT_PERSON_ROLE',
        'spy_merchant_profile.contact_person_role' => 'CONTACT_PERSON_ROLE',
        'ContactPersonTitle' => 'CONTACT_PERSON_TITLE',
        'SpyMerchantProfile.ContactPersonTitle' => 'CONTACT_PERSON_TITLE',
        'contactPersonTitle' => 'CONTACT_PERSON_TITLE',
        'spyMerchantProfile.contactPersonTitle' => 'CONTACT_PERSON_TITLE',
        'SpyMerchantProfileTableMap::COL_CONTACT_PERSON_TITLE' => 'CONTACT_PERSON_TITLE',
        'COL_CONTACT_PERSON_TITLE' => 'CONTACT_PERSON_TITLE',
        'contact_person_title' => 'CONTACT_PERSON_TITLE',
        'spy_merchant_profile.contact_person_title' => 'CONTACT_PERSON_TITLE',
        'ContactPersonFirstName' => 'CONTACT_PERSON_FIRST_NAME',
        'SpyMerchantProfile.ContactPersonFirstName' => 'CONTACT_PERSON_FIRST_NAME',
        'contactPersonFirstName' => 'CONTACT_PERSON_FIRST_NAME',
        'spyMerchantProfile.contactPersonFirstName' => 'CONTACT_PERSON_FIRST_NAME',
        'SpyMerchantProfileTableMap::COL_CONTACT_PERSON_FIRST_NAME' => 'CONTACT_PERSON_FIRST_NAME',
        'COL_CONTACT_PERSON_FIRST_NAME' => 'CONTACT_PERSON_FIRST_NAME',
        'contact_person_first_name' => 'CONTACT_PERSON_FIRST_NAME',
        'spy_merchant_profile.contact_person_first_name' => 'CONTACT_PERSON_FIRST_NAME',
        'ContactPersonLastName' => 'CONTACT_PERSON_LAST_NAME',
        'SpyMerchantProfile.ContactPersonLastName' => 'CONTACT_PERSON_LAST_NAME',
        'contactPersonLastName' => 'CONTACT_PERSON_LAST_NAME',
        'spyMerchantProfile.contactPersonLastName' => 'CONTACT_PERSON_LAST_NAME',
        'SpyMerchantProfileTableMap::COL_CONTACT_PERSON_LAST_NAME' => 'CONTACT_PERSON_LAST_NAME',
        'COL_CONTACT_PERSON_LAST_NAME' => 'CONTACT_PERSON_LAST_NAME',
        'contact_person_last_name' => 'CONTACT_PERSON_LAST_NAME',
        'spy_merchant_profile.contact_person_last_name' => 'CONTACT_PERSON_LAST_NAME',
        'ContactPersonPhone' => 'CONTACT_PERSON_PHONE',
        'SpyMerchantProfile.ContactPersonPhone' => 'CONTACT_PERSON_PHONE',
        'contactPersonPhone' => 'CONTACT_PERSON_PHONE',
        'spyMerchantProfile.contactPersonPhone' => 'CONTACT_PERSON_PHONE',
        'SpyMerchantProfileTableMap::COL_CONTACT_PERSON_PHONE' => 'CONTACT_PERSON_PHONE',
        'COL_CONTACT_PERSON_PHONE' => 'CONTACT_PERSON_PHONE',
        'contact_person_phone' => 'CONTACT_PERSON_PHONE',
        'spy_merchant_profile.contact_person_phone' => 'CONTACT_PERSON_PHONE',
        'LogoUrl' => 'LOGO_URL',
        'SpyMerchantProfile.LogoUrl' => 'LOGO_URL',
        'logoUrl' => 'LOGO_URL',
        'spyMerchantProfile.logoUrl' => 'LOGO_URL',
        'SpyMerchantProfileTableMap::COL_LOGO_URL' => 'LOGO_URL',
        'COL_LOGO_URL' => 'LOGO_URL',
        'logo_url' => 'LOGO_URL',
        'spy_merchant_profile.logo_url' => 'LOGO_URL',
        'PublicEmail' => 'PUBLIC_EMAIL',
        'SpyMerchantProfile.PublicEmail' => 'PUBLIC_EMAIL',
        'publicEmail' => 'PUBLIC_EMAIL',
        'spyMerchantProfile.publicEmail' => 'PUBLIC_EMAIL',
        'SpyMerchantProfileTableMap::COL_PUBLIC_EMAIL' => 'PUBLIC_EMAIL',
        'COL_PUBLIC_EMAIL' => 'PUBLIC_EMAIL',
        'public_email' => 'PUBLIC_EMAIL',
        'spy_merchant_profile.public_email' => 'PUBLIC_EMAIL',
        'PublicPhone' => 'PUBLIC_PHONE',
        'SpyMerchantProfile.PublicPhone' => 'PUBLIC_PHONE',
        'publicPhone' => 'PUBLIC_PHONE',
        'spyMerchantProfile.publicPhone' => 'PUBLIC_PHONE',
        'SpyMerchantProfileTableMap::COL_PUBLIC_PHONE' => 'PUBLIC_PHONE',
        'COL_PUBLIC_PHONE' => 'PUBLIC_PHONE',
        'public_phone' => 'PUBLIC_PHONE',
        'spy_merchant_profile.public_phone' => 'PUBLIC_PHONE',
        'FaxNumber' => 'FAX_NUMBER',
        'SpyMerchantProfile.FaxNumber' => 'FAX_NUMBER',
        'faxNumber' => 'FAX_NUMBER',
        'spyMerchantProfile.faxNumber' => 'FAX_NUMBER',
        'SpyMerchantProfileTableMap::COL_FAX_NUMBER' => 'FAX_NUMBER',
        'COL_FAX_NUMBER' => 'FAX_NUMBER',
        'fax_number' => 'FAX_NUMBER',
        'spy_merchant_profile.fax_number' => 'FAX_NUMBER',
        'DescriptionGlossaryKey' => 'DESCRIPTION_GLOSSARY_KEY',
        'SpyMerchantProfile.DescriptionGlossaryKey' => 'DESCRIPTION_GLOSSARY_KEY',
        'descriptionGlossaryKey' => 'DESCRIPTION_GLOSSARY_KEY',
        'spyMerchantProfile.descriptionGlossaryKey' => 'DESCRIPTION_GLOSSARY_KEY',
        'SpyMerchantProfileTableMap::COL_DESCRIPTION_GLOSSARY_KEY' => 'DESCRIPTION_GLOSSARY_KEY',
        'COL_DESCRIPTION_GLOSSARY_KEY' => 'DESCRIPTION_GLOSSARY_KEY',
        'description_glossary_key' => 'DESCRIPTION_GLOSSARY_KEY',
        'spy_merchant_profile.description_glossary_key' => 'DESCRIPTION_GLOSSARY_KEY',
        'BannerUrlGlossaryKey' => 'BANNER_URL_GLOSSARY_KEY',
        'SpyMerchantProfile.BannerUrlGlossaryKey' => 'BANNER_URL_GLOSSARY_KEY',
        'bannerUrlGlossaryKey' => 'BANNER_URL_GLOSSARY_KEY',
        'spyMerchantProfile.bannerUrlGlossaryKey' => 'BANNER_URL_GLOSSARY_KEY',
        'SpyMerchantProfileTableMap::COL_BANNER_URL_GLOSSARY_KEY' => 'BANNER_URL_GLOSSARY_KEY',
        'COL_BANNER_URL_GLOSSARY_KEY' => 'BANNER_URL_GLOSSARY_KEY',
        'banner_url_glossary_key' => 'BANNER_URL_GLOSSARY_KEY',
        'spy_merchant_profile.banner_url_glossary_key' => 'BANNER_URL_GLOSSARY_KEY',
        'DeliveryTimeGlossaryKey' => 'DELIVERY_TIME_GLOSSARY_KEY',
        'SpyMerchantProfile.DeliveryTimeGlossaryKey' => 'DELIVERY_TIME_GLOSSARY_KEY',
        'deliveryTimeGlossaryKey' => 'DELIVERY_TIME_GLOSSARY_KEY',
        'spyMerchantProfile.deliveryTimeGlossaryKey' => 'DELIVERY_TIME_GLOSSARY_KEY',
        'SpyMerchantProfileTableMap::COL_DELIVERY_TIME_GLOSSARY_KEY' => 'DELIVERY_TIME_GLOSSARY_KEY',
        'COL_DELIVERY_TIME_GLOSSARY_KEY' => 'DELIVERY_TIME_GLOSSARY_KEY',
        'delivery_time_glossary_key' => 'DELIVERY_TIME_GLOSSARY_KEY',
        'spy_merchant_profile.delivery_time_glossary_key' => 'DELIVERY_TIME_GLOSSARY_KEY',
        'TermsConditionsGlossaryKey' => 'TERMS_CONDITIONS_GLOSSARY_KEY',
        'SpyMerchantProfile.TermsConditionsGlossaryKey' => 'TERMS_CONDITIONS_GLOSSARY_KEY',
        'termsConditionsGlossaryKey' => 'TERMS_CONDITIONS_GLOSSARY_KEY',
        'spyMerchantProfile.termsConditionsGlossaryKey' => 'TERMS_CONDITIONS_GLOSSARY_KEY',
        'SpyMerchantProfileTableMap::COL_TERMS_CONDITIONS_GLOSSARY_KEY' => 'TERMS_CONDITIONS_GLOSSARY_KEY',
        'COL_TERMS_CONDITIONS_GLOSSARY_KEY' => 'TERMS_CONDITIONS_GLOSSARY_KEY',
        'terms_conditions_glossary_key' => 'TERMS_CONDITIONS_GLOSSARY_KEY',
        'spy_merchant_profile.terms_conditions_glossary_key' => 'TERMS_CONDITIONS_GLOSSARY_KEY',
        'CancellationPolicyGlossaryKey' => 'CANCELLATION_POLICY_GLOSSARY_KEY',
        'SpyMerchantProfile.CancellationPolicyGlossaryKey' => 'CANCELLATION_POLICY_GLOSSARY_KEY',
        'cancellationPolicyGlossaryKey' => 'CANCELLATION_POLICY_GLOSSARY_KEY',
        'spyMerchantProfile.cancellationPolicyGlossaryKey' => 'CANCELLATION_POLICY_GLOSSARY_KEY',
        'SpyMerchantProfileTableMap::COL_CANCELLATION_POLICY_GLOSSARY_KEY' => 'CANCELLATION_POLICY_GLOSSARY_KEY',
        'COL_CANCELLATION_POLICY_GLOSSARY_KEY' => 'CANCELLATION_POLICY_GLOSSARY_KEY',
        'cancellation_policy_glossary_key' => 'CANCELLATION_POLICY_GLOSSARY_KEY',
        'spy_merchant_profile.cancellation_policy_glossary_key' => 'CANCELLATION_POLICY_GLOSSARY_KEY',
        'ImprintGlossaryKey' => 'IMPRINT_GLOSSARY_KEY',
        'SpyMerchantProfile.ImprintGlossaryKey' => 'IMPRINT_GLOSSARY_KEY',
        'imprintGlossaryKey' => 'IMPRINT_GLOSSARY_KEY',
        'spyMerchantProfile.imprintGlossaryKey' => 'IMPRINT_GLOSSARY_KEY',
        'SpyMerchantProfileTableMap::COL_IMPRINT_GLOSSARY_KEY' => 'IMPRINT_GLOSSARY_KEY',
        'COL_IMPRINT_GLOSSARY_KEY' => 'IMPRINT_GLOSSARY_KEY',
        'imprint_glossary_key' => 'IMPRINT_GLOSSARY_KEY',
        'spy_merchant_profile.imprint_glossary_key' => 'IMPRINT_GLOSSARY_KEY',
        'DataPrivacyGlossaryKey' => 'DATA_PRIVACY_GLOSSARY_KEY',
        'SpyMerchantProfile.DataPrivacyGlossaryKey' => 'DATA_PRIVACY_GLOSSARY_KEY',
        'dataPrivacyGlossaryKey' => 'DATA_PRIVACY_GLOSSARY_KEY',
        'spyMerchantProfile.dataPrivacyGlossaryKey' => 'DATA_PRIVACY_GLOSSARY_KEY',
        'SpyMerchantProfileTableMap::COL_DATA_PRIVACY_GLOSSARY_KEY' => 'DATA_PRIVACY_GLOSSARY_KEY',
        'COL_DATA_PRIVACY_GLOSSARY_KEY' => 'DATA_PRIVACY_GLOSSARY_KEY',
        'data_privacy_glossary_key' => 'DATA_PRIVACY_GLOSSARY_KEY',
        'spy_merchant_profile.data_privacy_glossary_key' => 'DATA_PRIVACY_GLOSSARY_KEY',
        'FkMerchant' => 'FK_MERCHANT',
        'SpyMerchantProfile.FkMerchant' => 'FK_MERCHANT',
        'fkMerchant' => 'FK_MERCHANT',
        'spyMerchantProfile.fkMerchant' => 'FK_MERCHANT',
        'SpyMerchantProfileTableMap::COL_FK_MERCHANT' => 'FK_MERCHANT',
        'COL_FK_MERCHANT' => 'FK_MERCHANT',
        'fk_merchant' => 'FK_MERCHANT',
        'spy_merchant_profile.fk_merchant' => 'FK_MERCHANT',
    ];

    /**
     * The enumerated values for this table
     *
     * @var array<string, array<string>>
     */
    protected static $enumValueSets = [
                SpyMerchantProfileTableMap::COL_CONTACT_PERSON_TITLE => [
                            self::COL_CONTACT_PERSON_TITLE_MR,
            self::COL_CONTACT_PERSON_TITLE_MRS,
            self::COL_CONTACT_PERSON_TITLE_DR,
            self::COL_CONTACT_PERSON_TITLE_MS,
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
        $this->setName('spy_merchant_profile');
        $this->setPhpName('SpyMerchantProfile');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\MerchantProfile\\Persistence\\SpyMerchantProfile');
        $this->setPackage('src.Orm.Zed.MerchantProfile.Persistence');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_merchant_profile', 'IdMerchantProfile', 'INTEGER', true, null, null);
        $this->addColumn('contact_person_role', 'ContactPersonRole', 'VARCHAR', false, 255, null);
        $this->addColumn('contact_person_title', 'ContactPersonTitle', 'ENUM', false, null, null);
        $this->getColumn('contact_person_title')->setValueSet(array (
  0 => 'Mr',
  1 => 'Mrs',
  2 => 'Dr',
  3 => 'Ms',
));
        $this->addColumn('contact_person_first_name', 'ContactPersonFirstName', 'VARCHAR', false, 255, null);
        $this->addColumn('contact_person_last_name', 'ContactPersonLastName', 'VARCHAR', false, 255, null);
        $this->addColumn('contact_person_phone', 'ContactPersonPhone', 'VARCHAR', false, 255, null);
        $this->addColumn('logo_url', 'LogoUrl', 'VARCHAR', false, 255, null);
        $this->addColumn('public_email', 'PublicEmail', 'VARCHAR', false, 255, null);
        $this->addColumn('public_phone', 'PublicPhone', 'VARCHAR', false, 255, null);
        $this->addColumn('fax_number', 'FaxNumber', 'VARCHAR', false, 255, null);
        $this->addColumn('description_glossary_key', 'DescriptionGlossaryKey', 'VARCHAR', false, 255, null);
        $this->addColumn('banner_url_glossary_key', 'BannerUrlGlossaryKey', 'VARCHAR', false, 255, null);
        $this->addColumn('delivery_time_glossary_key', 'DeliveryTimeGlossaryKey', 'VARCHAR', false, 255, null);
        $this->addColumn('terms_conditions_glossary_key', 'TermsConditionsGlossaryKey', 'VARCHAR', false, 255, null);
        $this->addColumn('cancellation_policy_glossary_key', 'CancellationPolicyGlossaryKey', 'VARCHAR', false, 255, null);
        $this->addColumn('imprint_glossary_key', 'ImprintGlossaryKey', 'VARCHAR', false, 255, null);
        $this->addColumn('data_privacy_glossary_key', 'DataPrivacyGlossaryKey', 'VARCHAR', false, 255, null);
        $this->addForeignKey('fk_merchant', 'FkMerchant', 'INTEGER', 'spy_merchant', 'id_merchant', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyMerchant', '\\Orm\\Zed\\Merchant\\Persistence\\SpyMerchant', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_merchant',
    1 => ':id_merchant',
  ),
), null, null, null, false);
        $this->addRelation('SpyMerchantProfileAddress', '\\Orm\\Zed\\MerchantProfile\\Persistence\\SpyMerchantProfileAddress', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant_profile',
    1 => ':id_merchant_profile',
  ),
), null, null, 'SpyMerchantProfileAddresses', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantProfile', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantProfile', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantProfile', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantProfile', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantProfile', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantProfile', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdMerchantProfile', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyMerchantProfileTableMap::CLASS_DEFAULT : SpyMerchantProfileTableMap::OM_CLASS;
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
     * @return array (SpyMerchantProfile object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyMerchantProfileTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyMerchantProfileTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyMerchantProfileTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyMerchantProfileTableMap::OM_CLASS;
            /** @var SpyMerchantProfile $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyMerchantProfileTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyMerchantProfileTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyMerchantProfileTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyMerchantProfile $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyMerchantProfileTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE);
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_ROLE);
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_TITLE);
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_FIRST_NAME);
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_LAST_NAME);
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_PHONE);
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_LOGO_URL);
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_PUBLIC_EMAIL);
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_PUBLIC_PHONE);
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_FAX_NUMBER);
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_DESCRIPTION_GLOSSARY_KEY);
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_BANNER_URL_GLOSSARY_KEY);
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_DELIVERY_TIME_GLOSSARY_KEY);
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_TERMS_CONDITIONS_GLOSSARY_KEY);
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_CANCELLATION_POLICY_GLOSSARY_KEY);
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_IMPRINT_GLOSSARY_KEY);
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_DATA_PRIVACY_GLOSSARY_KEY);
            $criteria->addSelectColumn(SpyMerchantProfileTableMap::COL_FK_MERCHANT);
        } else {
            $criteria->addSelectColumn($alias . '.id_merchant_profile');
            $criteria->addSelectColumn($alias . '.contact_person_role');
            $criteria->addSelectColumn($alias . '.contact_person_title');
            $criteria->addSelectColumn($alias . '.contact_person_first_name');
            $criteria->addSelectColumn($alias . '.contact_person_last_name');
            $criteria->addSelectColumn($alias . '.contact_person_phone');
            $criteria->addSelectColumn($alias . '.logo_url');
            $criteria->addSelectColumn($alias . '.public_email');
            $criteria->addSelectColumn($alias . '.public_phone');
            $criteria->addSelectColumn($alias . '.fax_number');
            $criteria->addSelectColumn($alias . '.description_glossary_key');
            $criteria->addSelectColumn($alias . '.banner_url_glossary_key');
            $criteria->addSelectColumn($alias . '.delivery_time_glossary_key');
            $criteria->addSelectColumn($alias . '.terms_conditions_glossary_key');
            $criteria->addSelectColumn($alias . '.cancellation_policy_glossary_key');
            $criteria->addSelectColumn($alias . '.imprint_glossary_key');
            $criteria->addSelectColumn($alias . '.data_privacy_glossary_key');
            $criteria->addSelectColumn($alias . '.fk_merchant');
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
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE);
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_ROLE);
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_TITLE);
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_FIRST_NAME);
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_LAST_NAME);
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_CONTACT_PERSON_PHONE);
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_LOGO_URL);
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_PUBLIC_EMAIL);
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_PUBLIC_PHONE);
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_FAX_NUMBER);
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_DESCRIPTION_GLOSSARY_KEY);
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_BANNER_URL_GLOSSARY_KEY);
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_DELIVERY_TIME_GLOSSARY_KEY);
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_TERMS_CONDITIONS_GLOSSARY_KEY);
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_CANCELLATION_POLICY_GLOSSARY_KEY);
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_IMPRINT_GLOSSARY_KEY);
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_DATA_PRIVACY_GLOSSARY_KEY);
            $criteria->removeSelectColumn(SpyMerchantProfileTableMap::COL_FK_MERCHANT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_merchant_profile');
            $criteria->removeSelectColumn($alias . '.contact_person_role');
            $criteria->removeSelectColumn($alias . '.contact_person_title');
            $criteria->removeSelectColumn($alias . '.contact_person_first_name');
            $criteria->removeSelectColumn($alias . '.contact_person_last_name');
            $criteria->removeSelectColumn($alias . '.contact_person_phone');
            $criteria->removeSelectColumn($alias . '.logo_url');
            $criteria->removeSelectColumn($alias . '.public_email');
            $criteria->removeSelectColumn($alias . '.public_phone');
            $criteria->removeSelectColumn($alias . '.fax_number');
            $criteria->removeSelectColumn($alias . '.description_glossary_key');
            $criteria->removeSelectColumn($alias . '.banner_url_glossary_key');
            $criteria->removeSelectColumn($alias . '.delivery_time_glossary_key');
            $criteria->removeSelectColumn($alias . '.terms_conditions_glossary_key');
            $criteria->removeSelectColumn($alias . '.cancellation_policy_glossary_key');
            $criteria->removeSelectColumn($alias . '.imprint_glossary_key');
            $criteria->removeSelectColumn($alias . '.data_privacy_glossary_key');
            $criteria->removeSelectColumn($alias . '.fk_merchant');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyMerchantProfileTableMap::DATABASE_NAME)->getTable(SpyMerchantProfileTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyMerchantProfile or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyMerchantProfile object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantProfileTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MerchantProfile\Persistence\SpyMerchantProfile) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyMerchantProfileTableMap::DATABASE_NAME);
            $criteria->add(SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE, (array) $values, Criteria::IN);
        }

        $query = SpyMerchantProfileQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyMerchantProfileTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyMerchantProfileTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_merchant_profile table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyMerchantProfileQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyMerchantProfile or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyMerchantProfile object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantProfileTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyMerchantProfile object
        }

        if ($criteria->containsKey(SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE) && $criteria->keyContainsValue(SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyMerchantProfileTableMap::COL_ID_MERCHANT_PROFILE.')');
        }


        // Set the correct dbName
        $query = SpyMerchantProfileQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
