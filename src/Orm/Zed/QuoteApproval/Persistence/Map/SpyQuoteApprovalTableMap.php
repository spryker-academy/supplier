<?php

namespace Orm\Zed\QuoteApproval\Persistence\Map;

use Orm\Zed\QuoteApproval\Persistence\SpyQuoteApproval;
use Orm\Zed\QuoteApproval\Persistence\SpyQuoteApprovalQuery;
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
 * This class defines the structure of the 'spy_quote_approval' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyQuoteApprovalTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.QuoteApproval.Persistence.Map.SpyQuoteApprovalTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_quote_approval';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyQuoteApproval';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\QuoteApproval\\Persistence\\SpyQuoteApproval';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.QuoteApproval.Persistence.SpyQuoteApproval';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id_quote_approval field
     */
    public const COL_ID_QUOTE_APPROVAL = 'spy_quote_approval.id_quote_approval';

    /**
     * the column name for the fk_quote field
     */
    public const COL_FK_QUOTE = 'spy_quote_approval.fk_quote';

    /**
     * the column name for the fk_company_user field
     */
    public const COL_FK_COMPANY_USER = 'spy_quote_approval.fk_company_user';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'spy_quote_approval.status';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_quote_approval.uuid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_quote_approval.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_quote_approval.updated_at';

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
        self::TYPE_PHPNAME       => ['IdQuoteApproval', 'FkQuote', 'FkCompanyUser', 'Status', 'Uuid', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idQuoteApproval', 'fkQuote', 'fkCompanyUser', 'status', 'uuid', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyQuoteApprovalTableMap::COL_ID_QUOTE_APPROVAL, SpyQuoteApprovalTableMap::COL_FK_QUOTE, SpyQuoteApprovalTableMap::COL_FK_COMPANY_USER, SpyQuoteApprovalTableMap::COL_STATUS, SpyQuoteApprovalTableMap::COL_UUID, SpyQuoteApprovalTableMap::COL_CREATED_AT, SpyQuoteApprovalTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_quote_approval', 'fk_quote', 'fk_company_user', 'status', 'uuid', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
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
        self::TYPE_PHPNAME       => ['IdQuoteApproval' => 0, 'FkQuote' => 1, 'FkCompanyUser' => 2, 'Status' => 3, 'Uuid' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idQuoteApproval' => 0, 'fkQuote' => 1, 'fkCompanyUser' => 2, 'status' => 3, 'uuid' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyQuoteApprovalTableMap::COL_ID_QUOTE_APPROVAL => 0, SpyQuoteApprovalTableMap::COL_FK_QUOTE => 1, SpyQuoteApprovalTableMap::COL_FK_COMPANY_USER => 2, SpyQuoteApprovalTableMap::COL_STATUS => 3, SpyQuoteApprovalTableMap::COL_UUID => 4, SpyQuoteApprovalTableMap::COL_CREATED_AT => 5, SpyQuoteApprovalTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_quote_approval' => 0, 'fk_quote' => 1, 'fk_company_user' => 2, 'status' => 3, 'uuid' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdQuoteApproval' => 'ID_QUOTE_APPROVAL',
        'SpyQuoteApproval.IdQuoteApproval' => 'ID_QUOTE_APPROVAL',
        'idQuoteApproval' => 'ID_QUOTE_APPROVAL',
        'spyQuoteApproval.idQuoteApproval' => 'ID_QUOTE_APPROVAL',
        'SpyQuoteApprovalTableMap::COL_ID_QUOTE_APPROVAL' => 'ID_QUOTE_APPROVAL',
        'COL_ID_QUOTE_APPROVAL' => 'ID_QUOTE_APPROVAL',
        'id_quote_approval' => 'ID_QUOTE_APPROVAL',
        'spy_quote_approval.id_quote_approval' => 'ID_QUOTE_APPROVAL',
        'FkQuote' => 'FK_QUOTE',
        'SpyQuoteApproval.FkQuote' => 'FK_QUOTE',
        'fkQuote' => 'FK_QUOTE',
        'spyQuoteApproval.fkQuote' => 'FK_QUOTE',
        'SpyQuoteApprovalTableMap::COL_FK_QUOTE' => 'FK_QUOTE',
        'COL_FK_QUOTE' => 'FK_QUOTE',
        'fk_quote' => 'FK_QUOTE',
        'spy_quote_approval.fk_quote' => 'FK_QUOTE',
        'FkCompanyUser' => 'FK_COMPANY_USER',
        'SpyQuoteApproval.FkCompanyUser' => 'FK_COMPANY_USER',
        'fkCompanyUser' => 'FK_COMPANY_USER',
        'spyQuoteApproval.fkCompanyUser' => 'FK_COMPANY_USER',
        'SpyQuoteApprovalTableMap::COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'fk_company_user' => 'FK_COMPANY_USER',
        'spy_quote_approval.fk_company_user' => 'FK_COMPANY_USER',
        'Status' => 'STATUS',
        'SpyQuoteApproval.Status' => 'STATUS',
        'status' => 'STATUS',
        'spyQuoteApproval.status' => 'STATUS',
        'SpyQuoteApprovalTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'spy_quote_approval.status' => 'STATUS',
        'Uuid' => 'UUID',
        'SpyQuoteApproval.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyQuoteApproval.uuid' => 'UUID',
        'SpyQuoteApprovalTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_quote_approval.uuid' => 'UUID',
        'CreatedAt' => 'CREATED_AT',
        'SpyQuoteApproval.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyQuoteApproval.createdAt' => 'CREATED_AT',
        'SpyQuoteApprovalTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_quote_approval.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyQuoteApproval.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyQuoteApproval.updatedAt' => 'UPDATED_AT',
        'SpyQuoteApprovalTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_quote_approval.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_quote_approval');
        $this->setPhpName('SpyQuoteApproval');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\QuoteApproval\\Persistence\\SpyQuoteApproval');
        $this->setPackage('src.Orm.Zed.QuoteApproval.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_quote_approval_pk_seq');
        // columns
        $this->addPrimaryKey('id_quote_approval', 'IdQuoteApproval', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_quote', 'FkQuote', 'INTEGER', 'spy_quote', 'id_quote', true, null, null);
        $this->addForeignKey('fk_company_user', 'FkCompanyUser', 'INTEGER', 'spy_company_user', 'id_company_user', true, null, null);
        $this->addColumn('status', 'Status', 'VARCHAR', true, 255, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 36, null);
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
        $this->addRelation('SpyQuote', '\\Orm\\Zed\\Quote\\Persistence\\SpyQuote', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_quote',
    1 => ':id_quote',
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_quote_approval.fk_company_user.fk_quote'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteApproval', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteApproval', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteApproval', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteApproval', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteApproval', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteApproval', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdQuoteApproval', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyQuoteApprovalTableMap::CLASS_DEFAULT : SpyQuoteApprovalTableMap::OM_CLASS;
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
     * @return array (SpyQuoteApproval object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyQuoteApprovalTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyQuoteApprovalTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyQuoteApprovalTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyQuoteApprovalTableMap::OM_CLASS;
            /** @var SpyQuoteApproval $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyQuoteApprovalTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyQuoteApprovalTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyQuoteApprovalTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyQuoteApproval $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyQuoteApprovalTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyQuoteApprovalTableMap::COL_ID_QUOTE_APPROVAL);
            $criteria->addSelectColumn(SpyQuoteApprovalTableMap::COL_FK_QUOTE);
            $criteria->addSelectColumn(SpyQuoteApprovalTableMap::COL_FK_COMPANY_USER);
            $criteria->addSelectColumn(SpyQuoteApprovalTableMap::COL_STATUS);
            $criteria->addSelectColumn(SpyQuoteApprovalTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyQuoteApprovalTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyQuoteApprovalTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_quote_approval');
            $criteria->addSelectColumn($alias . '.fk_quote');
            $criteria->addSelectColumn($alias . '.fk_company_user');
            $criteria->addSelectColumn($alias . '.status');
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
            $criteria->removeSelectColumn(SpyQuoteApprovalTableMap::COL_ID_QUOTE_APPROVAL);
            $criteria->removeSelectColumn(SpyQuoteApprovalTableMap::COL_FK_QUOTE);
            $criteria->removeSelectColumn(SpyQuoteApprovalTableMap::COL_FK_COMPANY_USER);
            $criteria->removeSelectColumn(SpyQuoteApprovalTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SpyQuoteApprovalTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyQuoteApprovalTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyQuoteApprovalTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_quote_approval');
            $criteria->removeSelectColumn($alias . '.fk_quote');
            $criteria->removeSelectColumn($alias . '.fk_company_user');
            $criteria->removeSelectColumn($alias . '.status');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyQuoteApprovalTableMap::DATABASE_NAME)->getTable(SpyQuoteApprovalTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyQuoteApproval or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyQuoteApproval object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteApprovalTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\QuoteApproval\Persistence\SpyQuoteApproval) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyQuoteApprovalTableMap::DATABASE_NAME);
            $criteria->add(SpyQuoteApprovalTableMap::COL_ID_QUOTE_APPROVAL, (array) $values, Criteria::IN);
        }

        $query = SpyQuoteApprovalQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyQuoteApprovalTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyQuoteApprovalTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_quote_approval table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyQuoteApprovalQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyQuoteApproval or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyQuoteApproval object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteApprovalTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyQuoteApproval object
        }


        // Set the correct dbName
        $query = SpyQuoteApprovalQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
