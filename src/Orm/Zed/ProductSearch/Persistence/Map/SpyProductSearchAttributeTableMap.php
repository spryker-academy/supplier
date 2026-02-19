<?php

namespace Orm\Zed\ProductSearch\Persistence\Map;

use Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttribute;
use Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttributeQuery;
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
 * This class defines the structure of the 'spy_product_search_attribute' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductSearchAttributeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductSearch.Persistence.Map.SpyProductSearchAttributeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_search_attribute';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductSearchAttribute';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductSearch\\Persistence\\SpyProductSearchAttribute';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductSearch.Persistence.SpyProductSearchAttribute';

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
     * the column name for the id_product_search_attribute field
     */
    public const COL_ID_PRODUCT_SEARCH_ATTRIBUTE = 'spy_product_search_attribute.id_product_search_attribute';

    /**
     * the column name for the fk_product_attribute_key field
     */
    public const COL_FK_PRODUCT_ATTRIBUTE_KEY = 'spy_product_search_attribute.fk_product_attribute_key';

    /**
     * the column name for the filter_type field
     */
    public const COL_FILTER_TYPE = 'spy_product_search_attribute.filter_type';

    /**
     * the column name for the position field
     */
    public const COL_POSITION = 'spy_product_search_attribute.position';

    /**
     * the column name for the synced field
     */
    public const COL_SYNCED = 'spy_product_search_attribute.synced';

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
        self::TYPE_PHPNAME       => ['IdProductSearchAttribute', 'FkProductAttributeKey', 'FilterType', 'Position', 'Synced', ],
        self::TYPE_CAMELNAME     => ['idProductSearchAttribute', 'fkProductAttributeKey', 'filterType', 'position', 'synced', ],
        self::TYPE_COLNAME       => [SpyProductSearchAttributeTableMap::COL_ID_PRODUCT_SEARCH_ATTRIBUTE, SpyProductSearchAttributeTableMap::COL_FK_PRODUCT_ATTRIBUTE_KEY, SpyProductSearchAttributeTableMap::COL_FILTER_TYPE, SpyProductSearchAttributeTableMap::COL_POSITION, SpyProductSearchAttributeTableMap::COL_SYNCED, ],
        self::TYPE_FIELDNAME     => ['id_product_search_attribute', 'fk_product_attribute_key', 'filter_type', 'position', 'synced', ],
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
        self::TYPE_PHPNAME       => ['IdProductSearchAttribute' => 0, 'FkProductAttributeKey' => 1, 'FilterType' => 2, 'Position' => 3, 'Synced' => 4, ],
        self::TYPE_CAMELNAME     => ['idProductSearchAttribute' => 0, 'fkProductAttributeKey' => 1, 'filterType' => 2, 'position' => 3, 'synced' => 4, ],
        self::TYPE_COLNAME       => [SpyProductSearchAttributeTableMap::COL_ID_PRODUCT_SEARCH_ATTRIBUTE => 0, SpyProductSearchAttributeTableMap::COL_FK_PRODUCT_ATTRIBUTE_KEY => 1, SpyProductSearchAttributeTableMap::COL_FILTER_TYPE => 2, SpyProductSearchAttributeTableMap::COL_POSITION => 3, SpyProductSearchAttributeTableMap::COL_SYNCED => 4, ],
        self::TYPE_FIELDNAME     => ['id_product_search_attribute' => 0, 'fk_product_attribute_key' => 1, 'filter_type' => 2, 'position' => 3, 'synced' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductSearchAttribute' => 'ID_PRODUCT_SEARCH_ATTRIBUTE',
        'SpyProductSearchAttribute.IdProductSearchAttribute' => 'ID_PRODUCT_SEARCH_ATTRIBUTE',
        'idProductSearchAttribute' => 'ID_PRODUCT_SEARCH_ATTRIBUTE',
        'spyProductSearchAttribute.idProductSearchAttribute' => 'ID_PRODUCT_SEARCH_ATTRIBUTE',
        'SpyProductSearchAttributeTableMap::COL_ID_PRODUCT_SEARCH_ATTRIBUTE' => 'ID_PRODUCT_SEARCH_ATTRIBUTE',
        'COL_ID_PRODUCT_SEARCH_ATTRIBUTE' => 'ID_PRODUCT_SEARCH_ATTRIBUTE',
        'id_product_search_attribute' => 'ID_PRODUCT_SEARCH_ATTRIBUTE',
        'spy_product_search_attribute.id_product_search_attribute' => 'ID_PRODUCT_SEARCH_ATTRIBUTE',
        'FkProductAttributeKey' => 'FK_PRODUCT_ATTRIBUTE_KEY',
        'SpyProductSearchAttribute.FkProductAttributeKey' => 'FK_PRODUCT_ATTRIBUTE_KEY',
        'fkProductAttributeKey' => 'FK_PRODUCT_ATTRIBUTE_KEY',
        'spyProductSearchAttribute.fkProductAttributeKey' => 'FK_PRODUCT_ATTRIBUTE_KEY',
        'SpyProductSearchAttributeTableMap::COL_FK_PRODUCT_ATTRIBUTE_KEY' => 'FK_PRODUCT_ATTRIBUTE_KEY',
        'COL_FK_PRODUCT_ATTRIBUTE_KEY' => 'FK_PRODUCT_ATTRIBUTE_KEY',
        'fk_product_attribute_key' => 'FK_PRODUCT_ATTRIBUTE_KEY',
        'spy_product_search_attribute.fk_product_attribute_key' => 'FK_PRODUCT_ATTRIBUTE_KEY',
        'FilterType' => 'FILTER_TYPE',
        'SpyProductSearchAttribute.FilterType' => 'FILTER_TYPE',
        'filterType' => 'FILTER_TYPE',
        'spyProductSearchAttribute.filterType' => 'FILTER_TYPE',
        'SpyProductSearchAttributeTableMap::COL_FILTER_TYPE' => 'FILTER_TYPE',
        'COL_FILTER_TYPE' => 'FILTER_TYPE',
        'filter_type' => 'FILTER_TYPE',
        'spy_product_search_attribute.filter_type' => 'FILTER_TYPE',
        'Position' => 'POSITION',
        'SpyProductSearchAttribute.Position' => 'POSITION',
        'position' => 'POSITION',
        'spyProductSearchAttribute.position' => 'POSITION',
        'SpyProductSearchAttributeTableMap::COL_POSITION' => 'POSITION',
        'COL_POSITION' => 'POSITION',
        'spy_product_search_attribute.position' => 'POSITION',
        'Synced' => 'SYNCED',
        'SpyProductSearchAttribute.Synced' => 'SYNCED',
        'synced' => 'SYNCED',
        'spyProductSearchAttribute.synced' => 'SYNCED',
        'SpyProductSearchAttributeTableMap::COL_SYNCED' => 'SYNCED',
        'COL_SYNCED' => 'SYNCED',
        'spy_product_search_attribute.synced' => 'SYNCED',
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
        $this->setName('spy_product_search_attribute');
        $this->setPhpName('SpyProductSearchAttribute');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ProductSearch\\Persistence\\SpyProductSearchAttribute');
        $this->setPackage('src.Orm.Zed.ProductSearch.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_search_attribute_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_search_attribute', 'IdProductSearchAttribute', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_product_attribute_key', 'FkProductAttributeKey', 'INTEGER', 'spy_product_attribute_key', 'id_product_attribute_key', true, null, null);
        $this->addColumn('filter_type', 'FilterType', 'VARCHAR', true, 255, null);
        $this->addColumn('position', 'Position', 'INTEGER', true, null, 0);
        $this->addColumn('synced', 'Synced', 'BOOLEAN', false, 1, false);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyProductAttributeKey', '\\Orm\\Zed\\Product\\Persistence\\SpyProductAttributeKey', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_attribute_key',
    1 => ':id_product_attribute_key',
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
            'archivable' => ['archive_table' => '', 'archive_phpname' => NULL, 'archive_class' => '', 'sync' => 'false', 'inherit_foreign_key_relations' => 'false', 'inherit_foreign_key_constraints' => 'false', 'foreign_keys' => NULL, 'log_archived_at' => 'true', 'archived_at_column' => 'archived_at', 'archive_on_insert' => 'false', 'archive_on_update' => 'false', 'archive_on_delete' => 'true', 'is_timestamp' => 'true'],
            'event' => ['spy_product_search_attribute_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSearchAttribute', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSearchAttribute', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSearchAttribute', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSearchAttribute', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSearchAttribute', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSearchAttribute', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductSearchAttribute', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductSearchAttributeTableMap::CLASS_DEFAULT : SpyProductSearchAttributeTableMap::OM_CLASS;
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
     * @return array (SpyProductSearchAttribute object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductSearchAttributeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductSearchAttributeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductSearchAttributeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductSearchAttributeTableMap::OM_CLASS;
            /** @var SpyProductSearchAttribute $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductSearchAttributeTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductSearchAttributeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductSearchAttributeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductSearchAttribute $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductSearchAttributeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductSearchAttributeTableMap::COL_ID_PRODUCT_SEARCH_ATTRIBUTE);
            $criteria->addSelectColumn(SpyProductSearchAttributeTableMap::COL_FK_PRODUCT_ATTRIBUTE_KEY);
            $criteria->addSelectColumn(SpyProductSearchAttributeTableMap::COL_FILTER_TYPE);
            $criteria->addSelectColumn(SpyProductSearchAttributeTableMap::COL_POSITION);
            $criteria->addSelectColumn(SpyProductSearchAttributeTableMap::COL_SYNCED);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_search_attribute');
            $criteria->addSelectColumn($alias . '.fk_product_attribute_key');
            $criteria->addSelectColumn($alias . '.filter_type');
            $criteria->addSelectColumn($alias . '.position');
            $criteria->addSelectColumn($alias . '.synced');
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
            $criteria->removeSelectColumn(SpyProductSearchAttributeTableMap::COL_ID_PRODUCT_SEARCH_ATTRIBUTE);
            $criteria->removeSelectColumn(SpyProductSearchAttributeTableMap::COL_FK_PRODUCT_ATTRIBUTE_KEY);
            $criteria->removeSelectColumn(SpyProductSearchAttributeTableMap::COL_FILTER_TYPE);
            $criteria->removeSelectColumn(SpyProductSearchAttributeTableMap::COL_POSITION);
            $criteria->removeSelectColumn(SpyProductSearchAttributeTableMap::COL_SYNCED);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_search_attribute');
            $criteria->removeSelectColumn($alias . '.fk_product_attribute_key');
            $criteria->removeSelectColumn($alias . '.filter_type');
            $criteria->removeSelectColumn($alias . '.position');
            $criteria->removeSelectColumn($alias . '.synced');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductSearchAttributeTableMap::DATABASE_NAME)->getTable(SpyProductSearchAttributeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductSearchAttribute or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductSearchAttribute object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductSearchAttributeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductSearch\Persistence\SpyProductSearchAttribute) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductSearchAttributeTableMap::DATABASE_NAME);
            $criteria->add(SpyProductSearchAttributeTableMap::COL_ID_PRODUCT_SEARCH_ATTRIBUTE, (array) $values, Criteria::IN);
        }

        $query = SpyProductSearchAttributeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductSearchAttributeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductSearchAttributeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_search_attribute table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductSearchAttributeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductSearchAttribute or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductSearchAttribute object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductSearchAttributeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductSearchAttribute object
        }


        // Set the correct dbName
        $query = SpyProductSearchAttributeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
