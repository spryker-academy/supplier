<?php

namespace Orm\Zed\Asset\Persistence\Map;

use Orm\Zed\Asset\Persistence\SpyAsset;
use Orm\Zed\Asset\Persistence\SpyAssetQuery;
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
 * This class defines the structure of the 'spy_asset' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyAssetTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Asset.Persistence.Map.SpyAssetTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_asset';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyAsset';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Asset\\Persistence\\SpyAsset';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Asset.Persistence.SpyAsset';

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
     * the column name for the id_asset field
     */
    public const COL_ID_ASSET = 'spy_asset.id_asset';

    /**
     * the column name for the asset_slot field
     */
    public const COL_ASSET_SLOT = 'spy_asset.asset_slot';

    /**
     * the column name for the asset_uuid field
     */
    public const COL_ASSET_UUID = 'spy_asset.asset_uuid';

    /**
     * the column name for the asset_name field
     */
    public const COL_ASSET_NAME = 'spy_asset.asset_name';

    /**
     * the column name for the asset_content field
     */
    public const COL_ASSET_CONTENT = 'spy_asset.asset_content';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_asset.is_active';

    /**
     * the column name for the last_message_timestamp field
     */
    public const COL_LAST_MESSAGE_TIMESTAMP = 'spy_asset.last_message_timestamp';

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
        self::TYPE_PHPNAME       => ['IdAsset', 'AssetSlot', 'AssetUuid', 'AssetName', 'AssetContent', 'IsActive', 'LastMessageTimestamp', ],
        self::TYPE_CAMELNAME     => ['idAsset', 'assetSlot', 'assetUuid', 'assetName', 'assetContent', 'isActive', 'lastMessageTimestamp', ],
        self::TYPE_COLNAME       => [SpyAssetTableMap::COL_ID_ASSET, SpyAssetTableMap::COL_ASSET_SLOT, SpyAssetTableMap::COL_ASSET_UUID, SpyAssetTableMap::COL_ASSET_NAME, SpyAssetTableMap::COL_ASSET_CONTENT, SpyAssetTableMap::COL_IS_ACTIVE, SpyAssetTableMap::COL_LAST_MESSAGE_TIMESTAMP, ],
        self::TYPE_FIELDNAME     => ['id_asset', 'asset_slot', 'asset_uuid', 'asset_name', 'asset_content', 'is_active', 'last_message_timestamp', ],
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
        self::TYPE_PHPNAME       => ['IdAsset' => 0, 'AssetSlot' => 1, 'AssetUuid' => 2, 'AssetName' => 3, 'AssetContent' => 4, 'IsActive' => 5, 'LastMessageTimestamp' => 6, ],
        self::TYPE_CAMELNAME     => ['idAsset' => 0, 'assetSlot' => 1, 'assetUuid' => 2, 'assetName' => 3, 'assetContent' => 4, 'isActive' => 5, 'lastMessageTimestamp' => 6, ],
        self::TYPE_COLNAME       => [SpyAssetTableMap::COL_ID_ASSET => 0, SpyAssetTableMap::COL_ASSET_SLOT => 1, SpyAssetTableMap::COL_ASSET_UUID => 2, SpyAssetTableMap::COL_ASSET_NAME => 3, SpyAssetTableMap::COL_ASSET_CONTENT => 4, SpyAssetTableMap::COL_IS_ACTIVE => 5, SpyAssetTableMap::COL_LAST_MESSAGE_TIMESTAMP => 6, ],
        self::TYPE_FIELDNAME     => ['id_asset' => 0, 'asset_slot' => 1, 'asset_uuid' => 2, 'asset_name' => 3, 'asset_content' => 4, 'is_active' => 5, 'last_message_timestamp' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdAsset' => 'ID_ASSET',
        'SpyAsset.IdAsset' => 'ID_ASSET',
        'idAsset' => 'ID_ASSET',
        'spyAsset.idAsset' => 'ID_ASSET',
        'SpyAssetTableMap::COL_ID_ASSET' => 'ID_ASSET',
        'COL_ID_ASSET' => 'ID_ASSET',
        'id_asset' => 'ID_ASSET',
        'spy_asset.id_asset' => 'ID_ASSET',
        'AssetSlot' => 'ASSET_SLOT',
        'SpyAsset.AssetSlot' => 'ASSET_SLOT',
        'assetSlot' => 'ASSET_SLOT',
        'spyAsset.assetSlot' => 'ASSET_SLOT',
        'SpyAssetTableMap::COL_ASSET_SLOT' => 'ASSET_SLOT',
        'COL_ASSET_SLOT' => 'ASSET_SLOT',
        'asset_slot' => 'ASSET_SLOT',
        'spy_asset.asset_slot' => 'ASSET_SLOT',
        'AssetUuid' => 'ASSET_UUID',
        'SpyAsset.AssetUuid' => 'ASSET_UUID',
        'assetUuid' => 'ASSET_UUID',
        'spyAsset.assetUuid' => 'ASSET_UUID',
        'SpyAssetTableMap::COL_ASSET_UUID' => 'ASSET_UUID',
        'COL_ASSET_UUID' => 'ASSET_UUID',
        'asset_uuid' => 'ASSET_UUID',
        'spy_asset.asset_uuid' => 'ASSET_UUID',
        'AssetName' => 'ASSET_NAME',
        'SpyAsset.AssetName' => 'ASSET_NAME',
        'assetName' => 'ASSET_NAME',
        'spyAsset.assetName' => 'ASSET_NAME',
        'SpyAssetTableMap::COL_ASSET_NAME' => 'ASSET_NAME',
        'COL_ASSET_NAME' => 'ASSET_NAME',
        'asset_name' => 'ASSET_NAME',
        'spy_asset.asset_name' => 'ASSET_NAME',
        'AssetContent' => 'ASSET_CONTENT',
        'SpyAsset.AssetContent' => 'ASSET_CONTENT',
        'assetContent' => 'ASSET_CONTENT',
        'spyAsset.assetContent' => 'ASSET_CONTENT',
        'SpyAssetTableMap::COL_ASSET_CONTENT' => 'ASSET_CONTENT',
        'COL_ASSET_CONTENT' => 'ASSET_CONTENT',
        'asset_content' => 'ASSET_CONTENT',
        'spy_asset.asset_content' => 'ASSET_CONTENT',
        'IsActive' => 'IS_ACTIVE',
        'SpyAsset.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyAsset.isActive' => 'IS_ACTIVE',
        'SpyAssetTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_asset.is_active' => 'IS_ACTIVE',
        'LastMessageTimestamp' => 'LAST_MESSAGE_TIMESTAMP',
        'SpyAsset.LastMessageTimestamp' => 'LAST_MESSAGE_TIMESTAMP',
        'lastMessageTimestamp' => 'LAST_MESSAGE_TIMESTAMP',
        'spyAsset.lastMessageTimestamp' => 'LAST_MESSAGE_TIMESTAMP',
        'SpyAssetTableMap::COL_LAST_MESSAGE_TIMESTAMP' => 'LAST_MESSAGE_TIMESTAMP',
        'COL_LAST_MESSAGE_TIMESTAMP' => 'LAST_MESSAGE_TIMESTAMP',
        'last_message_timestamp' => 'LAST_MESSAGE_TIMESTAMP',
        'spy_asset.last_message_timestamp' => 'LAST_MESSAGE_TIMESTAMP',
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
        $this->setName('spy_asset');
        $this->setPhpName('SpyAsset');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Asset\\Persistence\\SpyAsset');
        $this->setPackage('src.Orm.Zed.Asset.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_asset_pk_seq');
        // columns
        $this->addPrimaryKey('id_asset', 'IdAsset', 'INTEGER', true, null, null);
        $this->addColumn('asset_slot', 'AssetSlot', 'VARCHAR', true, 255, null);
        $this->addColumn('asset_uuid', 'AssetUuid', 'VARCHAR', true, 36, null);
        $this->addColumn('asset_name', 'AssetName', 'VARCHAR', true, 255, null);
        $this->addColumn('asset_content', 'AssetContent', 'LONGVARCHAR', true, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', false, 1, true);
        $this->addColumn('last_message_timestamp', 'LastMessageTimestamp', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyAssetStore', '\\Orm\\Zed\\Asset\\Persistence\\SpyAssetStore', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_asset',
    1 => ':id_asset',
  ),
), null, null, 'SpyAssetStores', false);
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
            'event' => ['spy_asset_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAsset', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAsset', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAsset', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAsset', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAsset', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAsset', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdAsset', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyAssetTableMap::CLASS_DEFAULT : SpyAssetTableMap::OM_CLASS;
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
     * @return array (SpyAsset object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyAssetTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyAssetTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyAssetTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyAssetTableMap::OM_CLASS;
            /** @var SpyAsset $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyAssetTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyAssetTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyAssetTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyAsset $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyAssetTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyAssetTableMap::COL_ID_ASSET);
            $criteria->addSelectColumn(SpyAssetTableMap::COL_ASSET_SLOT);
            $criteria->addSelectColumn(SpyAssetTableMap::COL_ASSET_UUID);
            $criteria->addSelectColumn(SpyAssetTableMap::COL_ASSET_NAME);
            $criteria->addSelectColumn(SpyAssetTableMap::COL_ASSET_CONTENT);
            $criteria->addSelectColumn(SpyAssetTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyAssetTableMap::COL_LAST_MESSAGE_TIMESTAMP);
        } else {
            $criteria->addSelectColumn($alias . '.id_asset');
            $criteria->addSelectColumn($alias . '.asset_slot');
            $criteria->addSelectColumn($alias . '.asset_uuid');
            $criteria->addSelectColumn($alias . '.asset_name');
            $criteria->addSelectColumn($alias . '.asset_content');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.last_message_timestamp');
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
            $criteria->removeSelectColumn(SpyAssetTableMap::COL_ID_ASSET);
            $criteria->removeSelectColumn(SpyAssetTableMap::COL_ASSET_SLOT);
            $criteria->removeSelectColumn(SpyAssetTableMap::COL_ASSET_UUID);
            $criteria->removeSelectColumn(SpyAssetTableMap::COL_ASSET_NAME);
            $criteria->removeSelectColumn(SpyAssetTableMap::COL_ASSET_CONTENT);
            $criteria->removeSelectColumn(SpyAssetTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyAssetTableMap::COL_LAST_MESSAGE_TIMESTAMP);
        } else {
            $criteria->removeSelectColumn($alias . '.id_asset');
            $criteria->removeSelectColumn($alias . '.asset_slot');
            $criteria->removeSelectColumn($alias . '.asset_uuid');
            $criteria->removeSelectColumn($alias . '.asset_name');
            $criteria->removeSelectColumn($alias . '.asset_content');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.last_message_timestamp');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyAssetTableMap::DATABASE_NAME)->getTable(SpyAssetTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyAsset or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyAsset object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAssetTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Asset\Persistence\SpyAsset) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyAssetTableMap::DATABASE_NAME);
            $criteria->add(SpyAssetTableMap::COL_ID_ASSET, (array) $values, Criteria::IN);
        }

        $query = SpyAssetQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyAssetTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyAssetTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_asset table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyAssetQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyAsset or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyAsset object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyAssetTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyAsset object
        }

        if ($criteria->containsKey(SpyAssetTableMap::COL_ID_ASSET) && $criteria->keyContainsValue(SpyAssetTableMap::COL_ID_ASSET) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyAssetTableMap::COL_ID_ASSET.')');
        }


        // Set the correct dbName
        $query = SpyAssetQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
