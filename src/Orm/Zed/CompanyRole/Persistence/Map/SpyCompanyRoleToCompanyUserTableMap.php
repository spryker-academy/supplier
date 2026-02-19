<?php

namespace Orm\Zed\CompanyRole\Persistence\Map;

use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUserQuery;
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
 * This class defines the structure of the 'spy_company_role_to_company_user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCompanyRoleToCompanyUserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CompanyRole.Persistence.Map.SpyCompanyRoleToCompanyUserTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_company_role_to_company_user';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCompanyRoleToCompanyUser';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CompanyRole\\Persistence\\SpyCompanyRoleToCompanyUser';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CompanyRole.Persistence.SpyCompanyRoleToCompanyUser';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id_company_role_to_company_user field
     */
    public const COL_ID_COMPANY_ROLE_TO_COMPANY_USER = 'spy_company_role_to_company_user.id_company_role_to_company_user';

    /**
     * the column name for the fk_company_role field
     */
    public const COL_FK_COMPANY_ROLE = 'spy_company_role_to_company_user.fk_company_role';

    /**
     * the column name for the fk_company_user field
     */
    public const COL_FK_COMPANY_USER = 'spy_company_role_to_company_user.fk_company_user';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_company_role_to_company_user.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_company_role_to_company_user.updated_at';

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
        self::TYPE_PHPNAME       => ['IdCompanyRoleToCompanyUser', 'FkCompanyRole', 'FkCompanyUser', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idCompanyRoleToCompanyUser', 'fkCompanyRole', 'fkCompanyUser', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyCompanyRoleToCompanyUserTableMap::COL_ID_COMPANY_ROLE_TO_COMPANY_USER, SpyCompanyRoleToCompanyUserTableMap::COL_FK_COMPANY_ROLE, SpyCompanyRoleToCompanyUserTableMap::COL_FK_COMPANY_USER, SpyCompanyRoleToCompanyUserTableMap::COL_CREATED_AT, SpyCompanyRoleToCompanyUserTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_company_role_to_company_user', 'fk_company_role', 'fk_company_user', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
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
        self::TYPE_PHPNAME       => ['IdCompanyRoleToCompanyUser' => 0, 'FkCompanyRole' => 1, 'FkCompanyUser' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, ],
        self::TYPE_CAMELNAME     => ['idCompanyRoleToCompanyUser' => 0, 'fkCompanyRole' => 1, 'fkCompanyUser' => 2, 'createdAt' => 3, 'updatedAt' => 4, ],
        self::TYPE_COLNAME       => [SpyCompanyRoleToCompanyUserTableMap::COL_ID_COMPANY_ROLE_TO_COMPANY_USER => 0, SpyCompanyRoleToCompanyUserTableMap::COL_FK_COMPANY_ROLE => 1, SpyCompanyRoleToCompanyUserTableMap::COL_FK_COMPANY_USER => 2, SpyCompanyRoleToCompanyUserTableMap::COL_CREATED_AT => 3, SpyCompanyRoleToCompanyUserTableMap::COL_UPDATED_AT => 4, ],
        self::TYPE_FIELDNAME     => ['id_company_role_to_company_user' => 0, 'fk_company_role' => 1, 'fk_company_user' => 2, 'created_at' => 3, 'updated_at' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCompanyRoleToCompanyUser' => 'ID_COMPANY_ROLE_TO_COMPANY_USER',
        'SpyCompanyRoleToCompanyUser.IdCompanyRoleToCompanyUser' => 'ID_COMPANY_ROLE_TO_COMPANY_USER',
        'idCompanyRoleToCompanyUser' => 'ID_COMPANY_ROLE_TO_COMPANY_USER',
        'spyCompanyRoleToCompanyUser.idCompanyRoleToCompanyUser' => 'ID_COMPANY_ROLE_TO_COMPANY_USER',
        'SpyCompanyRoleToCompanyUserTableMap::COL_ID_COMPANY_ROLE_TO_COMPANY_USER' => 'ID_COMPANY_ROLE_TO_COMPANY_USER',
        'COL_ID_COMPANY_ROLE_TO_COMPANY_USER' => 'ID_COMPANY_ROLE_TO_COMPANY_USER',
        'id_company_role_to_company_user' => 'ID_COMPANY_ROLE_TO_COMPANY_USER',
        'spy_company_role_to_company_user.id_company_role_to_company_user' => 'ID_COMPANY_ROLE_TO_COMPANY_USER',
        'FkCompanyRole' => 'FK_COMPANY_ROLE',
        'SpyCompanyRoleToCompanyUser.FkCompanyRole' => 'FK_COMPANY_ROLE',
        'fkCompanyRole' => 'FK_COMPANY_ROLE',
        'spyCompanyRoleToCompanyUser.fkCompanyRole' => 'FK_COMPANY_ROLE',
        'SpyCompanyRoleToCompanyUserTableMap::COL_FK_COMPANY_ROLE' => 'FK_COMPANY_ROLE',
        'COL_FK_COMPANY_ROLE' => 'FK_COMPANY_ROLE',
        'fk_company_role' => 'FK_COMPANY_ROLE',
        'spy_company_role_to_company_user.fk_company_role' => 'FK_COMPANY_ROLE',
        'FkCompanyUser' => 'FK_COMPANY_USER',
        'SpyCompanyRoleToCompanyUser.FkCompanyUser' => 'FK_COMPANY_USER',
        'fkCompanyUser' => 'FK_COMPANY_USER',
        'spyCompanyRoleToCompanyUser.fkCompanyUser' => 'FK_COMPANY_USER',
        'SpyCompanyRoleToCompanyUserTableMap::COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'COL_FK_COMPANY_USER' => 'FK_COMPANY_USER',
        'fk_company_user' => 'FK_COMPANY_USER',
        'spy_company_role_to_company_user.fk_company_user' => 'FK_COMPANY_USER',
        'CreatedAt' => 'CREATED_AT',
        'SpyCompanyRoleToCompanyUser.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyCompanyRoleToCompanyUser.createdAt' => 'CREATED_AT',
        'SpyCompanyRoleToCompanyUserTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_company_role_to_company_user.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyCompanyRoleToCompanyUser.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyCompanyRoleToCompanyUser.updatedAt' => 'UPDATED_AT',
        'SpyCompanyRoleToCompanyUserTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_company_role_to_company_user.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_company_role_to_company_user');
        $this->setPhpName('SpyCompanyRoleToCompanyUser');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\CompanyRole\\Persistence\\SpyCompanyRoleToCompanyUser');
        $this->setPackage('src.Orm.Zed.CompanyRole.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_company_role_to_company_user_pk_seq');
        $this->setIsCrossRef(true);
        // columns
        $this->addPrimaryKey('id_company_role_to_company_user', 'IdCompanyRoleToCompanyUser', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_company_role', 'FkCompanyRole', 'INTEGER', 'spy_company_role', 'id_company_role', true, null, null);
        $this->addForeignKey('fk_company_user', 'FkCompanyUser', 'INTEGER', 'spy_company_user', 'id_company_user', true, null, null);
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
        $this->addRelation('CompanyRole', '\\Orm\\Zed\\CompanyRole\\Persistence\\SpyCompanyRole', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_company_role',
    1 => ':id_company_role',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('CompanyUser', '\\Orm\\Zed\\CompanyUser\\Persistence\\SpyCompanyUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_company_user',
    1 => ':id_company_user',
  ),
), 'CASCADE', null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyRoleToCompanyUser', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyRoleToCompanyUser', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyRoleToCompanyUser', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyRoleToCompanyUser', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyRoleToCompanyUser', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyRoleToCompanyUser', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCompanyRoleToCompanyUser', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCompanyRoleToCompanyUserTableMap::CLASS_DEFAULT : SpyCompanyRoleToCompanyUserTableMap::OM_CLASS;
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
     * @return array (SpyCompanyRoleToCompanyUser object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCompanyRoleToCompanyUserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCompanyRoleToCompanyUserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCompanyRoleToCompanyUserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCompanyRoleToCompanyUserTableMap::OM_CLASS;
            /** @var SpyCompanyRoleToCompanyUser $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCompanyRoleToCompanyUserTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCompanyRoleToCompanyUserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCompanyRoleToCompanyUserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCompanyRoleToCompanyUser $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCompanyRoleToCompanyUserTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCompanyRoleToCompanyUserTableMap::COL_ID_COMPANY_ROLE_TO_COMPANY_USER);
            $criteria->addSelectColumn(SpyCompanyRoleToCompanyUserTableMap::COL_FK_COMPANY_ROLE);
            $criteria->addSelectColumn(SpyCompanyRoleToCompanyUserTableMap::COL_FK_COMPANY_USER);
            $criteria->addSelectColumn(SpyCompanyRoleToCompanyUserTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyCompanyRoleToCompanyUserTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_company_role_to_company_user');
            $criteria->addSelectColumn($alias . '.fk_company_role');
            $criteria->addSelectColumn($alias . '.fk_company_user');
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
            $criteria->removeSelectColumn(SpyCompanyRoleToCompanyUserTableMap::COL_ID_COMPANY_ROLE_TO_COMPANY_USER);
            $criteria->removeSelectColumn(SpyCompanyRoleToCompanyUserTableMap::COL_FK_COMPANY_ROLE);
            $criteria->removeSelectColumn(SpyCompanyRoleToCompanyUserTableMap::COL_FK_COMPANY_USER);
            $criteria->removeSelectColumn(SpyCompanyRoleToCompanyUserTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyCompanyRoleToCompanyUserTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_company_role_to_company_user');
            $criteria->removeSelectColumn($alias . '.fk_company_role');
            $criteria->removeSelectColumn($alias . '.fk_company_user');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCompanyRoleToCompanyUserTableMap::DATABASE_NAME)->getTable(SpyCompanyRoleToCompanyUserTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCompanyRoleToCompanyUser or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCompanyRoleToCompanyUser object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyRoleToCompanyUserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToCompanyUser) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCompanyRoleToCompanyUserTableMap::DATABASE_NAME);
            $criteria->add(SpyCompanyRoleToCompanyUserTableMap::COL_ID_COMPANY_ROLE_TO_COMPANY_USER, (array) $values, Criteria::IN);
        }

        $query = SpyCompanyRoleToCompanyUserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCompanyRoleToCompanyUserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCompanyRoleToCompanyUserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_company_role_to_company_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCompanyRoleToCompanyUserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCompanyRoleToCompanyUser or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCompanyRoleToCompanyUser object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyRoleToCompanyUserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCompanyRoleToCompanyUser object
        }


        // Set the correct dbName
        $query = SpyCompanyRoleToCompanyUserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
