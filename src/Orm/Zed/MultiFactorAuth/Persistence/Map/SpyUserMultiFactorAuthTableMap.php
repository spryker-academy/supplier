<?php

namespace Orm\Zed\MultiFactorAuth\Persistence\Map;

use Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuth;
use Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuthQuery;
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
 * This class defines the structure of the 'spy_user_multi_factor_auth' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyUserMultiFactorAuthTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MultiFactorAuth.Persistence.Map.SpyUserMultiFactorAuthTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_user_multi_factor_auth';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyUserMultiFactorAuth';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MultiFactorAuth\\Persistence\\SpyUserMultiFactorAuth';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MultiFactorAuth.Persistence.SpyUserMultiFactorAuth';

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
     * the column name for the id_user_multi_factor_auth field
     */
    public const COL_ID_USER_MULTI_FACTOR_AUTH = 'spy_user_multi_factor_auth.id_user_multi_factor_auth';

    /**
     * the column name for the fk_user field
     */
    public const COL_FK_USER = 'spy_user_multi_factor_auth.fk_user';

    /**
     * the column name for the type field
     */
    public const COL_TYPE = 'spy_user_multi_factor_auth.type';

    /**
     * the column name for the configuration field
     */
    public const COL_CONFIGURATION = 'spy_user_multi_factor_auth.configuration';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'spy_user_multi_factor_auth.status';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_user_multi_factor_auth.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_user_multi_factor_auth.updated_at';

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
        self::TYPE_PHPNAME       => ['IdUserMultiFactorAuth', 'FkUser', 'Type', 'Configuration', 'Status', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idUserMultiFactorAuth', 'fkUser', 'type', 'configuration', 'status', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyUserMultiFactorAuthTableMap::COL_ID_USER_MULTI_FACTOR_AUTH, SpyUserMultiFactorAuthTableMap::COL_FK_USER, SpyUserMultiFactorAuthTableMap::COL_TYPE, SpyUserMultiFactorAuthTableMap::COL_CONFIGURATION, SpyUserMultiFactorAuthTableMap::COL_STATUS, SpyUserMultiFactorAuthTableMap::COL_CREATED_AT, SpyUserMultiFactorAuthTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_user_multi_factor_auth', 'fk_user', 'type', 'configuration', 'status', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdUserMultiFactorAuth' => 0, 'FkUser' => 1, 'Type' => 2, 'Configuration' => 3, 'Status' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idUserMultiFactorAuth' => 0, 'fkUser' => 1, 'type' => 2, 'configuration' => 3, 'status' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyUserMultiFactorAuthTableMap::COL_ID_USER_MULTI_FACTOR_AUTH => 0, SpyUserMultiFactorAuthTableMap::COL_FK_USER => 1, SpyUserMultiFactorAuthTableMap::COL_TYPE => 2, SpyUserMultiFactorAuthTableMap::COL_CONFIGURATION => 3, SpyUserMultiFactorAuthTableMap::COL_STATUS => 4, SpyUserMultiFactorAuthTableMap::COL_CREATED_AT => 5, SpyUserMultiFactorAuthTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_user_multi_factor_auth' => 0, 'fk_user' => 1, 'type' => 2, 'configuration' => 3, 'status' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdUserMultiFactorAuth' => 'ID_USER_MULTI_FACTOR_AUTH',
        'SpyUserMultiFactorAuth.IdUserMultiFactorAuth' => 'ID_USER_MULTI_FACTOR_AUTH',
        'idUserMultiFactorAuth' => 'ID_USER_MULTI_FACTOR_AUTH',
        'spyUserMultiFactorAuth.idUserMultiFactorAuth' => 'ID_USER_MULTI_FACTOR_AUTH',
        'SpyUserMultiFactorAuthTableMap::COL_ID_USER_MULTI_FACTOR_AUTH' => 'ID_USER_MULTI_FACTOR_AUTH',
        'COL_ID_USER_MULTI_FACTOR_AUTH' => 'ID_USER_MULTI_FACTOR_AUTH',
        'id_user_multi_factor_auth' => 'ID_USER_MULTI_FACTOR_AUTH',
        'spy_user_multi_factor_auth.id_user_multi_factor_auth' => 'ID_USER_MULTI_FACTOR_AUTH',
        'FkUser' => 'FK_USER',
        'SpyUserMultiFactorAuth.FkUser' => 'FK_USER',
        'fkUser' => 'FK_USER',
        'spyUserMultiFactorAuth.fkUser' => 'FK_USER',
        'SpyUserMultiFactorAuthTableMap::COL_FK_USER' => 'FK_USER',
        'COL_FK_USER' => 'FK_USER',
        'fk_user' => 'FK_USER',
        'spy_user_multi_factor_auth.fk_user' => 'FK_USER',
        'Type' => 'TYPE',
        'SpyUserMultiFactorAuth.Type' => 'TYPE',
        'type' => 'TYPE',
        'spyUserMultiFactorAuth.type' => 'TYPE',
        'SpyUserMultiFactorAuthTableMap::COL_TYPE' => 'TYPE',
        'COL_TYPE' => 'TYPE',
        'spy_user_multi_factor_auth.type' => 'TYPE',
        'Configuration' => 'CONFIGURATION',
        'SpyUserMultiFactorAuth.Configuration' => 'CONFIGURATION',
        'configuration' => 'CONFIGURATION',
        'spyUserMultiFactorAuth.configuration' => 'CONFIGURATION',
        'SpyUserMultiFactorAuthTableMap::COL_CONFIGURATION' => 'CONFIGURATION',
        'COL_CONFIGURATION' => 'CONFIGURATION',
        'spy_user_multi_factor_auth.configuration' => 'CONFIGURATION',
        'Status' => 'STATUS',
        'SpyUserMultiFactorAuth.Status' => 'STATUS',
        'status' => 'STATUS',
        'spyUserMultiFactorAuth.status' => 'STATUS',
        'SpyUserMultiFactorAuthTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'spy_user_multi_factor_auth.status' => 'STATUS',
        'CreatedAt' => 'CREATED_AT',
        'SpyUserMultiFactorAuth.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyUserMultiFactorAuth.createdAt' => 'CREATED_AT',
        'SpyUserMultiFactorAuthTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_user_multi_factor_auth.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyUserMultiFactorAuth.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyUserMultiFactorAuth.updatedAt' => 'UPDATED_AT',
        'SpyUserMultiFactorAuthTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_user_multi_factor_auth.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_user_multi_factor_auth');
        $this->setPhpName('SpyUserMultiFactorAuth');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\MultiFactorAuth\\Persistence\\SpyUserMultiFactorAuth');
        $this->setPackage('src.Orm.Zed.MultiFactorAuth.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_user_multi_factor_auth_pk_seq');
        // columns
        $this->addPrimaryKey('id_user_multi_factor_auth', 'IdUserMultiFactorAuth', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_user', 'FkUser', 'INTEGER', 'spy_user', 'id_user', true, null, null);
        $this->addColumn('type', 'Type', 'VARCHAR', true, 50, null);
        $this->addColumn('configuration', 'Configuration', 'VARCHAR', false, 255, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, null, 0);
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
        $this->addRelation('SpyUser', '\\Orm\\Zed\\User\\Persistence\\SpyUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_user',
    1 => ':id_user',
  ),
), null, null, null, false);
        $this->addRelation('SpyUserMultiFactorAuthCodes', '\\Orm\\Zed\\MultiFactorAuth\\Persistence\\SpyUserMultiFactorAuthCodes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_user_multi_factor_auth',
    1 => ':id_user_multi_factor_auth',
  ),
), null, null, 'SpyUserMultiFactorAuthCodess', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUserMultiFactorAuth', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUserMultiFactorAuth', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUserMultiFactorAuth', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUserMultiFactorAuth', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUserMultiFactorAuth', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUserMultiFactorAuth', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdUserMultiFactorAuth', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyUserMultiFactorAuthTableMap::CLASS_DEFAULT : SpyUserMultiFactorAuthTableMap::OM_CLASS;
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
     * @return array (SpyUserMultiFactorAuth object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyUserMultiFactorAuthTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyUserMultiFactorAuthTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyUserMultiFactorAuthTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyUserMultiFactorAuthTableMap::OM_CLASS;
            /** @var SpyUserMultiFactorAuth $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyUserMultiFactorAuthTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyUserMultiFactorAuthTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyUserMultiFactorAuthTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyUserMultiFactorAuth $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyUserMultiFactorAuthTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyUserMultiFactorAuthTableMap::COL_ID_USER_MULTI_FACTOR_AUTH);
            $criteria->addSelectColumn(SpyUserMultiFactorAuthTableMap::COL_FK_USER);
            $criteria->addSelectColumn(SpyUserMultiFactorAuthTableMap::COL_TYPE);
            $criteria->addSelectColumn(SpyUserMultiFactorAuthTableMap::COL_CONFIGURATION);
            $criteria->addSelectColumn(SpyUserMultiFactorAuthTableMap::COL_STATUS);
            $criteria->addSelectColumn(SpyUserMultiFactorAuthTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyUserMultiFactorAuthTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_user_multi_factor_auth');
            $criteria->addSelectColumn($alias . '.fk_user');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.configuration');
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
            $criteria->removeSelectColumn(SpyUserMultiFactorAuthTableMap::COL_ID_USER_MULTI_FACTOR_AUTH);
            $criteria->removeSelectColumn(SpyUserMultiFactorAuthTableMap::COL_FK_USER);
            $criteria->removeSelectColumn(SpyUserMultiFactorAuthTableMap::COL_TYPE);
            $criteria->removeSelectColumn(SpyUserMultiFactorAuthTableMap::COL_CONFIGURATION);
            $criteria->removeSelectColumn(SpyUserMultiFactorAuthTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SpyUserMultiFactorAuthTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyUserMultiFactorAuthTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_user_multi_factor_auth');
            $criteria->removeSelectColumn($alias . '.fk_user');
            $criteria->removeSelectColumn($alias . '.type');
            $criteria->removeSelectColumn($alias . '.configuration');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyUserMultiFactorAuthTableMap::DATABASE_NAME)->getTable(SpyUserMultiFactorAuthTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyUserMultiFactorAuth or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyUserMultiFactorAuth object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyUserMultiFactorAuthTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MultiFactorAuth\Persistence\SpyUserMultiFactorAuth) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyUserMultiFactorAuthTableMap::DATABASE_NAME);
            $criteria->add(SpyUserMultiFactorAuthTableMap::COL_ID_USER_MULTI_FACTOR_AUTH, (array) $values, Criteria::IN);
        }

        $query = SpyUserMultiFactorAuthQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyUserMultiFactorAuthTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyUserMultiFactorAuthTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_user_multi_factor_auth table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyUserMultiFactorAuthQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyUserMultiFactorAuth or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyUserMultiFactorAuth object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyUserMultiFactorAuthTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyUserMultiFactorAuth object
        }

        if ($criteria->containsKey(SpyUserMultiFactorAuthTableMap::COL_ID_USER_MULTI_FACTOR_AUTH) && $criteria->keyContainsValue(SpyUserMultiFactorAuthTableMap::COL_ID_USER_MULTI_FACTOR_AUTH) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyUserMultiFactorAuthTableMap::COL_ID_USER_MULTI_FACTOR_AUTH.')');
        }


        // Set the correct dbName
        $query = SpyUserMultiFactorAuthQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
