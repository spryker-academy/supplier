<?php

namespace Orm\Zed\AclEntity\Persistence\Map;

use Orm\Zed\AclEntity\Persistence\SpyAclEntitySegment;
use Orm\Zed\AclEntity\Persistence\SpyAclEntitySegmentQuery;
use Orm\Zed\MerchantUser\Persistence\Map\SpyAclEntitySegmentMerchantUserTableMap;
use Orm\Zed\Merchant\Persistence\Map\SpyAclEntitySegmentMerchantTableMap;
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
 * This class defines the structure of the 'spy_acl_entity_segment' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyAclEntitySegmentTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.AclEntity.Persistence.Map.SpyAclEntitySegmentTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_acl_entity_segment';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyAclEntitySegment';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\AclEntity\\Persistence\\SpyAclEntitySegment';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.AclEntity.Persistence.SpyAclEntitySegment';

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
     * the column name for the id_acl_entity_segment field
     */
    public const COL_ID_ACL_ENTITY_SEGMENT = 'spy_acl_entity_segment.id_acl_entity_segment';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_acl_entity_segment.name';

    /**
     * the column name for the reference field
     */
    public const COL_REFERENCE = 'spy_acl_entity_segment.reference';

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
        self::TYPE_PHPNAME       => ['IdAclEntitySegment', 'Name', 'Reference', ],
        self::TYPE_CAMELNAME     => ['idAclEntitySegment', 'name', 'reference', ],
        self::TYPE_COLNAME       => [SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT, SpyAclEntitySegmentTableMap::COL_NAME, SpyAclEntitySegmentTableMap::COL_REFERENCE, ],
        self::TYPE_FIELDNAME     => ['id_acl_entity_segment', 'name', 'reference', ],
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
        self::TYPE_PHPNAME       => ['IdAclEntitySegment' => 0, 'Name' => 1, 'Reference' => 2, ],
        self::TYPE_CAMELNAME     => ['idAclEntitySegment' => 0, 'name' => 1, 'reference' => 2, ],
        self::TYPE_COLNAME       => [SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT => 0, SpyAclEntitySegmentTableMap::COL_NAME => 1, SpyAclEntitySegmentTableMap::COL_REFERENCE => 2, ],
        self::TYPE_FIELDNAME     => ['id_acl_entity_segment' => 0, 'name' => 1, 'reference' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdAclEntitySegment' => 'ID_ACL_ENTITY_SEGMENT',
        'SpyAclEntitySegment.IdAclEntitySegment' => 'ID_ACL_ENTITY_SEGMENT',
        'idAclEntitySegment' => 'ID_ACL_ENTITY_SEGMENT',
        'spyAclEntitySegment.idAclEntitySegment' => 'ID_ACL_ENTITY_SEGMENT',
        'SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT' => 'ID_ACL_ENTITY_SEGMENT',
        'COL_ID_ACL_ENTITY_SEGMENT' => 'ID_ACL_ENTITY_SEGMENT',
        'id_acl_entity_segment' => 'ID_ACL_ENTITY_SEGMENT',
        'spy_acl_entity_segment.id_acl_entity_segment' => 'ID_ACL_ENTITY_SEGMENT',
        'Name' => 'NAME',
        'SpyAclEntitySegment.Name' => 'NAME',
        'name' => 'NAME',
        'spyAclEntitySegment.name' => 'NAME',
        'SpyAclEntitySegmentTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_acl_entity_segment.name' => 'NAME',
        'Reference' => 'REFERENCE',
        'SpyAclEntitySegment.Reference' => 'REFERENCE',
        'reference' => 'REFERENCE',
        'spyAclEntitySegment.reference' => 'REFERENCE',
        'SpyAclEntitySegmentTableMap::COL_REFERENCE' => 'REFERENCE',
        'COL_REFERENCE' => 'REFERENCE',
        'spy_acl_entity_segment.reference' => 'REFERENCE',
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
        $this->setName('spy_acl_entity_segment');
        $this->setPhpName('SpyAclEntitySegment');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\AclEntity\\Persistence\\SpyAclEntitySegment');
        $this->setPackage('src.Orm.Zed.AclEntity.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_acl_entity_segment_pk_seq');
        // columns
        $this->addPrimaryKey('id_acl_entity_segment', 'IdAclEntitySegment', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('reference', 'Reference', 'VARCHAR', true, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyAclEntityRule', '\\Orm\\Zed\\AclEntity\\Persistence\\SpyAclEntityRule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_acl_entity_segment',
    1 => ':id_acl_entity_segment',
  ),
), 'CASCADE', null, 'SpyAclEntityRules', false);
        $this->addRelation('SpyAclEntitySegmentMerchant', '\\Orm\\Zed\\Merchant\\Persistence\\SpyAclEntitySegmentMerchant', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_acl_entity_segment',
    1 => ':id_acl_entity_segment',
  ),
), 'CASCADE', null, 'SpyAclEntitySegmentMerchants', false);
        $this->addRelation('SpyAclEntitySegmentMerchantUser', '\\Orm\\Zed\\MerchantUser\\Persistence\\SpyAclEntitySegmentMerchantUser', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_acl_entity_segment',
    1 => ':id_acl_entity_segment',
  ),
), 'CASCADE', null, 'SpyAclEntitySegmentMerchantUsers', false);
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
     * Method to invalidate the instance pool of all tables related to spy_acl_entity_segment     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyAclEntityRuleTableMap::clearInstancePool();
        SpyAclEntitySegmentMerchantTableMap::clearInstancePool();
        SpyAclEntitySegmentMerchantUserTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntitySegment', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntitySegment', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntitySegment', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntitySegment', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntitySegment', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAclEntitySegment', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdAclEntitySegment', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyAclEntitySegmentTableMap::CLASS_DEFAULT : SpyAclEntitySegmentTableMap::OM_CLASS;
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
     * @return array (SpyAclEntitySegment object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyAclEntitySegmentTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyAclEntitySegmentTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyAclEntitySegmentTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyAclEntitySegmentTableMap::OM_CLASS;
            /** @var SpyAclEntitySegment $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyAclEntitySegmentTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyAclEntitySegmentTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyAclEntitySegmentTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyAclEntitySegment $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyAclEntitySegmentTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT);
            $criteria->addSelectColumn(SpyAclEntitySegmentTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyAclEntitySegmentTableMap::COL_REFERENCE);
        } else {
            $criteria->addSelectColumn($alias . '.id_acl_entity_segment');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.reference');
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
            $criteria->removeSelectColumn(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT);
            $criteria->removeSelectColumn(SpyAclEntitySegmentTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyAclEntitySegmentTableMap::COL_REFERENCE);
        } else {
            $criteria->removeSelectColumn($alias . '.id_acl_entity_segment');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.reference');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyAclEntitySegmentTableMap::DATABASE_NAME)->getTable(SpyAclEntitySegmentTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyAclEntitySegment or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyAclEntitySegment object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclEntitySegmentTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\AclEntity\Persistence\SpyAclEntitySegment) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyAclEntitySegmentTableMap::DATABASE_NAME);
            $criteria->add(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT, (array) $values, Criteria::IN);
        }

        $query = SpyAclEntitySegmentQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyAclEntitySegmentTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyAclEntitySegmentTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_acl_entity_segment table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyAclEntitySegmentQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyAclEntitySegment or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyAclEntitySegment object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAclEntitySegmentTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyAclEntitySegment object
        }

        if ($criteria->containsKey(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT) && $criteria->keyContainsValue(SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyAclEntitySegmentTableMap::COL_ID_ACL_ENTITY_SEGMENT.')');
        }


        // Set the correct dbName
        $query = SpyAclEntitySegmentQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
