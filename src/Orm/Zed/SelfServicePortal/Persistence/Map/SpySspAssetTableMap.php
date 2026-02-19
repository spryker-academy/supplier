<?php

namespace Orm\Zed\SelfServicePortal\Persistence\Map;

use Orm\Zed\SelfServicePortal\Persistence\SpySspAsset;
use Orm\Zed\SelfServicePortal\Persistence\SpySspAssetQuery;
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
 * This class defines the structure of the 'spy_ssp_asset' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySspAssetTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SelfServicePortal.Persistence.Map.SpySspAssetTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_ssp_asset';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySspAsset';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspAsset';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SelfServicePortal.Persistence.SpySspAsset';

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
     * the column name for the id_ssp_asset field
     */
    public const COL_ID_SSP_ASSET = 'spy_ssp_asset.id_ssp_asset';

    /**
     * the column name for the fk_company_business_unit field
     */
    public const COL_FK_COMPANY_BUSINESS_UNIT = 'spy_ssp_asset.fk_company_business_unit';

    /**
     * the column name for the fk_image_file field
     */
    public const COL_FK_IMAGE_FILE = 'spy_ssp_asset.fk_image_file';

    /**
     * the column name for the external_image_url field
     */
    public const COL_EXTERNAL_IMAGE_URL = 'spy_ssp_asset.external_image_url';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_ssp_asset.name';

    /**
     * the column name for the note field
     */
    public const COL_NOTE = 'spy_ssp_asset.note';

    /**
     * the column name for the reference field
     */
    public const COL_REFERENCE = 'spy_ssp_asset.reference';

    /**
     * the column name for the serial_number field
     */
    public const COL_SERIAL_NUMBER = 'spy_ssp_asset.serial_number';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'spy_ssp_asset.status';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_ssp_asset.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_ssp_asset.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSspAsset', 'FkCompanyBusinessUnit', 'FkImageFile', 'ExternalImageUrl', 'Name', 'Note', 'Reference', 'SerialNumber', 'Status', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSspAsset', 'fkCompanyBusinessUnit', 'fkImageFile', 'externalImageUrl', 'name', 'note', 'reference', 'serialNumber', 'status', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySspAssetTableMap::COL_ID_SSP_ASSET, SpySspAssetTableMap::COL_FK_COMPANY_BUSINESS_UNIT, SpySspAssetTableMap::COL_FK_IMAGE_FILE, SpySspAssetTableMap::COL_EXTERNAL_IMAGE_URL, SpySspAssetTableMap::COL_NAME, SpySspAssetTableMap::COL_NOTE, SpySspAssetTableMap::COL_REFERENCE, SpySspAssetTableMap::COL_SERIAL_NUMBER, SpySspAssetTableMap::COL_STATUS, SpySspAssetTableMap::COL_CREATED_AT, SpySspAssetTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_ssp_asset', 'fk_company_business_unit', 'fk_image_file', 'external_image_url', 'name', 'note', 'reference', 'serial_number', 'status', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdSspAsset' => 0, 'FkCompanyBusinessUnit' => 1, 'FkImageFile' => 2, 'ExternalImageUrl' => 3, 'Name' => 4, 'Note' => 5, 'Reference' => 6, 'SerialNumber' => 7, 'Status' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ],
        self::TYPE_CAMELNAME     => ['idSspAsset' => 0, 'fkCompanyBusinessUnit' => 1, 'fkImageFile' => 2, 'externalImageUrl' => 3, 'name' => 4, 'note' => 5, 'reference' => 6, 'serialNumber' => 7, 'status' => 8, 'createdAt' => 9, 'updatedAt' => 10, ],
        self::TYPE_COLNAME       => [SpySspAssetTableMap::COL_ID_SSP_ASSET => 0, SpySspAssetTableMap::COL_FK_COMPANY_BUSINESS_UNIT => 1, SpySspAssetTableMap::COL_FK_IMAGE_FILE => 2, SpySspAssetTableMap::COL_EXTERNAL_IMAGE_URL => 3, SpySspAssetTableMap::COL_NAME => 4, SpySspAssetTableMap::COL_NOTE => 5, SpySspAssetTableMap::COL_REFERENCE => 6, SpySspAssetTableMap::COL_SERIAL_NUMBER => 7, SpySspAssetTableMap::COL_STATUS => 8, SpySspAssetTableMap::COL_CREATED_AT => 9, SpySspAssetTableMap::COL_UPDATED_AT => 10, ],
        self::TYPE_FIELDNAME     => ['id_ssp_asset' => 0, 'fk_company_business_unit' => 1, 'fk_image_file' => 2, 'external_image_url' => 3, 'name' => 4, 'note' => 5, 'reference' => 6, 'serial_number' => 7, 'status' => 8, 'created_at' => 9, 'updated_at' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSspAsset' => 'ID_SSP_ASSET',
        'SpySspAsset.IdSspAsset' => 'ID_SSP_ASSET',
        'idSspAsset' => 'ID_SSP_ASSET',
        'spySspAsset.idSspAsset' => 'ID_SSP_ASSET',
        'SpySspAssetTableMap::COL_ID_SSP_ASSET' => 'ID_SSP_ASSET',
        'COL_ID_SSP_ASSET' => 'ID_SSP_ASSET',
        'id_ssp_asset' => 'ID_SSP_ASSET',
        'spy_ssp_asset.id_ssp_asset' => 'ID_SSP_ASSET',
        'FkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'SpySspAsset.FkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'fkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'spySspAsset.fkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'SpySspAssetTableMap::COL_FK_COMPANY_BUSINESS_UNIT' => 'FK_COMPANY_BUSINESS_UNIT',
        'COL_FK_COMPANY_BUSINESS_UNIT' => 'FK_COMPANY_BUSINESS_UNIT',
        'fk_company_business_unit' => 'FK_COMPANY_BUSINESS_UNIT',
        'spy_ssp_asset.fk_company_business_unit' => 'FK_COMPANY_BUSINESS_UNIT',
        'FkImageFile' => 'FK_IMAGE_FILE',
        'SpySspAsset.FkImageFile' => 'FK_IMAGE_FILE',
        'fkImageFile' => 'FK_IMAGE_FILE',
        'spySspAsset.fkImageFile' => 'FK_IMAGE_FILE',
        'SpySspAssetTableMap::COL_FK_IMAGE_FILE' => 'FK_IMAGE_FILE',
        'COL_FK_IMAGE_FILE' => 'FK_IMAGE_FILE',
        'fk_image_file' => 'FK_IMAGE_FILE',
        'spy_ssp_asset.fk_image_file' => 'FK_IMAGE_FILE',
        'ExternalImageUrl' => 'EXTERNAL_IMAGE_URL',
        'SpySspAsset.ExternalImageUrl' => 'EXTERNAL_IMAGE_URL',
        'externalImageUrl' => 'EXTERNAL_IMAGE_URL',
        'spySspAsset.externalImageUrl' => 'EXTERNAL_IMAGE_URL',
        'SpySspAssetTableMap::COL_EXTERNAL_IMAGE_URL' => 'EXTERNAL_IMAGE_URL',
        'COL_EXTERNAL_IMAGE_URL' => 'EXTERNAL_IMAGE_URL',
        'external_image_url' => 'EXTERNAL_IMAGE_URL',
        'spy_ssp_asset.external_image_url' => 'EXTERNAL_IMAGE_URL',
        'Name' => 'NAME',
        'SpySspAsset.Name' => 'NAME',
        'name' => 'NAME',
        'spySspAsset.name' => 'NAME',
        'SpySspAssetTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_ssp_asset.name' => 'NAME',
        'Note' => 'NOTE',
        'SpySspAsset.Note' => 'NOTE',
        'note' => 'NOTE',
        'spySspAsset.note' => 'NOTE',
        'SpySspAssetTableMap::COL_NOTE' => 'NOTE',
        'COL_NOTE' => 'NOTE',
        'spy_ssp_asset.note' => 'NOTE',
        'Reference' => 'REFERENCE',
        'SpySspAsset.Reference' => 'REFERENCE',
        'reference' => 'REFERENCE',
        'spySspAsset.reference' => 'REFERENCE',
        'SpySspAssetTableMap::COL_REFERENCE' => 'REFERENCE',
        'COL_REFERENCE' => 'REFERENCE',
        'spy_ssp_asset.reference' => 'REFERENCE',
        'SerialNumber' => 'SERIAL_NUMBER',
        'SpySspAsset.SerialNumber' => 'SERIAL_NUMBER',
        'serialNumber' => 'SERIAL_NUMBER',
        'spySspAsset.serialNumber' => 'SERIAL_NUMBER',
        'SpySspAssetTableMap::COL_SERIAL_NUMBER' => 'SERIAL_NUMBER',
        'COL_SERIAL_NUMBER' => 'SERIAL_NUMBER',
        'serial_number' => 'SERIAL_NUMBER',
        'spy_ssp_asset.serial_number' => 'SERIAL_NUMBER',
        'Status' => 'STATUS',
        'SpySspAsset.Status' => 'STATUS',
        'status' => 'STATUS',
        'spySspAsset.status' => 'STATUS',
        'SpySspAssetTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'spy_ssp_asset.status' => 'STATUS',
        'CreatedAt' => 'CREATED_AT',
        'SpySspAsset.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySspAsset.createdAt' => 'CREATED_AT',
        'SpySspAssetTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_ssp_asset.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySspAsset.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySspAsset.updatedAt' => 'UPDATED_AT',
        'SpySspAssetTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_ssp_asset.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_ssp_asset');
        $this->setPhpName('SpySspAsset');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspAsset');
        $this->setPackage('src.Orm.Zed.SelfServicePortal.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_ssp_asset_pk_seq');
        // columns
        $this->addPrimaryKey('id_ssp_asset', 'IdSspAsset', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_company_business_unit', 'FkCompanyBusinessUnit', 'INTEGER', 'spy_company_business_unit', 'id_company_business_unit', false, null, null);
        $this->addForeignKey('fk_image_file', 'FkImageFile', 'INTEGER', 'spy_file', 'id_file', false, null, null);
        $this->addColumn('external_image_url', 'ExternalImageUrl', 'VARCHAR', false, 2048, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('note', 'Note', 'LONGVARCHAR', false, null, null);
        $this->addColumn('reference', 'Reference', 'VARCHAR', true, 255, null);
        $this->addColumn('serial_number', 'SerialNumber', 'VARCHAR', false, 255, null);
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
        $this->addRelation('SpyCompanyBusinessUnit', '\\Orm\\Zed\\CompanyBusinessUnit\\Persistence\\SpyCompanyBusinessUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_company_business_unit',
    1 => ':id_company_business_unit',
  ),
), null, null, null, false);
        $this->addRelation('File', '\\Orm\\Zed\\FileManager\\Persistence\\SpyFile', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_image_file',
    1 => ':id_file',
  ),
), 'SET NULL', null, null, false);
        $this->addRelation('SpySspInquirySspAsset', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspInquirySspAsset', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_ssp_asset',
    1 => ':id_ssp_asset',
  ),
), null, null, 'SpySspInquirySspAssets', false);
        $this->addRelation('SpySspAssetFile', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspAssetFile', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_ssp_asset',
    1 => ':id_ssp_asset',
  ),
), null, null, 'SpySspAssetFiles', false);
        $this->addRelation('SpySspAssetToCompanyBusinessUnit', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspAssetToCompanyBusinessUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_ssp_asset',
    1 => ':id_ssp_asset',
  ),
), null, null, 'SpySspAssetToCompanyBusinessUnits', false);
        $this->addRelation('SpySspAssetToSspModel', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspAssetToSspModel', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_ssp_asset',
    1 => ':id_ssp_asset',
  ),
), 'CASCADE', null, 'SpySspAssetToSspModels', false);
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
            'event' => ['spy_ssp_asset_all' => ['column' => '*']],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_ssp_asset     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpySspAssetToSspModelTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspAsset', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspAsset', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspAsset', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspAsset', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspAsset', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspAsset', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSspAsset', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySspAssetTableMap::CLASS_DEFAULT : SpySspAssetTableMap::OM_CLASS;
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
     * @return array (SpySspAsset object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySspAssetTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySspAssetTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySspAssetTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySspAssetTableMap::OM_CLASS;
            /** @var SpySspAsset $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySspAssetTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySspAssetTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySspAssetTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySspAsset $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySspAssetTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySspAssetTableMap::COL_ID_SSP_ASSET);
            $criteria->addSelectColumn(SpySspAssetTableMap::COL_FK_COMPANY_BUSINESS_UNIT);
            $criteria->addSelectColumn(SpySspAssetTableMap::COL_FK_IMAGE_FILE);
            $criteria->addSelectColumn(SpySspAssetTableMap::COL_EXTERNAL_IMAGE_URL);
            $criteria->addSelectColumn(SpySspAssetTableMap::COL_NAME);
            $criteria->addSelectColumn(SpySspAssetTableMap::COL_NOTE);
            $criteria->addSelectColumn(SpySspAssetTableMap::COL_REFERENCE);
            $criteria->addSelectColumn(SpySspAssetTableMap::COL_SERIAL_NUMBER);
            $criteria->addSelectColumn(SpySspAssetTableMap::COL_STATUS);
            $criteria->addSelectColumn(SpySspAssetTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySspAssetTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_ssp_asset');
            $criteria->addSelectColumn($alias . '.fk_company_business_unit');
            $criteria->addSelectColumn($alias . '.fk_image_file');
            $criteria->addSelectColumn($alias . '.external_image_url');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.note');
            $criteria->addSelectColumn($alias . '.reference');
            $criteria->addSelectColumn($alias . '.serial_number');
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
            $criteria->removeSelectColumn(SpySspAssetTableMap::COL_ID_SSP_ASSET);
            $criteria->removeSelectColumn(SpySspAssetTableMap::COL_FK_COMPANY_BUSINESS_UNIT);
            $criteria->removeSelectColumn(SpySspAssetTableMap::COL_FK_IMAGE_FILE);
            $criteria->removeSelectColumn(SpySspAssetTableMap::COL_EXTERNAL_IMAGE_URL);
            $criteria->removeSelectColumn(SpySspAssetTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpySspAssetTableMap::COL_NOTE);
            $criteria->removeSelectColumn(SpySspAssetTableMap::COL_REFERENCE);
            $criteria->removeSelectColumn(SpySspAssetTableMap::COL_SERIAL_NUMBER);
            $criteria->removeSelectColumn(SpySspAssetTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SpySspAssetTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySspAssetTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_ssp_asset');
            $criteria->removeSelectColumn($alias . '.fk_company_business_unit');
            $criteria->removeSelectColumn($alias . '.fk_image_file');
            $criteria->removeSelectColumn($alias . '.external_image_url');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.note');
            $criteria->removeSelectColumn($alias . '.reference');
            $criteria->removeSelectColumn($alias . '.serial_number');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySspAssetTableMap::DATABASE_NAME)->getTable(SpySspAssetTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySspAsset or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySspAsset object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspAssetTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspAsset) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySspAssetTableMap::DATABASE_NAME);
            $criteria->add(SpySspAssetTableMap::COL_ID_SSP_ASSET, (array) $values, Criteria::IN);
        }

        $query = SpySspAssetQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySspAssetTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySspAssetTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_ssp_asset table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySspAssetQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySspAsset or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySspAsset object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspAssetTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySspAsset object
        }


        // Set the correct dbName
        $query = SpySspAssetQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
