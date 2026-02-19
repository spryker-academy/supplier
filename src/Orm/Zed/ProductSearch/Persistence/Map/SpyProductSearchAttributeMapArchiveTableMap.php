<?php

namespace Orm\Zed\ProductSearch\Persistence\Map;

use Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributeMapArchive;
use Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributeMapArchiveQuery;
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
 * This class defines the structure of the 'spy_product_search_attribute_map_archive' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductSearchAttributeMapArchiveTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductSearch.Persistence.Map.SpyProductSearchAttributeMapArchiveTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_search_attribute_map_archive';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductSearchAttributeMapArchive';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductSearch\\Persistence\\SpyProductSearchAttributeMapArchive';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductSearch.Persistence.SpyProductSearchAttributeMapArchive';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the fk_product_attribute_key field
     */
    public const COL_FK_PRODUCT_ATTRIBUTE_KEY = 'spy_product_search_attribute_map_archive.fk_product_attribute_key';

    /**
     * the column name for the synced field
     */
    public const COL_SYNCED = 'spy_product_search_attribute_map_archive.synced';

    /**
     * the column name for the target_field field
     */
    public const COL_TARGET_FIELD = 'spy_product_search_attribute_map_archive.target_field';

    /**
     * the column name for the archived_at field
     */
    public const COL_ARCHIVED_AT = 'spy_product_search_attribute_map_archive.archived_at';

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
        self::TYPE_PHPNAME       => ['FkProductAttributeKey', 'Synced', 'TargetField', 'ArchivedAt', ],
        self::TYPE_CAMELNAME     => ['fkProductAttributeKey', 'synced', 'targetField', 'archivedAt', ],
        self::TYPE_COLNAME       => [SpyProductSearchAttributeMapArchiveTableMap::COL_FK_PRODUCT_ATTRIBUTE_KEY, SpyProductSearchAttributeMapArchiveTableMap::COL_SYNCED, SpyProductSearchAttributeMapArchiveTableMap::COL_TARGET_FIELD, SpyProductSearchAttributeMapArchiveTableMap::COL_ARCHIVED_AT, ],
        self::TYPE_FIELDNAME     => ['fk_product_attribute_key', 'synced', 'target_field', 'archived_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
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
        self::TYPE_PHPNAME       => ['FkProductAttributeKey' => 0, 'Synced' => 1, 'TargetField' => 2, 'ArchivedAt' => 3, ],
        self::TYPE_CAMELNAME     => ['fkProductAttributeKey' => 0, 'synced' => 1, 'targetField' => 2, 'archivedAt' => 3, ],
        self::TYPE_COLNAME       => [SpyProductSearchAttributeMapArchiveTableMap::COL_FK_PRODUCT_ATTRIBUTE_KEY => 0, SpyProductSearchAttributeMapArchiveTableMap::COL_SYNCED => 1, SpyProductSearchAttributeMapArchiveTableMap::COL_TARGET_FIELD => 2, SpyProductSearchAttributeMapArchiveTableMap::COL_ARCHIVED_AT => 3, ],
        self::TYPE_FIELDNAME     => ['fk_product_attribute_key' => 0, 'synced' => 1, 'target_field' => 2, 'archived_at' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'FkProductAttributeKey' => 'FK_PRODUCT_ATTRIBUTE_KEY',
        'SpyProductSearchAttributeMapArchive.FkProductAttributeKey' => 'FK_PRODUCT_ATTRIBUTE_KEY',
        'fkProductAttributeKey' => 'FK_PRODUCT_ATTRIBUTE_KEY',
        'spyProductSearchAttributeMapArchive.fkProductAttributeKey' => 'FK_PRODUCT_ATTRIBUTE_KEY',
        'SpyProductSearchAttributeMapArchiveTableMap::COL_FK_PRODUCT_ATTRIBUTE_KEY' => 'FK_PRODUCT_ATTRIBUTE_KEY',
        'COL_FK_PRODUCT_ATTRIBUTE_KEY' => 'FK_PRODUCT_ATTRIBUTE_KEY',
        'fk_product_attribute_key' => 'FK_PRODUCT_ATTRIBUTE_KEY',
        'spy_product_search_attribute_map_archive.fk_product_attribute_key' => 'FK_PRODUCT_ATTRIBUTE_KEY',
        'Synced' => 'SYNCED',
        'SpyProductSearchAttributeMapArchive.Synced' => 'SYNCED',
        'synced' => 'SYNCED',
        'spyProductSearchAttributeMapArchive.synced' => 'SYNCED',
        'SpyProductSearchAttributeMapArchiveTableMap::COL_SYNCED' => 'SYNCED',
        'COL_SYNCED' => 'SYNCED',
        'spy_product_search_attribute_map_archive.synced' => 'SYNCED',
        'TargetField' => 'TARGET_FIELD',
        'SpyProductSearchAttributeMapArchive.TargetField' => 'TARGET_FIELD',
        'targetField' => 'TARGET_FIELD',
        'spyProductSearchAttributeMapArchive.targetField' => 'TARGET_FIELD',
        'SpyProductSearchAttributeMapArchiveTableMap::COL_TARGET_FIELD' => 'TARGET_FIELD',
        'COL_TARGET_FIELD' => 'TARGET_FIELD',
        'target_field' => 'TARGET_FIELD',
        'spy_product_search_attribute_map_archive.target_field' => 'TARGET_FIELD',
        'ArchivedAt' => 'ARCHIVED_AT',
        'SpyProductSearchAttributeMapArchive.ArchivedAt' => 'ARCHIVED_AT',
        'archivedAt' => 'ARCHIVED_AT',
        'spyProductSearchAttributeMapArchive.archivedAt' => 'ARCHIVED_AT',
        'SpyProductSearchAttributeMapArchiveTableMap::COL_ARCHIVED_AT' => 'ARCHIVED_AT',
        'COL_ARCHIVED_AT' => 'ARCHIVED_AT',
        'archived_at' => 'ARCHIVED_AT',
        'spy_product_search_attribute_map_archive.archived_at' => 'ARCHIVED_AT',
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
        $this->setName('spy_product_search_attribute_map_archive');
        $this->setPhpName('SpyProductSearchAttributeMapArchive');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ProductSearch\\Persistence\\SpyProductSearchAttributeMapArchive');
        $this->setPackage('src.Orm.Zed.ProductSearch.Persistence');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('fk_product_attribute_key', 'FkProductAttributeKey', 'INTEGER', true, null, null);
        $this->addColumn('synced', 'Synced', 'BOOLEAN', false, 1, false);
        $this->addPrimaryKey('target_field', 'TargetField', 'VARCHAR', true, 255, null);
        $this->addColumn('archived_at', 'ArchivedAt', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
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
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributeMapArchive $obj A \Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributeMapArchive object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(SpyProductSearchAttributeMapArchive $obj, ?string $key = null): void
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getFkProductAttributeKey() || is_scalar($obj->getFkProductAttributeKey()) || is_callable([$obj->getFkProductAttributeKey(), '__toString']) ? (string) $obj->getFkProductAttributeKey() : $obj->getFkProductAttributeKey()), (null === $obj->getTargetField() || is_scalar($obj->getTargetField()) || is_callable([$obj->getTargetField(), '__toString']) ? (string) $obj->getTargetField() : $obj->getTargetField())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributeMapArchive object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributeMapArchive) {
                $key = serialize([(null === $value->getFkProductAttributeKey() || is_scalar($value->getFkProductAttributeKey()) || is_callable([$value->getFkProductAttributeKey(), '__toString']) ? (string) $value->getFkProductAttributeKey() : $value->getFkProductAttributeKey()), (null === $value->getTargetField() || is_scalar($value->getTargetField()) || is_callable([$value->getTargetField(), '__toString']) ? (string) $value->getTargetField() : $value->getTargetField())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributeMapArchive object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FkProductAttributeKey', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('TargetField', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FkProductAttributeKey', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FkProductAttributeKey', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FkProductAttributeKey', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FkProductAttributeKey', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('FkProductAttributeKey', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('TargetField', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('TargetField', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('TargetField', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('TargetField', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('TargetField', TableMap::TYPE_PHPNAME, $indexType)])]);
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
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('FkProductAttributeKey', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 2 + $offset
                : self::translateFieldName('TargetField', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? SpyProductSearchAttributeMapArchiveTableMap::CLASS_DEFAULT : SpyProductSearchAttributeMapArchiveTableMap::OM_CLASS;
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
     * @return array (SpyProductSearchAttributeMapArchive object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductSearchAttributeMapArchiveTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductSearchAttributeMapArchiveTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductSearchAttributeMapArchiveTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductSearchAttributeMapArchiveTableMap::OM_CLASS;
            /** @var SpyProductSearchAttributeMapArchive $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductSearchAttributeMapArchiveTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductSearchAttributeMapArchiveTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductSearchAttributeMapArchiveTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductSearchAttributeMapArchive $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductSearchAttributeMapArchiveTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductSearchAttributeMapArchiveTableMap::COL_FK_PRODUCT_ATTRIBUTE_KEY);
            $criteria->addSelectColumn(SpyProductSearchAttributeMapArchiveTableMap::COL_SYNCED);
            $criteria->addSelectColumn(SpyProductSearchAttributeMapArchiveTableMap::COL_TARGET_FIELD);
            $criteria->addSelectColumn(SpyProductSearchAttributeMapArchiveTableMap::COL_ARCHIVED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.fk_product_attribute_key');
            $criteria->addSelectColumn($alias . '.synced');
            $criteria->addSelectColumn($alias . '.target_field');
            $criteria->addSelectColumn($alias . '.archived_at');
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
            $criteria->removeSelectColumn(SpyProductSearchAttributeMapArchiveTableMap::COL_FK_PRODUCT_ATTRIBUTE_KEY);
            $criteria->removeSelectColumn(SpyProductSearchAttributeMapArchiveTableMap::COL_SYNCED);
            $criteria->removeSelectColumn(SpyProductSearchAttributeMapArchiveTableMap::COL_TARGET_FIELD);
            $criteria->removeSelectColumn(SpyProductSearchAttributeMapArchiveTableMap::COL_ARCHIVED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.fk_product_attribute_key');
            $criteria->removeSelectColumn($alias . '.synced');
            $criteria->removeSelectColumn($alias . '.target_field');
            $criteria->removeSelectColumn($alias . '.archived_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductSearchAttributeMapArchiveTableMap::DATABASE_NAME)->getTable(SpyProductSearchAttributeMapArchiveTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductSearchAttributeMapArchive or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductSearchAttributeMapArchive object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductSearchAttributeMapArchiveTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributeMapArchive) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductSearchAttributeMapArchiveTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(SpyProductSearchAttributeMapArchiveTableMap::COL_FK_PRODUCT_ATTRIBUTE_KEY, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(SpyProductSearchAttributeMapArchiveTableMap::COL_TARGET_FIELD, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = SpyProductSearchAttributeMapArchiveQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductSearchAttributeMapArchiveTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductSearchAttributeMapArchiveTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_search_attribute_map_archive table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductSearchAttributeMapArchiveQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductSearchAttributeMapArchive or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductSearchAttributeMapArchive object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductSearchAttributeMapArchiveTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductSearchAttributeMapArchive object
        }


        // Set the correct dbName
        $query = SpyProductSearchAttributeMapArchiveQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
