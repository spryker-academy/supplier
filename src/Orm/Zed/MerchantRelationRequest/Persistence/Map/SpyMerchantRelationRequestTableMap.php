<?php

namespace Orm\Zed\MerchantRelationRequest\Persistence\Map;

use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestQuery;
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
 * This class defines the structure of the 'spy_merchant_relation_request' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyMerchantRelationRequestTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MerchantRelationRequest.Persistence.Map.SpyMerchantRelationRequestTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_merchant_relation_request';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyMerchantRelationRequest';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MerchantRelationRequest\\Persistence\\SpyMerchantRelationRequest';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MerchantRelationRequest.Persistence.SpyMerchantRelationRequest';

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
     * the column name for the id_merchant_relation_request field
     */
    public const COL_ID_MERCHANT_RELATION_REQUEST = 'spy_merchant_relation_request.id_merchant_relation_request';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_merchant_relation_request.uuid';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'spy_merchant_relation_request.status';

    /**
     * the column name for the is_split_enabled field
     */
    public const COL_IS_SPLIT_ENABLED = 'spy_merchant_relation_request.is_split_enabled';

    /**
     * the column name for the request_note field
     */
    public const COL_REQUEST_NOTE = 'spy_merchant_relation_request.request_note';

    /**
     * the column name for the decision_note field
     */
    public const COL_DECISION_NOTE = 'spy_merchant_relation_request.decision_note';

    /**
     * the column name for the fk_company_user field
     */
    public const COL_FK_COMPANY_USER = 'spy_merchant_relation_request.fk_company_user';

    /**
     * the column name for the fk_merchant field
     */
    public const COL_FK_MERCHANT = 'spy_merchant_relation_request.fk_merchant';

    /**
     * the column name for the fk_company_business_unit field
     */
    public const COL_FK_COMPANY_BUSINESS_UNIT = 'spy_merchant_relation_request.fk_company_business_unit';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_merchant_relation_request.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_merchant_relation_request.updated_at';

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
        self::TYPE_PHPNAME       => ['IdMerchantRelationRequest', 'Uuid', 'Status', 'IsSplitEnabled', 'RequestNote', 'DecisionNote', 'FkCompanyUser', 'FkMerchant', 'FkCompanyBusinessUnit', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idMerchantRelationRequest', 'uuid', 'status', 'isSplitEnabled', 'requestNote', 'decisionNote', 'fkCompanyUser', 'fkMerchant', 'fkCompanyBusinessUnit', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST, SpyMerchantRelationRequestTableMap::COL_UUID, SpyMerchantRelationRequestTableMap::COL_STATUS, SpyMerchantRelationRequestTableMap::COL_IS_SPLIT_ENABLED, SpyMerchantRelationRequestTableMap::COL_REQUEST_NOTE, SpyMerchantRelationRequestTableMap::COL_DECISION_NOTE, SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_USER, SpyMerchantRelationRequestTableMap::COL_FK_MERCHANT, SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_BUSINESS_UNIT, SpyMerchantRelationRequestTableMap::COL_CREATED_AT, SpyMerchantRelationRequestTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_merchant_relation_request', 'uuid', 'status', 'is_split_enabled', 'request_note', 'decision_note', 'fk_company_user', 'fk_merchant', 'fk_company_business_unit', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdMerchantRelationRequest' => 0, 'Uuid' => 1, 'Status' => 2, 'IsSplitEnabled' => 3, 'RequestNote' => 4, 'DecisionNote' => 5, 'FkCompanyUser' => 6, 'FkMerchant' => 7, 'FkCompanyBusinessUnit' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ],
        self::TYPE_CAMELNAME     => ['idMerchantRelationRequest' => 0, 'uuid' => 1, 'status' => 2, 'isSplitEnabled' => 3, 'requestNote' => 4, 'decisionNote' => 5, 'fkCompanyUser' => 6, 'fkMerchant' => 7, 'fkCompanyBusinessUnit' => 8, 'createdAt' => 9, 'updatedAt' => 10, ],
        self::TYPE_COLNAME       => [SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST => 0, SpyMerchantRelationRequestTableMap::COL_UUID => 1, SpyMerchantRelationRequestTableMap::COL_STATUS => 2, SpyMerchantRelationRequestTableMap::COL_IS_SPLIT_ENABLED => 3, SpyMerchantRelationRequestTableMap::COL_REQUEST_NOTE => 4, SpyMerchantRelationRequestTableMap::COL_DECISION_NOTE => 5, SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_USER => 6, SpyMerchantRelationRequestTableMap::COL_FK_MERCHANT => 7, SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_BUSINESS_UNIT => 8, SpyMerchantRelationRequestTableMap::COL_CREATED_AT => 9, SpyMerchantRelationRequestTableMap::COL_UPDATED_AT => 10, ],
        self::TYPE_FIELDNAME     => ['id_merchant_relation_request' => 0, 'uuid' => 1, 'status' => 2, 'is_split_enabled' => 3, 'request_note' => 4, 'decision_note' => 5, 'fk_company_user' => 6, 'fk_merchant' => 7, 'fk_company_business_unit' => 8, 'created_at' => 9, 'updated_at' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdMerchantRelationRequest' => 'ID_MERCHANT_RELATION_REQUEST',
        'SpyMerchantRelationRequest.IdMerchantRelationRequest' => 'ID_MERCHANT_RELATION_REQUEST',
        'idMerchantRelationRequest' => 'ID_MERCHANT_RELATION_REQUEST',
        'spyMerchantRelationRequest.idMerchantRelationRequest' => 'ID_MERCHANT_RELATION_REQUEST',
        'SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST' => 'ID_MERCHANT_RELATION_REQUEST',
        'COL_ID_MERCHANT_RELATION_REQUEST' => 'ID_MERCHANT_RELATION_REQUEST',
        'id_merchant_relation_request' => 'ID_MERCHANT_RELATION_REQUEST',
        'spy_merchant_relation_request.id_merchant_relation_request' => 'ID_MERCHANT_RELATION_REQUEST',
        'Uuid' => 'UUID',
        'SpyMerchantRelationRequest.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyMerchantRelationRequest.uuid' => 'UUID',
        'SpyMerchantRelationRequestTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_merchant_relation_request.uuid' => 'UUID',
        'Status' => 'STATUS',
        'SpyMerchantRelationRequest.Status' => 'STATUS',
        'status' => 'STATUS',
        'spyMerchantRelationRequest.status' => 'STATUS',
        'SpyMerchantRelationRequestTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'spy_merchant_relation_request.status' => 'STATUS',
        'IsSplitEnabled' => 'IS_SPLIT_ENABLED',
        'SpyMerchantRelationRequest.IsSplitEnabled' => 'IS_SPLIT_ENABLED',
        'isSplitEnabled' => 'IS_SPLIT_ENABLED',
        'spyMerchantRelationRequest.isSplitEnabled' => 'IS_SPLIT_ENABLED',
        'SpyMerchantRelationRequestTableMap::COL_IS_SPLIT_ENABLED' => 'IS_SPLIT_ENABLED',
        'COL_IS_SPLIT_ENABLED' => 'IS_SPLIT_ENABLED',
        'is_split_enabled' => 'IS_SPLIT_ENABLED',
        'spy_merchant_relation_request.is_split_enabled' => 'IS_SPLIT_ENABLED',
        'RequestNote' => 'REQUEST_NOTE',
        'SpyMerchantRelationRequest.RequestNote' => 'REQUEST_NOTE',
        'requestNote' => 'REQUEST_NOTE',
        'spyMerchantRelationRequest.requestNote' => 'REQUEST_NOTE',
        'SpyMerchantRelationRequestTableMap::COL_REQUEST_NOTE' => 'REQUEST_NOTE',
        'COL_REQUEST_NOTE' => 'REQUEST_NOTE',
        'request_note' => 'REQUEST_NOTE',
        'spy_merchant_relation_request.request_note' => 'REQUEST_NOTE',
        'DecisionNote' => 'DECISION_NOTE',
        'SpyMerchantRelationRequest.DecisionNote' => 'DECISION_NOTE',
        'decisionNote' => 'DECISION_NOTE',
        'spyMerchantRelationRequest.decisionNote' => 'DECISION_NOTE',
        'SpyMerchantRelationRequestTableMap::COL_DECISION_NOTE' => 'DECISION_NOTE',
        'COL_DECISION_NOTE' => 'DECISION_NOTE',
        'decision_note' => 'DECISION_NOTE',
        'spy_merchant_relation_request.decision_note' => 'DECISION_NOTE',
        'FkCompanyUser' => 'FK_COMPANY_USER',
        'SpyMerchantRelationRequest.FkCompanyUser' => 'FK_COMPANY_USER',
        'fkCompanyUser' => 'FK_COMPANY_USER',
        'spyMerchantRelationRequest.fkCompanyUser' => 'FK_COMPANY_USER',
        'SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'fk_company_user' => 'FK_COMPANY_USER',
        'spy_merchant_relation_request.fk_company_user' => 'FK_COMPANY_USER',
        'FkMerchant' => 'FK_MERCHANT',
        'SpyMerchantRelationRequest.FkMerchant' => 'FK_MERCHANT',
        'fkMerchant' => 'FK_MERCHANT',
        'spyMerchantRelationRequest.fkMerchant' => 'FK_MERCHANT',
        'SpyMerchantRelationRequestTableMap::COL_FK_MERCHANT' => 'FK_MERCHANT',
        'COL_FK_MERCHANT' => 'FK_MERCHANT',
        'fk_merchant' => 'FK_MERCHANT',
        'spy_merchant_relation_request.fk_merchant' => 'FK_MERCHANT',
        'FkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'SpyMerchantRelationRequest.FkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'fkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'spyMerchantRelationRequest.fkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_BUSINESS_UNIT' => 'FK_COMPANY_BUSINESS_UNIT',
        'COL_FK_COMPANY_BUSINESS_UNIT' => 'FK_COMPANY_BUSINESS_UNIT',
        'fk_company_business_unit' => 'FK_COMPANY_BUSINESS_UNIT',
        'spy_merchant_relation_request.fk_company_business_unit' => 'FK_COMPANY_BUSINESS_UNIT',
        'CreatedAt' => 'CREATED_AT',
        'SpyMerchantRelationRequest.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyMerchantRelationRequest.createdAt' => 'CREATED_AT',
        'SpyMerchantRelationRequestTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_merchant_relation_request.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyMerchantRelationRequest.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyMerchantRelationRequest.updatedAt' => 'UPDATED_AT',
        'SpyMerchantRelationRequestTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_merchant_relation_request.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_merchant_relation_request');
        $this->setPhpName('SpyMerchantRelationRequest');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\MerchantRelationRequest\\Persistence\\SpyMerchantRelationRequest');
        $this->setPackage('src.Orm.Zed.MerchantRelationRequest.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_merchant_relation_request_pk_seq');
        // columns
        $this->addPrimaryKey('id_merchant_relation_request', 'IdMerchantRelationRequest', 'INTEGER', true, null, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 36, null);
        $this->addColumn('status', 'Status', 'VARCHAR', true, 255, null);
        $this->addColumn('is_split_enabled', 'IsSplitEnabled', 'BOOLEAN', false, 1, false);
        $this->addColumn('request_note', 'RequestNote', 'VARCHAR', false, 5000, null);
        $this->addColumn('decision_note', 'DecisionNote', 'VARCHAR', false, 5000, null);
        $this->addForeignKey('fk_company_user', 'FkCompanyUser', 'INTEGER', 'spy_company_user', 'id_company_user', true, null, null);
        $this->addForeignKey('fk_merchant', 'FkMerchant', 'INTEGER', 'spy_merchant', 'id_merchant', true, null, null);
        $this->addForeignKey('fk_company_business_unit', 'FkCompanyBusinessUnit', 'INTEGER', 'spy_company_business_unit', 'id_company_business_unit', true, null, null);
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
        $this->addRelation('CompanyUser', '\\Orm\\Zed\\CompanyUser\\Persistence\\SpyCompanyUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_company_user',
    1 => ':id_company_user',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Merchant', '\\Orm\\Zed\\Merchant\\Persistence\\SpyMerchant', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_merchant',
    1 => ':id_merchant',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('CompanyBusinessUnit', '\\Orm\\Zed\\CompanyBusinessUnit\\Persistence\\SpyCompanyBusinessUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_company_business_unit',
    1 => ':id_company_business_unit',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyMerchantRelationRequestToCompanyBusinessUnit', '\\Orm\\Zed\\MerchantRelationRequest\\Persistence\\SpyMerchantRelationRequestToCompanyBusinessUnit', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_merchant_relation_request',
    1 => ':id_merchant_relation_request',
  ),
), 'CASCADE', null, 'SpyMerchantRelationRequestToCompanyBusinessUnits', false);
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_merchant_relation_request'],
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', 'is_timestamp' => 'true'],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_merchant_relation_request     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationRequest', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationRequest', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationRequest', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationRequest', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationRequest', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationRequest', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdMerchantRelationRequest', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyMerchantRelationRequestTableMap::CLASS_DEFAULT : SpyMerchantRelationRequestTableMap::OM_CLASS;
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
     * @return array (SpyMerchantRelationRequest object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyMerchantRelationRequestTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyMerchantRelationRequestTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyMerchantRelationRequestTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyMerchantRelationRequestTableMap::OM_CLASS;
            /** @var SpyMerchantRelationRequest $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyMerchantRelationRequestTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyMerchantRelationRequestTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyMerchantRelationRequestTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyMerchantRelationRequest $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyMerchantRelationRequestTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST);
            $criteria->addSelectColumn(SpyMerchantRelationRequestTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyMerchantRelationRequestTableMap::COL_STATUS);
            $criteria->addSelectColumn(SpyMerchantRelationRequestTableMap::COL_IS_SPLIT_ENABLED);
            $criteria->addSelectColumn(SpyMerchantRelationRequestTableMap::COL_REQUEST_NOTE);
            $criteria->addSelectColumn(SpyMerchantRelationRequestTableMap::COL_DECISION_NOTE);
            $criteria->addSelectColumn(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_USER);
            $criteria->addSelectColumn(SpyMerchantRelationRequestTableMap::COL_FK_MERCHANT);
            $criteria->addSelectColumn(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_BUSINESS_UNIT);
            $criteria->addSelectColumn(SpyMerchantRelationRequestTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyMerchantRelationRequestTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_merchant_relation_request');
            $criteria->addSelectColumn($alias . '.uuid');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.is_split_enabled');
            $criteria->addSelectColumn($alias . '.request_note');
            $criteria->addSelectColumn($alias . '.decision_note');
            $criteria->addSelectColumn($alias . '.fk_company_user');
            $criteria->addSelectColumn($alias . '.fk_merchant');
            $criteria->addSelectColumn($alias . '.fk_company_business_unit');
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
            $criteria->removeSelectColumn(SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST);
            $criteria->removeSelectColumn(SpyMerchantRelationRequestTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyMerchantRelationRequestTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SpyMerchantRelationRequestTableMap::COL_IS_SPLIT_ENABLED);
            $criteria->removeSelectColumn(SpyMerchantRelationRequestTableMap::COL_REQUEST_NOTE);
            $criteria->removeSelectColumn(SpyMerchantRelationRequestTableMap::COL_DECISION_NOTE);
            $criteria->removeSelectColumn(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_USER);
            $criteria->removeSelectColumn(SpyMerchantRelationRequestTableMap::COL_FK_MERCHANT);
            $criteria->removeSelectColumn(SpyMerchantRelationRequestTableMap::COL_FK_COMPANY_BUSINESS_UNIT);
            $criteria->removeSelectColumn(SpyMerchantRelationRequestTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyMerchantRelationRequestTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_merchant_relation_request');
            $criteria->removeSelectColumn($alias . '.uuid');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.is_split_enabled');
            $criteria->removeSelectColumn($alias . '.request_note');
            $criteria->removeSelectColumn($alias . '.decision_note');
            $criteria->removeSelectColumn($alias . '.fk_company_user');
            $criteria->removeSelectColumn($alias . '.fk_merchant');
            $criteria->removeSelectColumn($alias . '.fk_company_business_unit');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyMerchantRelationRequestTableMap::DATABASE_NAME)->getTable(SpyMerchantRelationRequestTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyMerchantRelationRequest or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyMerchantRelationRequest object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantRelationRequestTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequest) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyMerchantRelationRequestTableMap::DATABASE_NAME);
            $criteria->add(SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST, (array) $values, Criteria::IN);
        }

        $query = SpyMerchantRelationRequestQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyMerchantRelationRequestTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyMerchantRelationRequestTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_merchant_relation_request table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyMerchantRelationRequestQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyMerchantRelationRequest or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyMerchantRelationRequest object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantRelationRequestTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyMerchantRelationRequest object
        }

        if ($criteria->containsKey(SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST) && $criteria->keyContainsValue(SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyMerchantRelationRequestTableMap::COL_ID_MERCHANT_RELATION_REQUEST.')');
        }


        // Set the correct dbName
        $query = SpyMerchantRelationRequestQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
