<?php

namespace Orm\Zed\CompanyUserInvitation\Persistence\Map;

use Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitation;
use Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitationQuery;
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
 * This class defines the structure of the 'spy_company_user_invitation' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCompanyUserInvitationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CompanyUserInvitation.Persistence.Map.SpyCompanyUserInvitationTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_company_user_invitation';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCompanyUserInvitation';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CompanyUserInvitation\\Persistence\\SpyCompanyUserInvitation';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CompanyUserInvitation.Persistence.SpyCompanyUserInvitation';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id_company_user_invitation field
     */
    public const COL_ID_COMPANY_USER_INVITATION = 'spy_company_user_invitation.id_company_user_invitation';

    /**
     * the column name for the fk_company_business_unit field
     */
    public const COL_FK_COMPANY_BUSINESS_UNIT = 'spy_company_user_invitation.fk_company_business_unit';

    /**
     * the column name for the fk_company_user field
     */
    public const COL_FK_COMPANY_USER = 'spy_company_user_invitation.fk_company_user';

    /**
     * the column name for the fk_company_user_invitation_status field
     */
    public const COL_FK_COMPANY_USER_INVITATION_STATUS = 'spy_company_user_invitation.fk_company_user_invitation_status';

    /**
     * the column name for the email field
     */
    public const COL_EMAIL = 'spy_company_user_invitation.email';

    /**
     * the column name for the first_name field
     */
    public const COL_FIRST_NAME = 'spy_company_user_invitation.first_name';

    /**
     * the column name for the hash field
     */
    public const COL_HASH = 'spy_company_user_invitation.hash';

    /**
     * the column name for the last_name field
     */
    public const COL_LAST_NAME = 'spy_company_user_invitation.last_name';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_company_user_invitation.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_company_user_invitation.updated_at';

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
        self::TYPE_PHPNAME       => ['IdCompanyUserInvitation', 'FkCompanyBusinessUnit', 'FkCompanyUser', 'FkCompanyUserInvitationStatus', 'Email', 'FirstName', 'Hash', 'LastName', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idCompanyUserInvitation', 'fkCompanyBusinessUnit', 'fkCompanyUser', 'fkCompanyUserInvitationStatus', 'email', 'firstName', 'hash', 'lastName', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyCompanyUserInvitationTableMap::COL_ID_COMPANY_USER_INVITATION, SpyCompanyUserInvitationTableMap::COL_FK_COMPANY_BUSINESS_UNIT, SpyCompanyUserInvitationTableMap::COL_FK_COMPANY_USER, SpyCompanyUserInvitationTableMap::COL_FK_COMPANY_USER_INVITATION_STATUS, SpyCompanyUserInvitationTableMap::COL_EMAIL, SpyCompanyUserInvitationTableMap::COL_FIRST_NAME, SpyCompanyUserInvitationTableMap::COL_HASH, SpyCompanyUserInvitationTableMap::COL_LAST_NAME, SpyCompanyUserInvitationTableMap::COL_CREATED_AT, SpyCompanyUserInvitationTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_company_user_invitation', 'fk_company_business_unit', 'fk_company_user', 'fk_company_user_invitation_status', 'email', 'first_name', 'hash', 'last_name', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['IdCompanyUserInvitation' => 0, 'FkCompanyBusinessUnit' => 1, 'FkCompanyUser' => 2, 'FkCompanyUserInvitationStatus' => 3, 'Email' => 4, 'FirstName' => 5, 'Hash' => 6, 'LastName' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ],
        self::TYPE_CAMELNAME     => ['idCompanyUserInvitation' => 0, 'fkCompanyBusinessUnit' => 1, 'fkCompanyUser' => 2, 'fkCompanyUserInvitationStatus' => 3, 'email' => 4, 'firstName' => 5, 'hash' => 6, 'lastName' => 7, 'createdAt' => 8, 'updatedAt' => 9, ],
        self::TYPE_COLNAME       => [SpyCompanyUserInvitationTableMap::COL_ID_COMPANY_USER_INVITATION => 0, SpyCompanyUserInvitationTableMap::COL_FK_COMPANY_BUSINESS_UNIT => 1, SpyCompanyUserInvitationTableMap::COL_FK_COMPANY_USER => 2, SpyCompanyUserInvitationTableMap::COL_FK_COMPANY_USER_INVITATION_STATUS => 3, SpyCompanyUserInvitationTableMap::COL_EMAIL => 4, SpyCompanyUserInvitationTableMap::COL_FIRST_NAME => 5, SpyCompanyUserInvitationTableMap::COL_HASH => 6, SpyCompanyUserInvitationTableMap::COL_LAST_NAME => 7, SpyCompanyUserInvitationTableMap::COL_CREATED_AT => 8, SpyCompanyUserInvitationTableMap::COL_UPDATED_AT => 9, ],
        self::TYPE_FIELDNAME     => ['id_company_user_invitation' => 0, 'fk_company_business_unit' => 1, 'fk_company_user' => 2, 'fk_company_user_invitation_status' => 3, 'email' => 4, 'first_name' => 5, 'hash' => 6, 'last_name' => 7, 'created_at' => 8, 'updated_at' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCompanyUserInvitation' => 'ID_COMPANY_USER_INVITATION',
        'SpyCompanyUserInvitation.IdCompanyUserInvitation' => 'ID_COMPANY_USER_INVITATION',
        'idCompanyUserInvitation' => 'ID_COMPANY_USER_INVITATION',
        'spyCompanyUserInvitation.idCompanyUserInvitation' => 'ID_COMPANY_USER_INVITATION',
        'SpyCompanyUserInvitationTableMap::COL_ID_COMPANY_USER_INVITATION' => 'ID_COMPANY_USER_INVITATION',
        'COL_ID_COMPANY_USER_INVITATION' => 'ID_COMPANY_USER_INVITATION',
        'id_company_user_invitation' => 'ID_COMPANY_USER_INVITATION',
        'spy_company_user_invitation.id_company_user_invitation' => 'ID_COMPANY_USER_INVITATION',
        'FkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'SpyCompanyUserInvitation.FkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'fkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'spyCompanyUserInvitation.fkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'SpyCompanyUserInvitationTableMap::COL_FK_COMPANY_BUSINESS_UNIT' => 'FK_COMPANY_BUSINESS_UNIT',
        'COL_FK_COMPANY_BUSINESS_UNIT' => 'FK_COMPANY_BUSINESS_UNIT',
        'fk_company_business_unit' => 'FK_COMPANY_BUSINESS_UNIT',
        'spy_company_user_invitation.fk_company_business_unit' => 'FK_COMPANY_BUSINESS_UNIT',
        'FkCompanyUser' => 'FK_COMPANY_USER',
        'SpyCompanyUserInvitation.FkCompanyUser' => 'FK_COMPANY_USER',
        'fkCompanyUser' => 'FK_COMPANY_USER',
        'spyCompanyUserInvitation.fkCompanyUser' => 'FK_COMPANY_USER',
        'SpyCompanyUserInvitationTableMap::COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'fk_company_user' => 'FK_COMPANY_USER',
        'spy_company_user_invitation.fk_company_user' => 'FK_COMPANY_USER',
        'FkCompanyUserInvitationStatus' => 'FK_COMPANY_USER_INVITATION_STATUS',
        'SpyCompanyUserInvitation.FkCompanyUserInvitationStatus' => 'FK_COMPANY_USER_INVITATION_STATUS',
        'fkCompanyUserInvitationStatus' => 'FK_COMPANY_USER_INVITATION_STATUS',
        'spyCompanyUserInvitation.fkCompanyUserInvitationStatus' => 'FK_COMPANY_USER_INVITATION_STATUS',
        'SpyCompanyUserInvitationTableMap::COL_FK_COMPANY_USER_INVITATION_STATUS' => 'FK_COMPANY_USER_INVITATION_STATUS',
        'COL_FK_COMPANY_USER_INVITATION_STATUS' => 'FK_COMPANY_USER_INVITATION_STATUS',
        'fk_company_user_invitation_status' => 'FK_COMPANY_USER_INVITATION_STATUS',
        'spy_company_user_invitation.fk_company_user_invitation_status' => 'FK_COMPANY_USER_INVITATION_STATUS',
        'Email' => 'EMAIL',
        'SpyCompanyUserInvitation.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'spyCompanyUserInvitation.email' => 'EMAIL',
        'SpyCompanyUserInvitationTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'spy_company_user_invitation.email' => 'EMAIL',
        'FirstName' => 'FIRST_NAME',
        'SpyCompanyUserInvitation.FirstName' => 'FIRST_NAME',
        'firstName' => 'FIRST_NAME',
        'spyCompanyUserInvitation.firstName' => 'FIRST_NAME',
        'SpyCompanyUserInvitationTableMap::COL_FIRST_NAME' => 'FIRST_NAME',
        'COL_FIRST_NAME' => 'FIRST_NAME',
        'first_name' => 'FIRST_NAME',
        'spy_company_user_invitation.first_name' => 'FIRST_NAME',
        'Hash' => 'HASH',
        'SpyCompanyUserInvitation.Hash' => 'HASH',
        'hash' => 'HASH',
        'spyCompanyUserInvitation.hash' => 'HASH',
        'SpyCompanyUserInvitationTableMap::COL_HASH' => 'HASH',
        'COL_HASH' => 'HASH',
        'spy_company_user_invitation.hash' => 'HASH',
        'LastName' => 'LAST_NAME',
        'SpyCompanyUserInvitation.LastName' => 'LAST_NAME',
        'lastName' => 'LAST_NAME',
        'spyCompanyUserInvitation.lastName' => 'LAST_NAME',
        'SpyCompanyUserInvitationTableMap::COL_LAST_NAME' => 'LAST_NAME',
        'COL_LAST_NAME' => 'LAST_NAME',
        'last_name' => 'LAST_NAME',
        'spy_company_user_invitation.last_name' => 'LAST_NAME',
        'CreatedAt' => 'CREATED_AT',
        'SpyCompanyUserInvitation.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyCompanyUserInvitation.createdAt' => 'CREATED_AT',
        'SpyCompanyUserInvitationTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_company_user_invitation.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyCompanyUserInvitation.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyCompanyUserInvitation.updatedAt' => 'UPDATED_AT',
        'SpyCompanyUserInvitationTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_company_user_invitation.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_company_user_invitation');
        $this->setPhpName('SpyCompanyUserInvitation');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\CompanyUserInvitation\\Persistence\\SpyCompanyUserInvitation');
        $this->setPackage('src.Orm.Zed.CompanyUserInvitation.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_company_user_invitation_pk_seq');
        // columns
        $this->addPrimaryKey('id_company_user_invitation', 'IdCompanyUserInvitation', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_company_business_unit', 'FkCompanyBusinessUnit', 'INTEGER', 'spy_company_business_unit', 'id_company_business_unit', true, null, null);
        $this->addForeignKey('fk_company_user', 'FkCompanyUser', 'INTEGER', 'spy_company_user', 'id_company_user', true, null, null);
        $this->addForeignKey('fk_company_user_invitation_status', 'FkCompanyUserInvitationStatus', 'INTEGER', 'spy_company_user_invitation_status', 'id_company_user_invitation_status', true, null, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 255, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', true, 100, null);
        $this->addColumn('hash', 'Hash', 'VARCHAR', true, 100, null);
        $this->addColumn('last_name', 'LastName', 'VARCHAR', true, 100, null);
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
        $this->addRelation('SpyCompanyUserInvitationStatus', '\\Orm\\Zed\\CompanyUserInvitation\\Persistence\\SpyCompanyUserInvitationStatus', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_company_user_invitation_status',
    1 => ':id_company_user_invitation_status',
  ),
), null, null, null, false);
        $this->addRelation('SpyCompanyUser', '\\Orm\\Zed\\CompanyUser\\Persistence\\SpyCompanyUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_company_user',
    1 => ':id_company_user',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyUserInvitation', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyUserInvitation', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyUserInvitation', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyUserInvitation', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyUserInvitation', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyUserInvitation', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCompanyUserInvitation', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCompanyUserInvitationTableMap::CLASS_DEFAULT : SpyCompanyUserInvitationTableMap::OM_CLASS;
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
     * @return array (SpyCompanyUserInvitation object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCompanyUserInvitationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCompanyUserInvitationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCompanyUserInvitationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCompanyUserInvitationTableMap::OM_CLASS;
            /** @var SpyCompanyUserInvitation $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCompanyUserInvitationTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCompanyUserInvitationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCompanyUserInvitationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCompanyUserInvitation $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCompanyUserInvitationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCompanyUserInvitationTableMap::COL_ID_COMPANY_USER_INVITATION);
            $criteria->addSelectColumn(SpyCompanyUserInvitationTableMap::COL_FK_COMPANY_BUSINESS_UNIT);
            $criteria->addSelectColumn(SpyCompanyUserInvitationTableMap::COL_FK_COMPANY_USER);
            $criteria->addSelectColumn(SpyCompanyUserInvitationTableMap::COL_FK_COMPANY_USER_INVITATION_STATUS);
            $criteria->addSelectColumn(SpyCompanyUserInvitationTableMap::COL_EMAIL);
            $criteria->addSelectColumn(SpyCompanyUserInvitationTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(SpyCompanyUserInvitationTableMap::COL_HASH);
            $criteria->addSelectColumn(SpyCompanyUserInvitationTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(SpyCompanyUserInvitationTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyCompanyUserInvitationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_company_user_invitation');
            $criteria->addSelectColumn($alias . '.fk_company_business_unit');
            $criteria->addSelectColumn($alias . '.fk_company_user');
            $criteria->addSelectColumn($alias . '.fk_company_user_invitation_status');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.hash');
            $criteria->addSelectColumn($alias . '.last_name');
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
            $criteria->removeSelectColumn(SpyCompanyUserInvitationTableMap::COL_ID_COMPANY_USER_INVITATION);
            $criteria->removeSelectColumn(SpyCompanyUserInvitationTableMap::COL_FK_COMPANY_BUSINESS_UNIT);
            $criteria->removeSelectColumn(SpyCompanyUserInvitationTableMap::COL_FK_COMPANY_USER);
            $criteria->removeSelectColumn(SpyCompanyUserInvitationTableMap::COL_FK_COMPANY_USER_INVITATION_STATUS);
            $criteria->removeSelectColumn(SpyCompanyUserInvitationTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(SpyCompanyUserInvitationTableMap::COL_FIRST_NAME);
            $criteria->removeSelectColumn(SpyCompanyUserInvitationTableMap::COL_HASH);
            $criteria->removeSelectColumn(SpyCompanyUserInvitationTableMap::COL_LAST_NAME);
            $criteria->removeSelectColumn(SpyCompanyUserInvitationTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyCompanyUserInvitationTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_company_user_invitation');
            $criteria->removeSelectColumn($alias . '.fk_company_business_unit');
            $criteria->removeSelectColumn($alias . '.fk_company_user');
            $criteria->removeSelectColumn($alias . '.fk_company_user_invitation_status');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.first_name');
            $criteria->removeSelectColumn($alias . '.hash');
            $criteria->removeSelectColumn($alias . '.last_name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCompanyUserInvitationTableMap::DATABASE_NAME)->getTable(SpyCompanyUserInvitationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCompanyUserInvitation or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCompanyUserInvitation object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyUserInvitationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CompanyUserInvitation\Persistence\SpyCompanyUserInvitation) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCompanyUserInvitationTableMap::DATABASE_NAME);
            $criteria->add(SpyCompanyUserInvitationTableMap::COL_ID_COMPANY_USER_INVITATION, (array) $values, Criteria::IN);
        }

        $query = SpyCompanyUserInvitationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCompanyUserInvitationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCompanyUserInvitationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_company_user_invitation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCompanyUserInvitationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCompanyUserInvitation or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCompanyUserInvitation object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyUserInvitationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCompanyUserInvitation object
        }

        if ($criteria->containsKey(SpyCompanyUserInvitationTableMap::COL_ID_COMPANY_USER_INVITATION) && $criteria->keyContainsValue(SpyCompanyUserInvitationTableMap::COL_ID_COMPANY_USER_INVITATION) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCompanyUserInvitationTableMap::COL_ID_COMPANY_USER_INVITATION.')');
        }


        // Set the correct dbName
        $query = SpyCompanyUserInvitationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
