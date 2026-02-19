<?php

namespace Orm\Zed\QuoteRequest\Persistence\Map;

use Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersion;
use Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersionQuery;
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
 * This class defines the structure of the 'spy_quote_request_version' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyQuoteRequestVersionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.QuoteRequest.Persistence.Map.SpyQuoteRequestVersionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_quote_request_version';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyQuoteRequestVersion';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\QuoteRequest\\Persistence\\SpyQuoteRequestVersion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.QuoteRequest.Persistence.SpyQuoteRequestVersion';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id_quote_request_version field
     */
    public const COL_ID_QUOTE_REQUEST_VERSION = 'spy_quote_request_version.id_quote_request_version';

    /**
     * the column name for the fk_quote_request field
     */
    public const COL_FK_QUOTE_REQUEST = 'spy_quote_request_version.fk_quote_request';

    /**
     * the column name for the version field
     */
    public const COL_VERSION = 'spy_quote_request_version.version';

    /**
     * the column name for the version_reference field
     */
    public const COL_VERSION_REFERENCE = 'spy_quote_request_version.version_reference';

    /**
     * the column name for the metadata field
     */
    public const COL_METADATA = 'spy_quote_request_version.metadata';

    /**
     * the column name for the quote field
     */
    public const COL_QUOTE = 'spy_quote_request_version.quote';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_quote_request_version.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_quote_request_version.updated_at';

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
        self::TYPE_PHPNAME       => ['IdQuoteRequestVersion', 'FkQuoteRequest', 'Version', 'VersionReference', 'Metadata', 'Quote', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idQuoteRequestVersion', 'fkQuoteRequest', 'version', 'versionReference', 'metadata', 'quote', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyQuoteRequestVersionTableMap::COL_ID_QUOTE_REQUEST_VERSION, SpyQuoteRequestVersionTableMap::COL_FK_QUOTE_REQUEST, SpyQuoteRequestVersionTableMap::COL_VERSION, SpyQuoteRequestVersionTableMap::COL_VERSION_REFERENCE, SpyQuoteRequestVersionTableMap::COL_METADATA, SpyQuoteRequestVersionTableMap::COL_QUOTE, SpyQuoteRequestVersionTableMap::COL_CREATED_AT, SpyQuoteRequestVersionTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_quote_request_version', 'fk_quote_request', 'version', 'version_reference', 'metadata', 'quote', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['IdQuoteRequestVersion' => 0, 'FkQuoteRequest' => 1, 'Version' => 2, 'VersionReference' => 3, 'Metadata' => 4, 'Quote' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idQuoteRequestVersion' => 0, 'fkQuoteRequest' => 1, 'version' => 2, 'versionReference' => 3, 'metadata' => 4, 'quote' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyQuoteRequestVersionTableMap::COL_ID_QUOTE_REQUEST_VERSION => 0, SpyQuoteRequestVersionTableMap::COL_FK_QUOTE_REQUEST => 1, SpyQuoteRequestVersionTableMap::COL_VERSION => 2, SpyQuoteRequestVersionTableMap::COL_VERSION_REFERENCE => 3, SpyQuoteRequestVersionTableMap::COL_METADATA => 4, SpyQuoteRequestVersionTableMap::COL_QUOTE => 5, SpyQuoteRequestVersionTableMap::COL_CREATED_AT => 6, SpyQuoteRequestVersionTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_quote_request_version' => 0, 'fk_quote_request' => 1, 'version' => 2, 'version_reference' => 3, 'metadata' => 4, 'quote' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdQuoteRequestVersion' => 'ID_QUOTE_REQUEST_VERSION',
        'SpyQuoteRequestVersion.IdQuoteRequestVersion' => 'ID_QUOTE_REQUEST_VERSION',
        'idQuoteRequestVersion' => 'ID_QUOTE_REQUEST_VERSION',
        'spyQuoteRequestVersion.idQuoteRequestVersion' => 'ID_QUOTE_REQUEST_VERSION',
        'SpyQuoteRequestVersionTableMap::COL_ID_QUOTE_REQUEST_VERSION' => 'ID_QUOTE_REQUEST_VERSION',
        'COL_ID_QUOTE_REQUEST_VERSION' => 'ID_QUOTE_REQUEST_VERSION',
        'id_quote_request_version' => 'ID_QUOTE_REQUEST_VERSION',
        'spy_quote_request_version.id_quote_request_version' => 'ID_QUOTE_REQUEST_VERSION',
        'FkQuoteRequest' => 'FK_QUOTE_REQUEST',
        'SpyQuoteRequestVersion.FkQuoteRequest' => 'FK_QUOTE_REQUEST',
        'fkQuoteRequest' => 'FK_QUOTE_REQUEST',
        'spyQuoteRequestVersion.fkQuoteRequest' => 'FK_QUOTE_REQUEST',
        'SpyQuoteRequestVersionTableMap::COL_FK_QUOTE_REQUEST' => 'FK_QUOTE_REQUEST',
        'COL_FK_QUOTE_REQUEST' => 'FK_QUOTE_REQUEST',
        'fk_quote_request' => 'FK_QUOTE_REQUEST',
        'spy_quote_request_version.fk_quote_request' => 'FK_QUOTE_REQUEST',
        'Version' => 'VERSION',
        'SpyQuoteRequestVersion.Version' => 'VERSION',
        'version' => 'VERSION',
        'spyQuoteRequestVersion.version' => 'VERSION',
        'SpyQuoteRequestVersionTableMap::COL_VERSION' => 'VERSION',
        'COL_VERSION' => 'VERSION',
        'spy_quote_request_version.version' => 'VERSION',
        'VersionReference' => 'VERSION_REFERENCE',
        'SpyQuoteRequestVersion.VersionReference' => 'VERSION_REFERENCE',
        'versionReference' => 'VERSION_REFERENCE',
        'spyQuoteRequestVersion.versionReference' => 'VERSION_REFERENCE',
        'SpyQuoteRequestVersionTableMap::COL_VERSION_REFERENCE' => 'VERSION_REFERENCE',
        'COL_VERSION_REFERENCE' => 'VERSION_REFERENCE',
        'version_reference' => 'VERSION_REFERENCE',
        'spy_quote_request_version.version_reference' => 'VERSION_REFERENCE',
        'Metadata' => 'METADATA',
        'SpyQuoteRequestVersion.Metadata' => 'METADATA',
        'metadata' => 'METADATA',
        'spyQuoteRequestVersion.metadata' => 'METADATA',
        'SpyQuoteRequestVersionTableMap::COL_METADATA' => 'METADATA',
        'COL_METADATA' => 'METADATA',
        'spy_quote_request_version.metadata' => 'METADATA',
        'Quote' => 'QUOTE',
        'SpyQuoteRequestVersion.Quote' => 'QUOTE',
        'quote' => 'QUOTE',
        'spyQuoteRequestVersion.quote' => 'QUOTE',
        'SpyQuoteRequestVersionTableMap::COL_QUOTE' => 'QUOTE',
        'COL_QUOTE' => 'QUOTE',
        'spy_quote_request_version.quote' => 'QUOTE',
        'CreatedAt' => 'CREATED_AT',
        'SpyQuoteRequestVersion.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyQuoteRequestVersion.createdAt' => 'CREATED_AT',
        'SpyQuoteRequestVersionTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_quote_request_version.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyQuoteRequestVersion.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyQuoteRequestVersion.updatedAt' => 'UPDATED_AT',
        'SpyQuoteRequestVersionTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_quote_request_version.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_quote_request_version');
        $this->setPhpName('SpyQuoteRequestVersion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\QuoteRequest\\Persistence\\SpyQuoteRequestVersion');
        $this->setPackage('src.Orm.Zed.QuoteRequest.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_quote_request_version_pk_seq');
        // columns
        $this->addPrimaryKey('id_quote_request_version', 'IdQuoteRequestVersion', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_quote_request', 'FkQuoteRequest', 'INTEGER', 'spy_quote_request', 'id_quote_request', true, null, null);
        $this->addColumn('version', 'Version', 'INTEGER', true, null, null);
        $this->addColumn('version_reference', 'VersionReference', 'VARCHAR', false, 255, null);
        $this->addColumn('metadata', 'Metadata', 'LONGVARCHAR', false, null, null);
        $this->addColumn('quote', 'Quote', 'CLOB', false, null, null);
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
        $this->addRelation('SpyQuoteRequest', '\\Orm\\Zed\\QuoteRequest\\Persistence\\SpyQuoteRequest', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_quote_request',
    1 => ':id_quote_request',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteRequestVersion', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteRequestVersion', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteRequestVersion', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteRequestVersion', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteRequestVersion', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteRequestVersion', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdQuoteRequestVersion', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyQuoteRequestVersionTableMap::CLASS_DEFAULT : SpyQuoteRequestVersionTableMap::OM_CLASS;
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
     * @return array (SpyQuoteRequestVersion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyQuoteRequestVersionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyQuoteRequestVersionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyQuoteRequestVersionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyQuoteRequestVersionTableMap::OM_CLASS;
            /** @var SpyQuoteRequestVersion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyQuoteRequestVersionTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyQuoteRequestVersionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyQuoteRequestVersionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyQuoteRequestVersion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyQuoteRequestVersionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyQuoteRequestVersionTableMap::COL_ID_QUOTE_REQUEST_VERSION);
            $criteria->addSelectColumn(SpyQuoteRequestVersionTableMap::COL_FK_QUOTE_REQUEST);
            $criteria->addSelectColumn(SpyQuoteRequestVersionTableMap::COL_VERSION);
            $criteria->addSelectColumn(SpyQuoteRequestVersionTableMap::COL_VERSION_REFERENCE);
            $criteria->addSelectColumn(SpyQuoteRequestVersionTableMap::COL_METADATA);
            $criteria->addSelectColumn(SpyQuoteRequestVersionTableMap::COL_QUOTE);
            $criteria->addSelectColumn(SpyQuoteRequestVersionTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyQuoteRequestVersionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_quote_request_version');
            $criteria->addSelectColumn($alias . '.fk_quote_request');
            $criteria->addSelectColumn($alias . '.version');
            $criteria->addSelectColumn($alias . '.version_reference');
            $criteria->addSelectColumn($alias . '.metadata');
            $criteria->addSelectColumn($alias . '.quote');
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
            $criteria->removeSelectColumn(SpyQuoteRequestVersionTableMap::COL_ID_QUOTE_REQUEST_VERSION);
            $criteria->removeSelectColumn(SpyQuoteRequestVersionTableMap::COL_FK_QUOTE_REQUEST);
            $criteria->removeSelectColumn(SpyQuoteRequestVersionTableMap::COL_VERSION);
            $criteria->removeSelectColumn(SpyQuoteRequestVersionTableMap::COL_VERSION_REFERENCE);
            $criteria->removeSelectColumn(SpyQuoteRequestVersionTableMap::COL_METADATA);
            $criteria->removeSelectColumn(SpyQuoteRequestVersionTableMap::COL_QUOTE);
            $criteria->removeSelectColumn(SpyQuoteRequestVersionTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyQuoteRequestVersionTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_quote_request_version');
            $criteria->removeSelectColumn($alias . '.fk_quote_request');
            $criteria->removeSelectColumn($alias . '.version');
            $criteria->removeSelectColumn($alias . '.version_reference');
            $criteria->removeSelectColumn($alias . '.metadata');
            $criteria->removeSelectColumn($alias . '.quote');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyQuoteRequestVersionTableMap::DATABASE_NAME)->getTable(SpyQuoteRequestVersionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyQuoteRequestVersion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyQuoteRequestVersion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteRequestVersionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\QuoteRequest\Persistence\SpyQuoteRequestVersion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyQuoteRequestVersionTableMap::DATABASE_NAME);
            $criteria->add(SpyQuoteRequestVersionTableMap::COL_ID_QUOTE_REQUEST_VERSION, (array) $values, Criteria::IN);
        }

        $query = SpyQuoteRequestVersionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyQuoteRequestVersionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyQuoteRequestVersionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_quote_request_version table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyQuoteRequestVersionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyQuoteRequestVersion or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyQuoteRequestVersion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteRequestVersionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyQuoteRequestVersion object
        }

        if ($criteria->containsKey(SpyQuoteRequestVersionTableMap::COL_ID_QUOTE_REQUEST_VERSION) && $criteria->keyContainsValue(SpyQuoteRequestVersionTableMap::COL_ID_QUOTE_REQUEST_VERSION) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyQuoteRequestVersionTableMap::COL_ID_QUOTE_REQUEST_VERSION.')');
        }


        // Set the correct dbName
        $query = SpyQuoteRequestVersionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
