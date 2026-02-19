<?php

namespace Orm\Zed\SharedCart\Persistence\Map;

use Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermission;
use Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermissionQuery;
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
 * This class defines the structure of the 'spy_quote_permission_group_to_permission' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyQuotePermissionGroupToPermissionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SharedCart.Persistence.Map.SpyQuotePermissionGroupToPermissionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_quote_permission_group_to_permission';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyQuotePermissionGroupToPermission';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SharedCart\\Persistence\\SpyQuotePermissionGroupToPermission';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SharedCart.Persistence.SpyQuotePermissionGroupToPermission';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the id_quote_permission_group_to_permission field
     */
    public const COL_ID_QUOTE_PERMISSION_GROUP_TO_PERMISSION = 'spy_quote_permission_group_to_permission.id_quote_permission_group_to_permission';

    /**
     * the column name for the fk_permission field
     */
    public const COL_FK_PERMISSION = 'spy_quote_permission_group_to_permission.fk_permission';

    /**
     * the column name for the fk_quote_permission_group field
     */
    public const COL_FK_QUOTE_PERMISSION_GROUP = 'spy_quote_permission_group_to_permission.fk_quote_permission_group';

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
        self::TYPE_PHPNAME       => ['IdQuotePermissionGroupToPermission', 'FkPermission', 'FkQuotePermissionGroup', ],
        self::TYPE_CAMELNAME     => ['idQuotePermissionGroupToPermission', 'fkPermission', 'fkQuotePermissionGroup', ],
        self::TYPE_COLNAME       => [SpyQuotePermissionGroupToPermissionTableMap::COL_ID_QUOTE_PERMISSION_GROUP_TO_PERMISSION, SpyQuotePermissionGroupToPermissionTableMap::COL_FK_PERMISSION, SpyQuotePermissionGroupToPermissionTableMap::COL_FK_QUOTE_PERMISSION_GROUP, ],
        self::TYPE_FIELDNAME     => ['id_quote_permission_group_to_permission', 'fk_permission', 'fk_quote_permission_group', ],
        self::TYPE_NUM           => [0, 1, 2, ]
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
        self::TYPE_PHPNAME       => ['IdQuotePermissionGroupToPermission' => 0, 'FkPermission' => 1, 'FkQuotePermissionGroup' => 2, ],
        self::TYPE_CAMELNAME     => ['idQuotePermissionGroupToPermission' => 0, 'fkPermission' => 1, 'fkQuotePermissionGroup' => 2, ],
        self::TYPE_COLNAME       => [SpyQuotePermissionGroupToPermissionTableMap::COL_ID_QUOTE_PERMISSION_GROUP_TO_PERMISSION => 0, SpyQuotePermissionGroupToPermissionTableMap::COL_FK_PERMISSION => 1, SpyQuotePermissionGroupToPermissionTableMap::COL_FK_QUOTE_PERMISSION_GROUP => 2, ],
        self::TYPE_FIELDNAME     => ['id_quote_permission_group_to_permission' => 0, 'fk_permission' => 1, 'fk_quote_permission_group' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdQuotePermissionGroupToPermission' => 'ID_QUOTE_PERMISSION_GROUP_TO_PERMISSION',
        'SpyQuotePermissionGroupToPermission.IdQuotePermissionGroupToPermission' => 'ID_QUOTE_PERMISSION_GROUP_TO_PERMISSION',
        'idQuotePermissionGroupToPermission' => 'ID_QUOTE_PERMISSION_GROUP_TO_PERMISSION',
        'spyQuotePermissionGroupToPermission.idQuotePermissionGroupToPermission' => 'ID_QUOTE_PERMISSION_GROUP_TO_PERMISSION',
        'SpyQuotePermissionGroupToPermissionTableMap::COL_ID_QUOTE_PERMISSION_GROUP_TO_PERMISSION' => 'ID_QUOTE_PERMISSION_GROUP_TO_PERMISSION',
        'COL_ID_QUOTE_PERMISSION_GROUP_TO_PERMISSION' => 'ID_QUOTE_PERMISSION_GROUP_TO_PERMISSION',
        'id_quote_permission_group_to_permission' => 'ID_QUOTE_PERMISSION_GROUP_TO_PERMISSION',
        'spy_quote_permission_group_to_permission.id_quote_permission_group_to_permission' => 'ID_QUOTE_PERMISSION_GROUP_TO_PERMISSION',
        'FkPermission' => 'FK_PERMISSION',
        'SpyQuotePermissionGroupToPermission.FkPermission' => 'FK_PERMISSION',
        'fkPermission' => 'FK_PERMISSION',
        'spyQuotePermissionGroupToPermission.fkPermission' => 'FK_PERMISSION',
        'SpyQuotePermissionGroupToPermissionTableMap::COL_FK_PERMISSION' => 'FK_PERMISSION',
        'COL_FK_PERMISSION' => 'FK_PERMISSION',
        'fk_permission' => 'FK_PERMISSION',
        'spy_quote_permission_group_to_permission.fk_permission' => 'FK_PERMISSION',
        'FkQuotePermissionGroup' => 'FK_QUOTE_PERMISSION_GROUP',
        'SpyQuotePermissionGroupToPermission.FkQuotePermissionGroup' => 'FK_QUOTE_PERMISSION_GROUP',
        'fkQuotePermissionGroup' => 'FK_QUOTE_PERMISSION_GROUP',
        'spyQuotePermissionGroupToPermission.fkQuotePermissionGroup' => 'FK_QUOTE_PERMISSION_GROUP',
        'SpyQuotePermissionGroupToPermissionTableMap::COL_FK_QUOTE_PERMISSION_GROUP' => 'FK_QUOTE_PERMISSION_GROUP',
        'COL_FK_QUOTE_PERMISSION_GROUP' => 'FK_QUOTE_PERMISSION_GROUP',
        'fk_quote_permission_group' => 'FK_QUOTE_PERMISSION_GROUP',
        'spy_quote_permission_group_to_permission.fk_quote_permission_group' => 'FK_QUOTE_PERMISSION_GROUP',
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
        $this->setName('spy_quote_permission_group_to_permission');
        $this->setPhpName('SpyQuotePermissionGroupToPermission');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SharedCart\\Persistence\\SpyQuotePermissionGroupToPermission');
        $this->setPackage('src.Orm.Zed.SharedCart.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_quote_permission_group_to_permission_pk_seq');
        // columns
        $this->addPrimaryKey('id_quote_permission_group_to_permission', 'IdQuotePermissionGroupToPermission', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_permission', 'FkPermission', 'INTEGER', 'spy_permission', 'id_permission', true, null, null);
        $this->addForeignKey('fk_quote_permission_group', 'FkQuotePermissionGroup', 'INTEGER', 'spy_quote_permission_group', 'id_quote_permission_group', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Permission', '\\Orm\\Zed\\Permission\\Persistence\\SpyPermission', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_permission',
    1 => ':id_permission',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('QuotePermissionGroup', '\\Orm\\Zed\\SharedCart\\Persistence\\SpyQuotePermissionGroup', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_quote_permission_group',
    1 => ':id_quote_permission_group',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuotePermissionGroupToPermission', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuotePermissionGroupToPermission', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuotePermissionGroupToPermission', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuotePermissionGroupToPermission', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuotePermissionGroupToPermission', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuotePermissionGroupToPermission', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdQuotePermissionGroupToPermission', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyQuotePermissionGroupToPermissionTableMap::CLASS_DEFAULT : SpyQuotePermissionGroupToPermissionTableMap::OM_CLASS;
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
     * @return array (SpyQuotePermissionGroupToPermission object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyQuotePermissionGroupToPermissionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyQuotePermissionGroupToPermissionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyQuotePermissionGroupToPermissionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyQuotePermissionGroupToPermissionTableMap::OM_CLASS;
            /** @var SpyQuotePermissionGroupToPermission $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyQuotePermissionGroupToPermissionTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyQuotePermissionGroupToPermissionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyQuotePermissionGroupToPermissionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyQuotePermissionGroupToPermission $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyQuotePermissionGroupToPermissionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyQuotePermissionGroupToPermissionTableMap::COL_ID_QUOTE_PERMISSION_GROUP_TO_PERMISSION);
            $criteria->addSelectColumn(SpyQuotePermissionGroupToPermissionTableMap::COL_FK_PERMISSION);
            $criteria->addSelectColumn(SpyQuotePermissionGroupToPermissionTableMap::COL_FK_QUOTE_PERMISSION_GROUP);
        } else {
            $criteria->addSelectColumn($alias . '.id_quote_permission_group_to_permission');
            $criteria->addSelectColumn($alias . '.fk_permission');
            $criteria->addSelectColumn($alias . '.fk_quote_permission_group');
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
            $criteria->removeSelectColumn(SpyQuotePermissionGroupToPermissionTableMap::COL_ID_QUOTE_PERMISSION_GROUP_TO_PERMISSION);
            $criteria->removeSelectColumn(SpyQuotePermissionGroupToPermissionTableMap::COL_FK_PERMISSION);
            $criteria->removeSelectColumn(SpyQuotePermissionGroupToPermissionTableMap::COL_FK_QUOTE_PERMISSION_GROUP);
        } else {
            $criteria->removeSelectColumn($alias . '.id_quote_permission_group_to_permission');
            $criteria->removeSelectColumn($alias . '.fk_permission');
            $criteria->removeSelectColumn($alias . '.fk_quote_permission_group');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyQuotePermissionGroupToPermissionTableMap::DATABASE_NAME)->getTable(SpyQuotePermissionGroupToPermissionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyQuotePermissionGroupToPermission or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyQuotePermissionGroupToPermission object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuotePermissionGroupToPermissionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SharedCart\Persistence\SpyQuotePermissionGroupToPermission) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyQuotePermissionGroupToPermissionTableMap::DATABASE_NAME);
            $criteria->add(SpyQuotePermissionGroupToPermissionTableMap::COL_ID_QUOTE_PERMISSION_GROUP_TO_PERMISSION, (array) $values, Criteria::IN);
        }

        $query = SpyQuotePermissionGroupToPermissionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyQuotePermissionGroupToPermissionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyQuotePermissionGroupToPermissionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_quote_permission_group_to_permission table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyQuotePermissionGroupToPermissionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyQuotePermissionGroupToPermission or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyQuotePermissionGroupToPermission object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuotePermissionGroupToPermissionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyQuotePermissionGroupToPermission object
        }


        // Set the correct dbName
        $query = SpyQuotePermissionGroupToPermissionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
