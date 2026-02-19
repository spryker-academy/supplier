<?php

namespace Orm\Zed\MerchantUser\Persistence\Map;

use Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUser;
use Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUserQuery;
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
 * This class defines the structure of the 'spy_acl_entity_segment_merchant_user' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyAclEntitySegmentMerchantUserTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MerchantUser.Persistence.Map.SpyAclEntitySegmentMerchantUserTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_acl_entity_segment_merchant_user';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyAclEntitySegmentMerchantUser';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MerchantUser\\Persistence\\SpyAclEntitySegmentMerchantUser';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MerchantUser.Persistence.SpyAclEntitySegmentMerchantUser';

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
     * the column name for the id_acl_entity_segment_merchant_user field
     */
    public const COL_ID_ACL_ENTITY_SEGMENT_MERCHANT_USER = 'spy_acl_entity_segment_merchant_user.id_acl_entity_segment_merchant_user';

    /**
     * the column name for the fk_merchant_user field
     */
    public const COL_FK_MERCHANT_USER = 'spy_acl_entity_segment_merchant_user.fk_merchant_user';

    /**
     * the column name for the fk_acl_entity_segment field
     */
    public const COL_FK_ACL_ENTITY_SEGMENT = 'spy_acl_entity_segment_merchant_user.fk_acl_entity_segment';

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
        self::TYPE_PHPNAME       => ['IdAclEntitySegmentMerchantUser', 'FkMerchantUser', 'FkAclEntitySegment', ],
        self::TYPE_CAMELNAME     => ['idAclEntitySegmentMerchantUser', 'fkMerchantUser', 'fkAclEntitySegment', ],
        self::TYPE_COLNAME       => [SpyAclEntitySegmentMerchantUserTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT_USER, SpyAclEntitySegmentMerchantUserTableMap::COL_FK_MERCHANT_USER, SpyAclEntitySegmentMerchantUserTableMap::COL_FK_ACL_ENTITY_SEGMENT, ],
        self::TYPE_FIELDNAME     => ['id_acl_entity_segment_merchant_user', 'fk_merchant_user', 'fk_acl_entity_segment', ],
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
        self::TYPE_PHPNAME       => ['IdAclEntitySegmentMerchantUser' => 0, 'FkMerchantUser' => 1, 'FkAclEntitySegment' => 2, ],
        self::TYPE_CAMELNAME     => ['idAclEntitySegmentMerchantUser' => 0, 'fkMerchantUser' => 1, 'fkAclEntitySegment' => 2, ],
        self::TYPE_COLNAME       => [SpyAclEntitySegmentMerchantUserTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT_USER => 0, SpyAclEntitySegmentMerchantUserTableMap::COL_FK_MERCHANT_USER => 1, SpyAclEntitySegmentMerchantUserTableMap::COL_FK_ACL_ENTITY_SEGMENT => 2, ],
        self::TYPE_FIELDNAME     => ['id_acl_entity_segment_merchant_user' => 0, 'fk_merchant_user' => 1, 'fk_acl_entity_segment' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdAclEntitySegmentMerchantUser' => 'ID_ACL_ENTITY_SEGMENT_MERCHANT_USER',
        'SpyAclEntitySegmentMerchantUser.IdAclEntitySegmentMerchantUser' => 'ID_ACL_ENTITY_SEGMENT_MERCHANT_USER',
        'idAclEntitySegmentMerchantUser' => 'ID_ACL_ENTITY_SEGMENT_MERCHANT_USER',
        'spyAclEntitySegmentMerchantUser.idAclEntitySegmentMerchantUser' => 'ID_ACL_ENTITY_SEGMENT_MERCHANT_USER',
        'SpyAclEntitySegmentMerchantUserTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT_USER' => 'ID_ACL_ENTITY_SEGMENT_MERCHANT_USER',
        'COL_ID_ACL_ENTITY_SEGMENT_MERCHANT_USER' => 'ID_ACL_ENTITY_SEGMENT_MERCHANT_USER',
        'id_acl_entity_segment_merchant_user' => 'ID_ACL_ENTITY_SEGMENT_MERCHANT_USER',
        'spy_acl_entity_segment_merchant_user.id_acl_entity_segment_merchant_user' => 'ID_ACL_ENTITY_SEGMENT_MERCHANT_USER',
        'FkMerchantUser' => 'FK_MERCHANT_USER',
        'SpyAclEntitySegmentMerchantUser.FkMerchantUser' => 'FK_MERCHANT_USER',
        'fkMerchantUser' => 'FK_MERCHANT_USER',
        'spyAclEntitySegmentMerchantUser.fkMerchantUser' => 'FK_MERCHANT_USER',
        'SpyAclEntitySegmentMerchantUserTableMap::COL_FK_MERCHANT_USER' => 'FK_MERCHANT_USER',
        'COL_FK_MERCHANT_USER' => 'FK_MERCHANT_USER',
        'fk_merchant_user' => 'FK_MERCHANT_USER',
        'spy_acl_entity_segment_merchant_user.fk_merchant_user' => 'FK_MERCHANT_USER',
        'FkAclEntitySegment' => 'FK_ACL_ENTITY_SEGMENT',
        'SpyAclEntitySegmentMerchantUser.FkAclEntitySegment' => 'FK_ACL_ENTITY_SEGMENT',
        'fkAclEntitySegment' => 'FK_ACL_ENTITY_SEGMENT',
        'spyAclEntitySegmentMerchantUser.fkAclEntitySegment' => 'FK_ACL_ENTITY_SEGMENT',
        'SpyAclEntitySegmentMerchantUserTableMap::COL_FK_ACL_ENTITY_SEGMENT' => 'FK_ACL_ENTITY_SEGMENT',
        'COL_FK_ACL_ENTITY_SEGMENT' => 'FK_ACL_ENTITY_SEGMENT',
        'fk_acl_entity_segment' => 'FK_ACL_ENTITY_SEGMENT',
        'spy_acl_entity_segment_merchant_user.fk_acl_entity_segment' => 'FK_ACL_ENTITY_SEGMENT',
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
        $this->setName('spy_acl_entity_segment_merchant_user');
        $this->setPhpName('SpyAclEntitySegmentMerchantUser');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\MerchantUser\\Persistence\\SpyAclEntitySegmentMerchantUser');
        $this->setPackage('src.Orm.Zed.MerchantUser.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_acl_entity_segment_merchant_user_seq');
        // columns
        $this->addPrimaryKey('id_acl_entity_segment_merchant_user', 'IdAclEntitySegmentMerchantUser', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_merchant_user', 'FkMerchantUser', 'INTEGER', 'spy_merchant_user', 'id_merchant_user', true, null, null);
        $this->addForeignKey('fk_acl_entity_segment', 'FkAclEntitySegment', 'INTEGER', 'spy_acl_entity_segment', 'id_acl_entity_segment', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyMerchantUser', '\\Orm\\Zed\\MerchantUser\\Persistence\\SpyMerchantUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_merchant_user',
    1 => ':id_merchant_user',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyAclEntitySegment', '\\Orm\\Zed\\AclEntity\\Persistence\\SpyAclEntitySegment', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_acl_entity_segment',
    1 => ':id_acl_entity_segment',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntitySegmentMerchantUser', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntitySegmentMerchantUser', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntitySegmentMerchantUser', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntitySegmentMerchantUser', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntitySegmentMerchantUser', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntitySegmentMerchantUser', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdAclEntitySegmentMerchantUser', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyAclEntitySegmentMerchantUserTableMap::CLASS_DEFAULT : SpyAclEntitySegmentMerchantUserTableMap::OM_CLASS;
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
     * @return array (SpyAclEntitySegmentMerchantUser object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyAclEntitySegmentMerchantUserTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyAclEntitySegmentMerchantUserTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyAclEntitySegmentMerchantUserTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyAclEntitySegmentMerchantUserTableMap::OM_CLASS;
            /** @var SpyAclEntitySegmentMerchantUser $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyAclEntitySegmentMerchantUserTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyAclEntitySegmentMerchantUserTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyAclEntitySegmentMerchantUserTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyAclEntitySegmentMerchantUser $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyAclEntitySegmentMerchantUserTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyAclEntitySegmentMerchantUserTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT_USER);
            $criteria->addSelectColumn(SpyAclEntitySegmentMerchantUserTableMap::COL_FK_MERCHANT_USER);
            $criteria->addSelectColumn(SpyAclEntitySegmentMerchantUserTableMap::COL_FK_ACL_ENTITY_SEGMENT);
        } else {
            $criteria->addSelectColumn($alias . '.id_acl_entity_segment_merchant_user');
            $criteria->addSelectColumn($alias . '.fk_merchant_user');
            $criteria->addSelectColumn($alias . '.fk_acl_entity_segment');
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
            $criteria->removeSelectColumn(SpyAclEntitySegmentMerchantUserTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT_USER);
            $criteria->removeSelectColumn(SpyAclEntitySegmentMerchantUserTableMap::COL_FK_MERCHANT_USER);
            $criteria->removeSelectColumn(SpyAclEntitySegmentMerchantUserTableMap::COL_FK_ACL_ENTITY_SEGMENT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_acl_entity_segment_merchant_user');
            $criteria->removeSelectColumn($alias . '.fk_merchant_user');
            $criteria->removeSelectColumn($alias . '.fk_acl_entity_segment');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyAclEntitySegmentMerchantUserTableMap::DATABASE_NAME)->getTable(SpyAclEntitySegmentMerchantUserTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyAclEntitySegmentMerchantUser or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyAclEntitySegmentMerchantUser object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclEntitySegmentMerchantUserTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MerchantUser\Persistence\SpyAclEntitySegmentMerchantUser) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyAclEntitySegmentMerchantUserTableMap::DATABASE_NAME);
            $criteria->add(SpyAclEntitySegmentMerchantUserTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT_USER, (array) $values, Criteria::IN);
        }

        $query = SpyAclEntitySegmentMerchantUserQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyAclEntitySegmentMerchantUserTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyAclEntitySegmentMerchantUserTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_acl_entity_segment_merchant_user table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyAclEntitySegmentMerchantUserQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyAclEntitySegmentMerchantUser or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyAclEntitySegmentMerchantUser object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclEntitySegmentMerchantUserTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyAclEntitySegmentMerchantUser object
        }

        if ($criteria->containsKey(SpyAclEntitySegmentMerchantUserTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT_USER) && $criteria->keyContainsValue(SpyAclEntitySegmentMerchantUserTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT_USER) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyAclEntitySegmentMerchantUserTableMap::COL_ID_ACL_ENTITY_SEGMENT_MERCHANT_USER.')');
        }


        // Set the correct dbName
        $query = SpyAclEntitySegmentMerchantUserQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
