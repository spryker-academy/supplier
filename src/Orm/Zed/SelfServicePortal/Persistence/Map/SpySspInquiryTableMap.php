<?php

namespace Orm\Zed\SelfServicePortal\Persistence\Map;

use Orm\Zed\SelfServicePortal\Persistence\SpySspInquiry;
use Orm\Zed\SelfServicePortal\Persistence\SpySspInquiryQuery;
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
 * This class defines the structure of the 'spy_ssp_inquiry' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySspInquiryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SelfServicePortal.Persistence.Map.SpySspInquiryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_ssp_inquiry';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySspInquiry';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspInquiry';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SelfServicePortal.Persistence.SpySspInquiry';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id_ssp_inquiry field
     */
    public const COL_ID_SSP_INQUIRY = 'spy_ssp_inquiry.id_ssp_inquiry';

    /**
     * the column name for the reference field
     */
    public const COL_REFERENCE = 'spy_ssp_inquiry.reference';

    /**
     * the column name for the fk_company_user field
     */
    public const COL_FK_COMPANY_USER = 'spy_ssp_inquiry.fk_company_user';

    /**
     * the column name for the subject field
     */
    public const COL_SUBJECT = 'spy_ssp_inquiry.subject';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'spy_ssp_inquiry.description';

    /**
     * the column name for the fk_state_machine_item_state field
     */
    public const COL_FK_STATE_MACHINE_ITEM_STATE = 'spy_ssp_inquiry.fk_state_machine_item_state';

    /**
     * the column name for the type field
     */
    public const COL_TYPE = 'spy_ssp_inquiry.type';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_ssp_inquiry.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_ssp_inquiry.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSspInquiry', 'Reference', 'FkCompanyUser', 'Subject', 'Description', 'FkStateMachineItemState', 'Type', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSspInquiry', 'reference', 'fkCompanyUser', 'subject', 'description', 'fkStateMachineItemState', 'type', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySspInquiryTableMap::COL_ID_SSP_INQUIRY, SpySspInquiryTableMap::COL_REFERENCE, SpySspInquiryTableMap::COL_FK_COMPANY_USER, SpySspInquiryTableMap::COL_SUBJECT, SpySspInquiryTableMap::COL_DESCRIPTION, SpySspInquiryTableMap::COL_FK_STATE_MACHINE_ITEM_STATE, SpySspInquiryTableMap::COL_TYPE, SpySspInquiryTableMap::COL_CREATED_AT, SpySspInquiryTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_ssp_inquiry', 'reference', 'fk_company_user', 'subject', 'description', 'fk_state_machine_item_state', 'type', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
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
        self::TYPE_PHPNAME       => ['IdSspInquiry' => 0, 'Reference' => 1, 'FkCompanyUser' => 2, 'Subject' => 3, 'Description' => 4, 'FkStateMachineItemState' => 5, 'Type' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idSspInquiry' => 0, 'reference' => 1, 'fkCompanyUser' => 2, 'subject' => 3, 'description' => 4, 'fkStateMachineItemState' => 5, 'type' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpySspInquiryTableMap::COL_ID_SSP_INQUIRY => 0, SpySspInquiryTableMap::COL_REFERENCE => 1, SpySspInquiryTableMap::COL_FK_COMPANY_USER => 2, SpySspInquiryTableMap::COL_SUBJECT => 3, SpySspInquiryTableMap::COL_DESCRIPTION => 4, SpySspInquiryTableMap::COL_FK_STATE_MACHINE_ITEM_STATE => 5, SpySspInquiryTableMap::COL_TYPE => 6, SpySspInquiryTableMap::COL_CREATED_AT => 7, SpySspInquiryTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_ssp_inquiry' => 0, 'reference' => 1, 'fk_company_user' => 2, 'subject' => 3, 'description' => 4, 'fk_state_machine_item_state' => 5, 'type' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSspInquiry' => 'ID_SSP_INQUIRY',
        'SpySspInquiry.IdSspInquiry' => 'ID_SSP_INQUIRY',
        'idSspInquiry' => 'ID_SSP_INQUIRY',
        'spySspInquiry.idSspInquiry' => 'ID_SSP_INQUIRY',
        'SpySspInquiryTableMap::COL_ID_SSP_INQUIRY' => 'ID_SSP_INQUIRY',
        'COL_ID_SSP_INQUIRY' => 'ID_SSP_INQUIRY',
        'id_ssp_inquiry' => 'ID_SSP_INQUIRY',
        'spy_ssp_inquiry.id_ssp_inquiry' => 'ID_SSP_INQUIRY',
        'Reference' => 'REFERENCE',
        'SpySspInquiry.Reference' => 'REFERENCE',
        'reference' => 'REFERENCE',
        'spySspInquiry.reference' => 'REFERENCE',
        'SpySspInquiryTableMap::COL_REFERENCE' => 'REFERENCE',
        'COL_REFERENCE' => 'REFERENCE',
        'spy_ssp_inquiry.reference' => 'REFERENCE',
        'FkCompanyUser' => 'FK_COMPANY_USER',
        'SpySspInquiry.FkCompanyUser' => 'FK_COMPANY_USER',
        'fkCompanyUser' => 'FK_COMPANY_USER',
        'spySspInquiry.fkCompanyUser' => 'FK_COMPANY_USER',
        'SpySspInquiryTableMap::COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'fk_company_user' => 'FK_COMPANY_USER',
        'spy_ssp_inquiry.fk_company_user' => 'FK_COMPANY_USER',
        'Subject' => 'SUBJECT',
        'SpySspInquiry.Subject' => 'SUBJECT',
        'subject' => 'SUBJECT',
        'spySspInquiry.subject' => 'SUBJECT',
        'SpySspInquiryTableMap::COL_SUBJECT' => 'SUBJECT',
        'COL_SUBJECT' => 'SUBJECT',
        'spy_ssp_inquiry.subject' => 'SUBJECT',
        'Description' => 'DESCRIPTION',
        'SpySspInquiry.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'spySspInquiry.description' => 'DESCRIPTION',
        'SpySspInquiryTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'spy_ssp_inquiry.description' => 'DESCRIPTION',
        'FkStateMachineItemState' => 'FK_STATE_MACHINE_ITEM_STATE',
        'SpySspInquiry.FkStateMachineItemState' => 'FK_STATE_MACHINE_ITEM_STATE',
        'fkStateMachineItemState' => 'FK_STATE_MACHINE_ITEM_STATE',
        'spySspInquiry.fkStateMachineItemState' => 'FK_STATE_MACHINE_ITEM_STATE',
        'SpySspInquiryTableMap::COL_FK_STATE_MACHINE_ITEM_STATE' => 'FK_STATE_MACHINE_ITEM_STATE',
        'COL_FK_STATE_MACHINE_ITEM_STATE' => 'FK_STATE_MACHINE_ITEM_STATE',
        'fk_state_machine_item_state' => 'FK_STATE_MACHINE_ITEM_STATE',
        'spy_ssp_inquiry.fk_state_machine_item_state' => 'FK_STATE_MACHINE_ITEM_STATE',
        'Type' => 'TYPE',
        'SpySspInquiry.Type' => 'TYPE',
        'type' => 'TYPE',
        'spySspInquiry.type' => 'TYPE',
        'SpySspInquiryTableMap::COL_TYPE' => 'TYPE',
        'COL_TYPE' => 'TYPE',
        'spy_ssp_inquiry.type' => 'TYPE',
        'CreatedAt' => 'CREATED_AT',
        'SpySspInquiry.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySspInquiry.createdAt' => 'CREATED_AT',
        'SpySspInquiryTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_ssp_inquiry.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySspInquiry.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySspInquiry.updatedAt' => 'UPDATED_AT',
        'SpySspInquiryTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_ssp_inquiry.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_ssp_inquiry');
        $this->setPhpName('SpySspInquiry');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspInquiry');
        $this->setPackage('src.Orm.Zed.SelfServicePortal.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_ssp_inquiry_pk_seq');
        // columns
        $this->addPrimaryKey('id_ssp_inquiry', 'IdSspInquiry', 'INTEGER', true, null, null);
        $this->addColumn('reference', 'Reference', 'VARCHAR', true, 255, null);
        $this->addForeignKey('fk_company_user', 'FkCompanyUser', 'INTEGER', 'spy_company_user', 'id_company_user', false, null, null);
        $this->addColumn('subject', 'Subject', 'VARCHAR', true, 255, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', true, null, null);
        $this->addForeignKey('fk_state_machine_item_state', 'FkStateMachineItemState', 'INTEGER', 'spy_state_machine_item_state', 'id_state_machine_item_state', false, null, null);
        $this->addColumn('type', 'Type', 'VARCHAR', true, 255, null);
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
        $this->addRelation('SpyCompanyUser', '\\Orm\\Zed\\CompanyUser\\Persistence\\SpyCompanyUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_company_user',
    1 => ':id_company_user',
  ),
), null, null, null, false);
        $this->addRelation('StateMachineItemState', '\\Orm\\Zed\\StateMachine\\Persistence\\SpyStateMachineItemState', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_state_machine_item_state',
    1 => ':id_state_machine_item_state',
  ),
), null, null, null, false);
        $this->addRelation('SpySspInquiryFile', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspInquiryFile', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_ssp_inquiry',
    1 => ':id_ssp_inquiry',
  ),
), 'CASCADE', null, 'SpySspInquiryFiles', false);
        $this->addRelation('SpySspInquirySalesOrder', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspInquirySalesOrder', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_ssp_inquiry',
    1 => ':id_ssp_inquiry',
  ),
), null, null, 'SpySspInquirySalesOrders', false);
        $this->addRelation('SpySspInquirySspAsset', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspInquirySspAsset', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_ssp_inquiry',
    1 => ':id_ssp_inquiry',
  ),
), null, null, 'SpySspInquirySspAssets', false);
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
     * Method to invalidate the instance pool of all tables related to spy_ssp_inquiry     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpySspInquiryFileTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspInquiry', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspInquiry', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspInquiry', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspInquiry', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspInquiry', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspInquiry', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSspInquiry', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySspInquiryTableMap::CLASS_DEFAULT : SpySspInquiryTableMap::OM_CLASS;
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
     * @return array (SpySspInquiry object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySspInquiryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySspInquiryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySspInquiryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySspInquiryTableMap::OM_CLASS;
            /** @var SpySspInquiry $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySspInquiryTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySspInquiryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySspInquiryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySspInquiry $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySspInquiryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySspInquiryTableMap::COL_ID_SSP_INQUIRY);
            $criteria->addSelectColumn(SpySspInquiryTableMap::COL_REFERENCE);
            $criteria->addSelectColumn(SpySspInquiryTableMap::COL_FK_COMPANY_USER);
            $criteria->addSelectColumn(SpySspInquiryTableMap::COL_SUBJECT);
            $criteria->addSelectColumn(SpySspInquiryTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SpySspInquiryTableMap::COL_FK_STATE_MACHINE_ITEM_STATE);
            $criteria->addSelectColumn(SpySspInquiryTableMap::COL_TYPE);
            $criteria->addSelectColumn(SpySspInquiryTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySspInquiryTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_ssp_inquiry');
            $criteria->addSelectColumn($alias . '.reference');
            $criteria->addSelectColumn($alias . '.fk_company_user');
            $criteria->addSelectColumn($alias . '.subject');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.fk_state_machine_item_state');
            $criteria->addSelectColumn($alias . '.type');
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
            $criteria->removeSelectColumn(SpySspInquiryTableMap::COL_ID_SSP_INQUIRY);
            $criteria->removeSelectColumn(SpySspInquiryTableMap::COL_REFERENCE);
            $criteria->removeSelectColumn(SpySspInquiryTableMap::COL_FK_COMPANY_USER);
            $criteria->removeSelectColumn(SpySspInquiryTableMap::COL_SUBJECT);
            $criteria->removeSelectColumn(SpySspInquiryTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(SpySspInquiryTableMap::COL_FK_STATE_MACHINE_ITEM_STATE);
            $criteria->removeSelectColumn(SpySspInquiryTableMap::COL_TYPE);
            $criteria->removeSelectColumn(SpySspInquiryTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySspInquiryTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_ssp_inquiry');
            $criteria->removeSelectColumn($alias . '.reference');
            $criteria->removeSelectColumn($alias . '.fk_company_user');
            $criteria->removeSelectColumn($alias . '.subject');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.fk_state_machine_item_state');
            $criteria->removeSelectColumn($alias . '.type');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySspInquiryTableMap::DATABASE_NAME)->getTable(SpySspInquiryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySspInquiry or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySspInquiry object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspInquiryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspInquiry) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySspInquiryTableMap::DATABASE_NAME);
            $criteria->add(SpySspInquiryTableMap::COL_ID_SSP_INQUIRY, (array) $values, Criteria::IN);
        }

        $query = SpySspInquiryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySspInquiryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySspInquiryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_ssp_inquiry table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySspInquiryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySspInquiry or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySspInquiry object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspInquiryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySspInquiry object
        }


        // Set the correct dbName
        $query = SpySspInquiryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
