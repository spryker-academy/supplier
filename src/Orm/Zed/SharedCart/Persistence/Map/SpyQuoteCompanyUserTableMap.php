<?php

namespace Orm\Zed\SharedCart\Persistence\Map;

use Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUser;
use Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUserQuery;
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
 * This class defines the structure of the 'spy_quote_company_user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyQuoteCompanyUserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SharedCart.Persistence.Map.SpyQuoteCompanyUserTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_quote_company_user';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyQuoteCompanyUser';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SharedCart\\Persistence\\SpyQuoteCompanyUser';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SharedCart.Persistence.SpyQuoteCompanyUser';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the id_quote_company_user field
     */
    public const COL_ID_QUOTE_COMPANY_USER = 'spy_quote_company_user.id_quote_company_user';

    /**
     * the column name for the fk_company_user field
     */
    public const COL_FK_COMPANY_USER = 'spy_quote_company_user.fk_company_user';

    /**
     * the column name for the fk_quote field
     */
    public const COL_FK_QUOTE = 'spy_quote_company_user.fk_quote';

    /**
     * the column name for the fk_quote_permission_group field
     */
    public const COL_FK_QUOTE_PERMISSION_GROUP = 'spy_quote_company_user.fk_quote_permission_group';

    /**
     * the column name for the is_default field
     */
    public const COL_IS_DEFAULT = 'spy_quote_company_user.is_default';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_quote_company_user.uuid';

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
        self::TYPE_PHPNAME       => ['IdQuoteCompanyUser', 'FkCompanyUser', 'FkQuote', 'FkQuotePermissionGroup', 'IsDefault', 'Uuid', ],
        self::TYPE_CAMELNAME     => ['idQuoteCompanyUser', 'fkCompanyUser', 'fkQuote', 'fkQuotePermissionGroup', 'isDefault', 'uuid', ],
        self::TYPE_COLNAME       => [SpyQuoteCompanyUserTableMap::COL_ID_QUOTE_COMPANY_USER, SpyQuoteCompanyUserTableMap::COL_FK_COMPANY_USER, SpyQuoteCompanyUserTableMap::COL_FK_QUOTE, SpyQuoteCompanyUserTableMap::COL_FK_QUOTE_PERMISSION_GROUP, SpyQuoteCompanyUserTableMap::COL_IS_DEFAULT, SpyQuoteCompanyUserTableMap::COL_UUID, ],
        self::TYPE_FIELDNAME     => ['id_quote_company_user', 'fk_company_user', 'fk_quote', 'fk_quote_permission_group', 'is_default', 'uuid', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['IdQuoteCompanyUser' => 0, 'FkCompanyUser' => 1, 'FkQuote' => 2, 'FkQuotePermissionGroup' => 3, 'IsDefault' => 4, 'Uuid' => 5, ],
        self::TYPE_CAMELNAME     => ['idQuoteCompanyUser' => 0, 'fkCompanyUser' => 1, 'fkQuote' => 2, 'fkQuotePermissionGroup' => 3, 'isDefault' => 4, 'uuid' => 5, ],
        self::TYPE_COLNAME       => [SpyQuoteCompanyUserTableMap::COL_ID_QUOTE_COMPANY_USER => 0, SpyQuoteCompanyUserTableMap::COL_FK_COMPANY_USER => 1, SpyQuoteCompanyUserTableMap::COL_FK_QUOTE => 2, SpyQuoteCompanyUserTableMap::COL_FK_QUOTE_PERMISSION_GROUP => 3, SpyQuoteCompanyUserTableMap::COL_IS_DEFAULT => 4, SpyQuoteCompanyUserTableMap::COL_UUID => 5, ],
        self::TYPE_FIELDNAME     => ['id_quote_company_user' => 0, 'fk_company_user' => 1, 'fk_quote' => 2, 'fk_quote_permission_group' => 3, 'is_default' => 4, 'uuid' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdQuoteCompanyUser' => 'ID_QUOTE_COMPANY_USER',
        'SpyQuoteCompanyUser.IdQuoteCompanyUser' => 'ID_QUOTE_COMPANY_USER',
        'idQuoteCompanyUser' => 'ID_QUOTE_COMPANY_USER',
        'spyQuoteCompanyUser.idQuoteCompanyUser' => 'ID_QUOTE_COMPANY_USER',
        'SpyQuoteCompanyUserTableMap::COL_ID_QUOTE_COMPANY_USER' => 'ID_QUOTE_COMPANY_USER',
        'COL_ID_QUOTE_COMPANY_USER' => 'ID_QUOTE_COMPANY_USER',
        'id_quote_company_user' => 'ID_QUOTE_COMPANY_USER',
        'spy_quote_company_user.id_quote_company_user' => 'ID_QUOTE_COMPANY_USER',
        'FkCompanyUser' => 'FK_COMPANY_USER',
        'SpyQuoteCompanyUser.FkCompanyUser' => 'FK_COMPANY_USER',
        'fkCompanyUser' => 'FK_COMPANY_USER',
        'spyQuoteCompanyUser.fkCompanyUser' => 'FK_COMPANY_USER',
        'SpyQuoteCompanyUserTableMap::COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'fk_company_user' => 'FK_COMPANY_USER',
        'spy_quote_company_user.fk_company_user' => 'FK_COMPANY_USER',
        'FkQuote' => 'FK_QUOTE',
        'SpyQuoteCompanyUser.FkQuote' => 'FK_QUOTE',
        'fkQuote' => 'FK_QUOTE',
        'spyQuoteCompanyUser.fkQuote' => 'FK_QUOTE',
        'SpyQuoteCompanyUserTableMap::COL_FK_QUOTE' => 'FK_QUOTE',
        'COL_FK_QUOTE' => 'FK_QUOTE',
        'fk_quote' => 'FK_QUOTE',
        'spy_quote_company_user.fk_quote' => 'FK_QUOTE',
        'FkQuotePermissionGroup' => 'FK_QUOTE_PERMISSION_GROUP',
        'SpyQuoteCompanyUser.FkQuotePermissionGroup' => 'FK_QUOTE_PERMISSION_GROUP',
        'fkQuotePermissionGroup' => 'FK_QUOTE_PERMISSION_GROUP',
        'spyQuoteCompanyUser.fkQuotePermissionGroup' => 'FK_QUOTE_PERMISSION_GROUP',
        'SpyQuoteCompanyUserTableMap::COL_FK_QUOTE_PERMISSION_GROUP' => 'FK_QUOTE_PERMISSION_GROUP',
        'COL_FK_QUOTE_PERMISSION_GROUP' => 'FK_QUOTE_PERMISSION_GROUP',
        'fk_quote_permission_group' => 'FK_QUOTE_PERMISSION_GROUP',
        'spy_quote_company_user.fk_quote_permission_group' => 'FK_QUOTE_PERMISSION_GROUP',
        'IsDefault' => 'IS_DEFAULT',
        'SpyQuoteCompanyUser.IsDefault' => 'IS_DEFAULT',
        'isDefault' => 'IS_DEFAULT',
        'spyQuoteCompanyUser.isDefault' => 'IS_DEFAULT',
        'SpyQuoteCompanyUserTableMap::COL_IS_DEFAULT' => 'IS_DEFAULT',
        'COL_IS_DEFAULT' => 'IS_DEFAULT',
        'is_default' => 'IS_DEFAULT',
        'spy_quote_company_user.is_default' => 'IS_DEFAULT',
        'Uuid' => 'UUID',
        'SpyQuoteCompanyUser.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyQuoteCompanyUser.uuid' => 'UUID',
        'SpyQuoteCompanyUserTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_quote_company_user.uuid' => 'UUID',
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
        $this->setName('spy_quote_company_user');
        $this->setPhpName('SpyQuoteCompanyUser');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SharedCart\\Persistence\\SpyQuoteCompanyUser');
        $this->setPackage('src.Orm.Zed.SharedCart.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_quote_company_user_pk_seq');
        // columns
        $this->addPrimaryKey('id_quote_company_user', 'IdQuoteCompanyUser', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_company_user', 'FkCompanyUser', 'INTEGER', 'spy_company_user', 'id_company_user', true, null, null);
        $this->addForeignKey('fk_quote', 'FkQuote', 'INTEGER', 'spy_quote', 'id_quote', true, null, null);
        $this->addForeignKey('fk_quote_permission_group', 'FkQuotePermissionGroup', 'INTEGER', 'spy_quote_permission_group', 'id_quote_permission_group', true, null, null);
        $this->addColumn('is_default', 'IsDefault', 'BOOLEAN', true, 1, true);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 255, null);
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
        $this->addRelation('SpyQuotePermissionGroup', '\\Orm\\Zed\\SharedCart\\Persistence\\SpyQuotePermissionGroup', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_quote_permission_group',
    1 => ':id_quote_permission_group',
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'fk_company_user.fk_quote.fk_quote_permission_group'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteCompanyUser', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteCompanyUser', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteCompanyUser', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteCompanyUser', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteCompanyUser', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuoteCompanyUser', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdQuoteCompanyUser', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyQuoteCompanyUserTableMap::CLASS_DEFAULT : SpyQuoteCompanyUserTableMap::OM_CLASS;
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
     * @return array (SpyQuoteCompanyUser object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyQuoteCompanyUserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyQuoteCompanyUserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyQuoteCompanyUserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyQuoteCompanyUserTableMap::OM_CLASS;
            /** @var SpyQuoteCompanyUser $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyQuoteCompanyUserTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyQuoteCompanyUserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyQuoteCompanyUserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyQuoteCompanyUser $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyQuoteCompanyUserTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyQuoteCompanyUserTableMap::COL_ID_QUOTE_COMPANY_USER);
            $criteria->addSelectColumn(SpyQuoteCompanyUserTableMap::COL_FK_COMPANY_USER);
            $criteria->addSelectColumn(SpyQuoteCompanyUserTableMap::COL_FK_QUOTE);
            $criteria->addSelectColumn(SpyQuoteCompanyUserTableMap::COL_FK_QUOTE_PERMISSION_GROUP);
            $criteria->addSelectColumn(SpyQuoteCompanyUserTableMap::COL_IS_DEFAULT);
            $criteria->addSelectColumn(SpyQuoteCompanyUserTableMap::COL_UUID);
        } else {
            $criteria->addSelectColumn($alias . '.id_quote_company_user');
            $criteria->addSelectColumn($alias . '.fk_company_user');
            $criteria->addSelectColumn($alias . '.fk_quote');
            $criteria->addSelectColumn($alias . '.fk_quote_permission_group');
            $criteria->addSelectColumn($alias . '.is_default');
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
            $criteria->removeSelectColumn(SpyQuoteCompanyUserTableMap::COL_ID_QUOTE_COMPANY_USER);
            $criteria->removeSelectColumn(SpyQuoteCompanyUserTableMap::COL_FK_COMPANY_USER);
            $criteria->removeSelectColumn(SpyQuoteCompanyUserTableMap::COL_FK_QUOTE);
            $criteria->removeSelectColumn(SpyQuoteCompanyUserTableMap::COL_FK_QUOTE_PERMISSION_GROUP);
            $criteria->removeSelectColumn(SpyQuoteCompanyUserTableMap::COL_IS_DEFAULT);
            $criteria->removeSelectColumn(SpyQuoteCompanyUserTableMap::COL_UUID);
        } else {
            $criteria->removeSelectColumn($alias . '.id_quote_company_user');
            $criteria->removeSelectColumn($alias . '.fk_company_user');
            $criteria->removeSelectColumn($alias . '.fk_quote');
            $criteria->removeSelectColumn($alias . '.fk_quote_permission_group');
            $criteria->removeSelectColumn($alias . '.is_default');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyQuoteCompanyUserTableMap::DATABASE_NAME)->getTable(SpyQuoteCompanyUserTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyQuoteCompanyUser or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyQuoteCompanyUser object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteCompanyUserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SharedCart\Persistence\SpyQuoteCompanyUser) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyQuoteCompanyUserTableMap::DATABASE_NAME);
            $criteria->add(SpyQuoteCompanyUserTableMap::COL_ID_QUOTE_COMPANY_USER, (array) $values, Criteria::IN);
        }

        $query = SpyQuoteCompanyUserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyQuoteCompanyUserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyQuoteCompanyUserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_quote_company_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyQuoteCompanyUserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyQuoteCompanyUser or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyQuoteCompanyUser object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteCompanyUserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyQuoteCompanyUser object
        }


        // Set the correct dbName
        $query = SpyQuoteCompanyUserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
