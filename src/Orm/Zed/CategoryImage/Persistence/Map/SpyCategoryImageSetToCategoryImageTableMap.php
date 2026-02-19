<?php

namespace Orm\Zed\CategoryImage\Persistence\Map;

use Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetToCategoryImage;
use Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetToCategoryImageQuery;
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
 * This class defines the structure of the 'spy_category_image_set_to_category_image' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCategoryImageSetToCategoryImageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CategoryImage.Persistence.Map.SpyCategoryImageSetToCategoryImageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_category_image_set_to_category_image';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCategoryImageSetToCategoryImage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CategoryImage\\Persistence\\SpyCategoryImageSetToCategoryImage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CategoryImage.Persistence.SpyCategoryImageSetToCategoryImage';

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
     * the column name for the id_category_image_set_to_category_image field
     */
    public const COL_ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE = 'spy_category_image_set_to_category_image.id_category_image_set_to_category_image';

    /**
     * the column name for the fk_category_image field
     */
    public const COL_FK_CATEGORY_IMAGE = 'spy_category_image_set_to_category_image.fk_category_image';

    /**
     * the column name for the fk_category_image_set field
     */
    public const COL_FK_CATEGORY_IMAGE_SET = 'spy_category_image_set_to_category_image.fk_category_image_set';

    /**
     * the column name for the sort_order field
     */
    public const COL_SORT_ORDER = 'spy_category_image_set_to_category_image.sort_order';

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
        self::TYPE_PHPNAME       => ['IdCategoryImageSetToCategoryImage', 'FkCategoryImage', 'FkCategoryImageSet', 'SortOrder', ],
        self::TYPE_CAMELNAME     => ['idCategoryImageSetToCategoryImage', 'fkCategoryImage', 'fkCategoryImageSet', 'sortOrder', ],
        self::TYPE_COLNAME       => [SpyCategoryImageSetToCategoryImageTableMap::COL_ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE, SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE, SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE_SET, SpyCategoryImageSetToCategoryImageTableMap::COL_SORT_ORDER, ],
        self::TYPE_FIELDNAME     => ['id_category_image_set_to_category_image', 'fk_category_image', 'fk_category_image_set', 'sort_order', ],
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
        self::TYPE_PHPNAME       => ['IdCategoryImageSetToCategoryImage' => 0, 'FkCategoryImage' => 1, 'FkCategoryImageSet' => 2, 'SortOrder' => 3, ],
        self::TYPE_CAMELNAME     => ['idCategoryImageSetToCategoryImage' => 0, 'fkCategoryImage' => 1, 'fkCategoryImageSet' => 2, 'sortOrder' => 3, ],
        self::TYPE_COLNAME       => [SpyCategoryImageSetToCategoryImageTableMap::COL_ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE => 0, SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE => 1, SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE_SET => 2, SpyCategoryImageSetToCategoryImageTableMap::COL_SORT_ORDER => 3, ],
        self::TYPE_FIELDNAME     => ['id_category_image_set_to_category_image' => 0, 'fk_category_image' => 1, 'fk_category_image_set' => 2, 'sort_order' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCategoryImageSetToCategoryImage' => 'ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE',
        'SpyCategoryImageSetToCategoryImage.IdCategoryImageSetToCategoryImage' => 'ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE',
        'idCategoryImageSetToCategoryImage' => 'ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE',
        'spyCategoryImageSetToCategoryImage.idCategoryImageSetToCategoryImage' => 'ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE',
        'SpyCategoryImageSetToCategoryImageTableMap::COL_ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE' => 'ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE',
        'COL_ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE' => 'ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE',
        'id_category_image_set_to_category_image' => 'ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE',
        'spy_category_image_set_to_category_image.id_category_image_set_to_category_image' => 'ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE',
        'FkCategoryImage' => 'FK_CATEGORY_IMAGE',
        'SpyCategoryImageSetToCategoryImage.FkCategoryImage' => 'FK_CATEGORY_IMAGE',
        'fkCategoryImage' => 'FK_CATEGORY_IMAGE',
        'spyCategoryImageSetToCategoryImage.fkCategoryImage' => 'FK_CATEGORY_IMAGE',
        'SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE' => 'FK_CATEGORY_IMAGE',
        'COL_FK_CATEGORY_IMAGE' => 'FK_CATEGORY_IMAGE',
        'fk_category_image' => 'FK_CATEGORY_IMAGE',
        'spy_category_image_set_to_category_image.fk_category_image' => 'FK_CATEGORY_IMAGE',
        'FkCategoryImageSet' => 'FK_CATEGORY_IMAGE_SET',
        'SpyCategoryImageSetToCategoryImage.FkCategoryImageSet' => 'FK_CATEGORY_IMAGE_SET',
        'fkCategoryImageSet' => 'FK_CATEGORY_IMAGE_SET',
        'spyCategoryImageSetToCategoryImage.fkCategoryImageSet' => 'FK_CATEGORY_IMAGE_SET',
        'SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE_SET' => 'FK_CATEGORY_IMAGE_SET',
        'COL_FK_CATEGORY_IMAGE_SET' => 'FK_CATEGORY_IMAGE_SET',
        'fk_category_image_set' => 'FK_CATEGORY_IMAGE_SET',
        'spy_category_image_set_to_category_image.fk_category_image_set' => 'FK_CATEGORY_IMAGE_SET',
        'SortOrder' => 'SORT_ORDER',
        'SpyCategoryImageSetToCategoryImage.SortOrder' => 'SORT_ORDER',
        'sortOrder' => 'SORT_ORDER',
        'spyCategoryImageSetToCategoryImage.sortOrder' => 'SORT_ORDER',
        'SpyCategoryImageSetToCategoryImageTableMap::COL_SORT_ORDER' => 'SORT_ORDER',
        'COL_SORT_ORDER' => 'SORT_ORDER',
        'sort_order' => 'SORT_ORDER',
        'spy_category_image_set_to_category_image.sort_order' => 'SORT_ORDER',
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
        $this->setName('spy_category_image_set_to_category_image');
        $this->setPhpName('SpyCategoryImageSetToCategoryImage');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\CategoryImage\\Persistence\\SpyCategoryImageSetToCategoryImage');
        $this->setPackage('src.Orm.Zed.CategoryImage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_category_image_set_to_category_image_pk_seq');
        // columns
        $this->addPrimaryKey('id_category_image_set_to_category_image', 'IdCategoryImageSetToCategoryImage', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_category_image', 'FkCategoryImage', 'INTEGER', 'spy_category_image', 'id_category_image', true, null, null);
        $this->addForeignKey('fk_category_image_set', 'FkCategoryImageSet', 'INTEGER', 'spy_category_image_set', 'id_category_image_set', true, null, null);
        $this->addColumn('sort_order', 'SortOrder', 'INTEGER', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyCategoryImageSet', '\\Orm\\Zed\\CategoryImage\\Persistence\\SpyCategoryImageSet', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_category_image_set',
    1 => ':id_category_image_set',
  ),
), null, null, null, false);
        $this->addRelation('SpyCategoryImage', '\\Orm\\Zed\\CategoryImage\\Persistence\\SpyCategoryImage', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_category_image',
    1 => ':id_category_image',
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
            'event' => ['spy_category_image_set_to_category_image_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryImageSetToCategoryImage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryImageSetToCategoryImage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryImageSetToCategoryImage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryImageSetToCategoryImage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryImageSetToCategoryImage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryImageSetToCategoryImage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCategoryImageSetToCategoryImage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCategoryImageSetToCategoryImageTableMap::CLASS_DEFAULT : SpyCategoryImageSetToCategoryImageTableMap::OM_CLASS;
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
     * @return array (SpyCategoryImageSetToCategoryImage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCategoryImageSetToCategoryImageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCategoryImageSetToCategoryImageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCategoryImageSetToCategoryImageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCategoryImageSetToCategoryImageTableMap::OM_CLASS;
            /** @var SpyCategoryImageSetToCategoryImage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCategoryImageSetToCategoryImageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCategoryImageSetToCategoryImageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCategoryImageSetToCategoryImageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCategoryImageSetToCategoryImage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCategoryImageSetToCategoryImageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCategoryImageSetToCategoryImageTableMap::COL_ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE);
            $criteria->addSelectColumn(SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE);
            $criteria->addSelectColumn(SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE_SET);
            $criteria->addSelectColumn(SpyCategoryImageSetToCategoryImageTableMap::COL_SORT_ORDER);
        } else {
            $criteria->addSelectColumn($alias . '.id_category_image_set_to_category_image');
            $criteria->addSelectColumn($alias . '.fk_category_image');
            $criteria->addSelectColumn($alias . '.fk_category_image_set');
            $criteria->addSelectColumn($alias . '.sort_order');
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
            $criteria->removeSelectColumn(SpyCategoryImageSetToCategoryImageTableMap::COL_ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE);
            $criteria->removeSelectColumn(SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE);
            $criteria->removeSelectColumn(SpyCategoryImageSetToCategoryImageTableMap::COL_FK_CATEGORY_IMAGE_SET);
            $criteria->removeSelectColumn(SpyCategoryImageSetToCategoryImageTableMap::COL_SORT_ORDER);
        } else {
            $criteria->removeSelectColumn($alias . '.id_category_image_set_to_category_image');
            $criteria->removeSelectColumn($alias . '.fk_category_image');
            $criteria->removeSelectColumn($alias . '.fk_category_image_set');
            $criteria->removeSelectColumn($alias . '.sort_order');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCategoryImageSetToCategoryImageTableMap::DATABASE_NAME)->getTable(SpyCategoryImageSetToCategoryImageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCategoryImageSetToCategoryImage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCategoryImageSetToCategoryImage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryImageSetToCategoryImageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CategoryImage\Persistence\SpyCategoryImageSetToCategoryImage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCategoryImageSetToCategoryImageTableMap::DATABASE_NAME);
            $criteria->add(SpyCategoryImageSetToCategoryImageTableMap::COL_ID_CATEGORY_IMAGE_SET_TO_CATEGORY_IMAGE, (array) $values, Criteria::IN);
        }

        $query = SpyCategoryImageSetToCategoryImageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCategoryImageSetToCategoryImageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCategoryImageSetToCategoryImageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_category_image_set_to_category_image table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCategoryImageSetToCategoryImageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCategoryImageSetToCategoryImage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCategoryImageSetToCategoryImage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryImageSetToCategoryImageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCategoryImageSetToCategoryImage object
        }


        // Set the correct dbName
        $query = SpyCategoryImageSetToCategoryImageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
