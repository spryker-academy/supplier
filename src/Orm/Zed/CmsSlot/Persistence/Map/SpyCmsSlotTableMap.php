<?php

namespace Orm\Zed\CmsSlot\Persistence\Map;

use Orm\Zed\CmsSlot\Persistence\SpyCmsSlot;
use Orm\Zed\CmsSlot\Persistence\SpyCmsSlotQuery;
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
 * This class defines the structure of the 'spy_cms_slot' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCmsSlotTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CmsSlot.Persistence.Map.SpyCmsSlotTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_cms_slot';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCmsSlot';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CmsSlot\\Persistence\\SpyCmsSlot';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CmsSlot.Persistence.SpyCmsSlot';

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
     * the column name for the id_cms_slot field
     */
    public const COL_ID_CMS_SLOT = 'spy_cms_slot.id_cms_slot';

    /**
     * the column name for the content_provider_type field
     */
    public const COL_CONTENT_PROVIDER_TYPE = 'spy_cms_slot.content_provider_type';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'spy_cms_slot.description';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_cms_slot.is_active';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_cms_slot.key';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_cms_slot.name';

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
        self::TYPE_PHPNAME       => ['IdCmsSlot', 'ContentProviderType', 'Description', 'IsActive', 'Key', 'Name', ],
        self::TYPE_CAMELNAME     => ['idCmsSlot', 'contentProviderType', 'description', 'isActive', 'key', 'name', ],
        self::TYPE_COLNAME       => [SpyCmsSlotTableMap::COL_ID_CMS_SLOT, SpyCmsSlotTableMap::COL_CONTENT_PROVIDER_TYPE, SpyCmsSlotTableMap::COL_DESCRIPTION, SpyCmsSlotTableMap::COL_IS_ACTIVE, SpyCmsSlotTableMap::COL_KEY, SpyCmsSlotTableMap::COL_NAME, ],
        self::TYPE_FIELDNAME     => ['id_cms_slot', 'content_provider_type', 'description', 'is_active', 'key', 'name', ],
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
        self::TYPE_PHPNAME       => ['IdCmsSlot' => 0, 'ContentProviderType' => 1, 'Description' => 2, 'IsActive' => 3, 'Key' => 4, 'Name' => 5, ],
        self::TYPE_CAMELNAME     => ['idCmsSlot' => 0, 'contentProviderType' => 1, 'description' => 2, 'isActive' => 3, 'key' => 4, 'name' => 5, ],
        self::TYPE_COLNAME       => [SpyCmsSlotTableMap::COL_ID_CMS_SLOT => 0, SpyCmsSlotTableMap::COL_CONTENT_PROVIDER_TYPE => 1, SpyCmsSlotTableMap::COL_DESCRIPTION => 2, SpyCmsSlotTableMap::COL_IS_ACTIVE => 3, SpyCmsSlotTableMap::COL_KEY => 4, SpyCmsSlotTableMap::COL_NAME => 5, ],
        self::TYPE_FIELDNAME     => ['id_cms_slot' => 0, 'content_provider_type' => 1, 'description' => 2, 'is_active' => 3, 'key' => 4, 'name' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCmsSlot' => 'ID_CMS_SLOT',
        'SpyCmsSlot.IdCmsSlot' => 'ID_CMS_SLOT',
        'idCmsSlot' => 'ID_CMS_SLOT',
        'spyCmsSlot.idCmsSlot' => 'ID_CMS_SLOT',
        'SpyCmsSlotTableMap::COL_ID_CMS_SLOT' => 'ID_CMS_SLOT',
        'COL_ID_CMS_SLOT' => 'ID_CMS_SLOT',
        'id_cms_slot' => 'ID_CMS_SLOT',
        'spy_cms_slot.id_cms_slot' => 'ID_CMS_SLOT',
        'ContentProviderType' => 'CONTENT_PROVIDER_TYPE',
        'SpyCmsSlot.ContentProviderType' => 'CONTENT_PROVIDER_TYPE',
        'contentProviderType' => 'CONTENT_PROVIDER_TYPE',
        'spyCmsSlot.contentProviderType' => 'CONTENT_PROVIDER_TYPE',
        'SpyCmsSlotTableMap::COL_CONTENT_PROVIDER_TYPE' => 'CONTENT_PROVIDER_TYPE',
        'COL_CONTENT_PROVIDER_TYPE' => 'CONTENT_PROVIDER_TYPE',
        'content_provider_type' => 'CONTENT_PROVIDER_TYPE',
        'spy_cms_slot.content_provider_type' => 'CONTENT_PROVIDER_TYPE',
        'Description' => 'DESCRIPTION',
        'SpyCmsSlot.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'spyCmsSlot.description' => 'DESCRIPTION',
        'SpyCmsSlotTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'spy_cms_slot.description' => 'DESCRIPTION',
        'IsActive' => 'IS_ACTIVE',
        'SpyCmsSlot.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyCmsSlot.isActive' => 'IS_ACTIVE',
        'SpyCmsSlotTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_cms_slot.is_active' => 'IS_ACTIVE',
        'Key' => 'KEY',
        'SpyCmsSlot.Key' => 'KEY',
        'key' => 'KEY',
        'spyCmsSlot.key' => 'KEY',
        'SpyCmsSlotTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_cms_slot.key' => 'KEY',
        'Name' => 'NAME',
        'SpyCmsSlot.Name' => 'NAME',
        'name' => 'NAME',
        'spyCmsSlot.name' => 'NAME',
        'SpyCmsSlotTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_cms_slot.name' => 'NAME',
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
        $this->setName('spy_cms_slot');
        $this->setPhpName('SpyCmsSlot');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\CmsSlot\\Persistence\\SpyCmsSlot');
        $this->setPackage('src.Orm.Zed.CmsSlot.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_cms_slot_pk_seq');
        // columns
        $this->addPrimaryKey('id_cms_slot', 'IdCmsSlot', 'INTEGER', true, null, null);
        $this->addColumn('content_provider_type', 'ContentProviderType', 'VARCHAR', true, 64, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', true, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', true, 1, false);
        $this->addColumn('key', 'Key', 'VARCHAR', true, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyCmsSlotToCmsSlotTemplate', '\\Orm\\Zed\\CmsSlot\\Persistence\\SpyCmsSlotToCmsSlotTemplate', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_cms_slot',
    1 => ':id_cms_slot',
  ),
), null, null, 'SpyCmsSlotToCmsSlotTemplates', false);
        $this->addRelation('SpyCmsSlotBlock', '\\Orm\\Zed\\CmsSlotBlock\\Persistence\\SpyCmsSlotBlock', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_cms_slot',
    1 => ':id_cms_slot',
  ),
), null, null, 'SpyCmsSlotBlocks', false);
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
            'event' => ['spy_cms_slot_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlot', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlot', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlot', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlot', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlot', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlot', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCmsSlot', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCmsSlotTableMap::CLASS_DEFAULT : SpyCmsSlotTableMap::OM_CLASS;
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
     * @return array (SpyCmsSlot object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCmsSlotTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCmsSlotTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCmsSlotTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCmsSlotTableMap::OM_CLASS;
            /** @var SpyCmsSlot $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCmsSlotTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCmsSlotTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCmsSlotTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCmsSlot $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCmsSlotTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCmsSlotTableMap::COL_ID_CMS_SLOT);
            $criteria->addSelectColumn(SpyCmsSlotTableMap::COL_CONTENT_PROVIDER_TYPE);
            $criteria->addSelectColumn(SpyCmsSlotTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SpyCmsSlotTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyCmsSlotTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyCmsSlotTableMap::COL_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.id_cms_slot');
            $criteria->addSelectColumn($alias . '.content_provider_type');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.name');
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
            $criteria->removeSelectColumn(SpyCmsSlotTableMap::COL_ID_CMS_SLOT);
            $criteria->removeSelectColumn(SpyCmsSlotTableMap::COL_CONTENT_PROVIDER_TYPE);
            $criteria->removeSelectColumn(SpyCmsSlotTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(SpyCmsSlotTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyCmsSlotTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyCmsSlotTableMap::COL_NAME);
        } else {
            $criteria->removeSelectColumn($alias . '.id_cms_slot');
            $criteria->removeSelectColumn($alias . '.content_provider_type');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCmsSlotTableMap::DATABASE_NAME)->getTable(SpyCmsSlotTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCmsSlot or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCmsSlot object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsSlotTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CmsSlot\Persistence\SpyCmsSlot) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCmsSlotTableMap::DATABASE_NAME);
            $criteria->add(SpyCmsSlotTableMap::COL_ID_CMS_SLOT, (array) $values, Criteria::IN);
        }

        $query = SpyCmsSlotQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCmsSlotTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCmsSlotTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_cms_slot table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCmsSlotQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCmsSlot or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCmsSlot object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsSlotTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCmsSlot object
        }


        // Set the correct dbName
        $query = SpyCmsSlotQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
