<?php

namespace Orm\Zed\QuoteRequest\Persistence\Map;

use Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest;
use Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestQuery;
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
 * This class defines the structure of the 'spy_quote_request' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyQuoteRequestTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.QuoteRequest.Persistence.Map.SpyQuoteRequestTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_quote_request';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyQuoteRequest';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\QuoteRequest\\Persistence\\SpyQuoteRequest';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.QuoteRequest.Persistence.SpyQuoteRequest';

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
     * the column name for the id_quote_request field
     */
    public const COL_ID_QUOTE_REQUEST = 'spy_quote_request.id_quote_request';

    /**
     * the column name for the fk_company_user field
     */
    public const COL_FK_COMPANY_USER = 'spy_quote_request.fk_company_user';

    /**
     * the column name for the quote_request_reference field
     */
    public const COL_QUOTE_REQUEST_REFERENCE = 'spy_quote_request.quote_request_reference';

    /**
     * the column name for the valid_until field
     */
    public const COL_VALID_UNTIL = 'spy_quote_request.valid_until';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'spy_quote_request.status';

    /**
     * the column name for the is_latest_version_visible field
     */
    public const COL_IS_LATEST_VERSION_VISIBLE = 'spy_quote_request.is_latest_version_visible';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_quote_request.uuid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_quote_request.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_quote_request.updated_at';

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
        self::TYPE_PHPNAME       => ['IdQuoteRequest', 'FkCompanyUser', 'QuoteRequestReference', 'ValidUntil', 'Status', 'IsLatestVersionVisible', 'Uuid', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idQuoteRequest', 'fkCompanyUser', 'quoteRequestReference', 'validUntil', 'status', 'isLatestVersionVisible', 'uuid', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST, SpyQuoteRequestTableMap::COL_FK_COMPANY_USER, SpyQuoteRequestTableMap::COL_QUOTE_REQUEST_REFERENCE, SpyQuoteRequestTableMap::COL_VALID_UNTIL, SpyQuoteRequestTableMap::COL_STATUS, SpyQuoteRequestTableMap::COL_IS_LATEST_VERSION_VISIBLE, SpyQuoteRequestTableMap::COL_UUID, SpyQuoteRequestTableMap::COL_CREATED_AT, SpyQuoteRequestTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_quote_request', 'fk_company_user', 'quote_request_reference', 'valid_until', 'status', 'is_latest_version_visible', 'uuid', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdQuoteRequest' => 0, 'FkCompanyUser' => 1, 'QuoteRequestReference' => 2, 'ValidUntil' => 3, 'Status' => 4, 'IsLatestVersionVisible' => 5, 'Uuid' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idQuoteRequest' => 0, 'fkCompanyUser' => 1, 'quoteRequestReference' => 2, 'validUntil' => 3, 'status' => 4, 'isLatestVersionVisible' => 5, 'uuid' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST => 0, SpyQuoteRequestTableMap::COL_FK_COMPANY_USER => 1, SpyQuoteRequestTableMap::COL_QUOTE_REQUEST_REFERENCE => 2, SpyQuoteRequestTableMap::COL_VALID_UNTIL => 3, SpyQuoteRequestTableMap::COL_STATUS => 4, SpyQuoteRequestTableMap::COL_IS_LATEST_VERSION_VISIBLE => 5, SpyQuoteRequestTableMap::COL_UUID => 6, SpyQuoteRequestTableMap::COL_CREATED_AT => 7, SpyQuoteRequestTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_quote_request' => 0, 'fk_company_user' => 1, 'quote_request_reference' => 2, 'valid_until' => 3, 'status' => 4, 'is_latest_version_visible' => 5, 'uuid' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdQuoteRequest' => 'ID_QUOTE_REQUEST',
        'SpyQuoteRequest.IdQuoteRequest' => 'ID_QUOTE_REQUEST',
        'idQuoteRequest' => 'ID_QUOTE_REQUEST',
        'spyQuoteRequest.idQuoteRequest' => 'ID_QUOTE_REQUEST',
        'SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST' => 'ID_QUOTE_REQUEST',
        'COL_ID_QUOTE_REQUEST' => 'ID_QUOTE_REQUEST',
        'id_quote_request' => 'ID_QUOTE_REQUEST',
        'spy_quote_request.id_quote_request' => 'ID_QUOTE_REQUEST',
        'FkCompanyUser' => 'FK_COMPANY_USER',
        'SpyQuoteRequest.FkCompanyUser' => 'FK_COMPANY_USER',
        'fkCompanyUser' => 'FK_COMPANY_USER',
        'spyQuoteRequest.fkCompanyUser' => 'FK_COMPANY_USER',
        'SpyQuoteRequestTableMap::COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'fk_company_user' => 'FK_COMPANY_USER',
        'spy_quote_request.fk_company_user' => 'FK_COMPANY_USER',
        'QuoteRequestReference' => 'QUOTE_REQUEST_REFERENCE',
        'SpyQuoteRequest.QuoteRequestReference' => 'QUOTE_REQUEST_REFERENCE',
        'quoteRequestReference' => 'QUOTE_REQUEST_REFERENCE',
        'spyQuoteRequest.quoteRequestReference' => 'QUOTE_REQUEST_REFERENCE',
        'SpyQuoteRequestTableMap::COL_QUOTE_REQUEST_REFERENCE' => 'QUOTE_REQUEST_REFERENCE',
        'COL_QUOTE_REQUEST_REFERENCE' => 'QUOTE_REQUEST_REFERENCE',
        'quote_request_reference' => 'QUOTE_REQUEST_REFERENCE',
        'spy_quote_request.quote_request_reference' => 'QUOTE_REQUEST_REFERENCE',
        'ValidUntil' => 'VALID_UNTIL',
        'SpyQuoteRequest.ValidUntil' => 'VALID_UNTIL',
        'validUntil' => 'VALID_UNTIL',
        'spyQuoteRequest.validUntil' => 'VALID_UNTIL',
        'SpyQuoteRequestTableMap::COL_VALID_UNTIL' => 'VALID_UNTIL',
        'COL_VALID_UNTIL' => 'VALID_UNTIL',
        'valid_until' => 'VALID_UNTIL',
        'spy_quote_request.valid_until' => 'VALID_UNTIL',
        'Status' => 'STATUS',
        'SpyQuoteRequest.Status' => 'STATUS',
        'status' => 'STATUS',
        'spyQuoteRequest.status' => 'STATUS',
        'SpyQuoteRequestTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'spy_quote_request.status' => 'STATUS',
        'IsLatestVersionVisible' => 'IS_LATEST_VERSION_VISIBLE',
        'SpyQuoteRequest.IsLatestVersionVisible' => 'IS_LATEST_VERSION_VISIBLE',
        'isLatestVersionVisible' => 'IS_LATEST_VERSION_VISIBLE',
        'spyQuoteRequest.isLatestVersionVisible' => 'IS_LATEST_VERSION_VISIBLE',
        'SpyQuoteRequestTableMap::COL_IS_LATEST_VERSION_VISIBLE' => 'IS_LATEST_VERSION_VISIBLE',
        'COL_IS_LATEST_VERSION_VISIBLE' => 'IS_LATEST_VERSION_VISIBLE',
        'is_latest_version_visible' => 'IS_LATEST_VERSION_VISIBLE',
        'spy_quote_request.is_latest_version_visible' => 'IS_LATEST_VERSION_VISIBLE',
        'Uuid' => 'UUID',
        'SpyQuoteRequest.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyQuoteRequest.uuid' => 'UUID',
        'SpyQuoteRequestTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_quote_request.uuid' => 'UUID',
        'CreatedAt' => 'CREATED_AT',
        'SpyQuoteRequest.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyQuoteRequest.createdAt' => 'CREATED_AT',
        'SpyQuoteRequestTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_quote_request.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyQuoteRequest.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyQuoteRequest.updatedAt' => 'UPDATED_AT',
        'SpyQuoteRequestTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_quote_request.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_quote_request');
        $this->setPhpName('SpyQuoteRequest');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\QuoteRequest\\Persistence\\SpyQuoteRequest');
        $this->setPackage('src.Orm.Zed.QuoteRequest.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_quote_request_pk_seq');
        // columns
        $this->addPrimaryKey('id_quote_request', 'IdQuoteRequest', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_company_user', 'FkCompanyUser', 'INTEGER', 'spy_company_user', 'id_company_user', true, null, null);
        $this->addColumn('quote_request_reference', 'QuoteRequestReference', 'VARCHAR', true, 255, null);
        $this->addColumn('valid_until', 'ValidUntil', 'TIMESTAMP', false, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', false, 255, null);
        $this->addColumn('is_latest_version_visible', 'IsLatestVersionVisible', 'BOOLEAN', false, 1, true);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 255, null);
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
), null, null, null, false);
        $this->addRelation('SpyQuoteRequestVersion', '\\Orm\\Zed\\QuoteRequest\\Persistence\\SpyQuoteRequestVersion', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_quote_request',
    1 => ':id_quote_request',
  ),
), null, null, 'SpyQuoteRequestVersions', false);
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'quote_request_reference'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteRequest', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteRequest', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteRequest', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteRequest', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteRequest', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteRequest', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdQuoteRequest', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyQuoteRequestTableMap::CLASS_DEFAULT : SpyQuoteRequestTableMap::OM_CLASS;
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
     * @return array (SpyQuoteRequest object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyQuoteRequestTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyQuoteRequestTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyQuoteRequestTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyQuoteRequestTableMap::OM_CLASS;
            /** @var SpyQuoteRequest $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyQuoteRequestTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyQuoteRequestTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyQuoteRequestTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyQuoteRequest $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyQuoteRequestTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST);
            $criteria->addSelectColumn(SpyQuoteRequestTableMap::COL_FK_COMPANY_USER);
            $criteria->addSelectColumn(SpyQuoteRequestTableMap::COL_QUOTE_REQUEST_REFERENCE);
            $criteria->addSelectColumn(SpyQuoteRequestTableMap::COL_VALID_UNTIL);
            $criteria->addSelectColumn(SpyQuoteRequestTableMap::COL_STATUS);
            $criteria->addSelectColumn(SpyQuoteRequestTableMap::COL_IS_LATEST_VERSION_VISIBLE);
            $criteria->addSelectColumn(SpyQuoteRequestTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyQuoteRequestTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyQuoteRequestTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_quote_request');
            $criteria->addSelectColumn($alias . '.fk_company_user');
            $criteria->addSelectColumn($alias . '.quote_request_reference');
            $criteria->addSelectColumn($alias . '.valid_until');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.is_latest_version_visible');
            $criteria->addSelectColumn($alias . '.uuid');
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
            $criteria->removeSelectColumn(SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST);
            $criteria->removeSelectColumn(SpyQuoteRequestTableMap::COL_FK_COMPANY_USER);
            $criteria->removeSelectColumn(SpyQuoteRequestTableMap::COL_QUOTE_REQUEST_REFERENCE);
            $criteria->removeSelectColumn(SpyQuoteRequestTableMap::COL_VALID_UNTIL);
            $criteria->removeSelectColumn(SpyQuoteRequestTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SpyQuoteRequestTableMap::COL_IS_LATEST_VERSION_VISIBLE);
            $criteria->removeSelectColumn(SpyQuoteRequestTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyQuoteRequestTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyQuoteRequestTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_quote_request');
            $criteria->removeSelectColumn($alias . '.fk_company_user');
            $criteria->removeSelectColumn($alias . '.quote_request_reference');
            $criteria->removeSelectColumn($alias . '.valid_until');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.is_latest_version_visible');
            $criteria->removeSelectColumn($alias . '.uuid');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyQuoteRequestTableMap::DATABASE_NAME)->getTable(SpyQuoteRequestTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyQuoteRequest or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyQuoteRequest object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteRequestTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequest) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyQuoteRequestTableMap::DATABASE_NAME);
            $criteria->add(SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST, (array) $values, Criteria::IN);
        }

        $query = SpyQuoteRequestQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyQuoteRequestTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyQuoteRequestTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_quote_request table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyQuoteRequestQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyQuoteRequest or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyQuoteRequest object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteRequestTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyQuoteRequest object
        }

        if ($criteria->containsKey(SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST) && $criteria->keyContainsValue(SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyQuoteRequestTableMap::COL_ID_QUOTE_REQUEST.')');
        }


        // Set the correct dbName
        $query = SpyQuoteRequestQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
