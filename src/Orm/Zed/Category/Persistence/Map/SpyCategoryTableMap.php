<?php

namespace Orm\Zed\Category\Persistence\Map;

use Orm\Zed\Category\Persistence\SpyCategory;
use Orm\Zed\Category\Persistence\SpyCategoryQuery;
use Orm\Zed\CmsBlockCategoryConnector\Persistence\Map\SpyCmsBlockCategoryConnectorTableMap;
use Orm\Zed\MerchantCategory\Persistence\Map\SpyMerchantCategoryTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListCategoryTableMap;
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
 * This class defines the structure of the 'spy_category' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCategoryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Category.Persistence.Map.SpyCategoryTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_category';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCategory';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Category\\Persistence\\SpyCategory';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Category.Persistence.SpyCategory';

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
     * the column name for the id_category field
     */
    public const COL_ID_CATEGORY = 'spy_category.id_category';

    /**
     * the column name for the fk_category_template field
     */
    public const COL_FK_CATEGORY_TEMPLATE = 'spy_category.fk_category_template';

    /**
     * the column name for the category_key field
     */
    public const COL_CATEGORY_KEY = 'spy_category.category_key';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_category.is_active';

    /**
     * the column name for the is_clickable field
     */
    public const COL_IS_CLICKABLE = 'spy_category.is_clickable';

    /**
     * the column name for the is_in_menu field
     */
    public const COL_IS_IN_MENU = 'spy_category.is_in_menu';

    /**
     * the column name for the is_searchable field
     */
    public const COL_IS_SEARCHABLE = 'spy_category.is_searchable';

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
        self::TYPE_PHPNAME       => ['IdCategory', 'FkCategoryTemplate', 'CategoryKey', 'IsActive', 'IsClickable', 'IsInMenu', 'IsSearchable', ],
        self::TYPE_CAMELNAME     => ['idCategory', 'fkCategoryTemplate', 'categoryKey', 'isActive', 'isClickable', 'isInMenu', 'isSearchable', ],
        self::TYPE_COLNAME       => [SpyCategoryTableMap::COL_ID_CATEGORY, SpyCategoryTableMap::COL_FK_CATEGORY_TEMPLATE, SpyCategoryTableMap::COL_CATEGORY_KEY, SpyCategoryTableMap::COL_IS_ACTIVE, SpyCategoryTableMap::COL_IS_CLICKABLE, SpyCategoryTableMap::COL_IS_IN_MENU, SpyCategoryTableMap::COL_IS_SEARCHABLE, ],
        self::TYPE_FIELDNAME     => ['id_category', 'fk_category_template', 'category_key', 'is_active', 'is_clickable', 'is_in_menu', 'is_searchable', ],
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
        self::TYPE_PHPNAME       => ['IdCategory' => 0, 'FkCategoryTemplate' => 1, 'CategoryKey' => 2, 'IsActive' => 3, 'IsClickable' => 4, 'IsInMenu' => 5, 'IsSearchable' => 6, ],
        self::TYPE_CAMELNAME     => ['idCategory' => 0, 'fkCategoryTemplate' => 1, 'categoryKey' => 2, 'isActive' => 3, 'isClickable' => 4, 'isInMenu' => 5, 'isSearchable' => 6, ],
        self::TYPE_COLNAME       => [SpyCategoryTableMap::COL_ID_CATEGORY => 0, SpyCategoryTableMap::COL_FK_CATEGORY_TEMPLATE => 1, SpyCategoryTableMap::COL_CATEGORY_KEY => 2, SpyCategoryTableMap::COL_IS_ACTIVE => 3, SpyCategoryTableMap::COL_IS_CLICKABLE => 4, SpyCategoryTableMap::COL_IS_IN_MENU => 5, SpyCategoryTableMap::COL_IS_SEARCHABLE => 6, ],
        self::TYPE_FIELDNAME     => ['id_category' => 0, 'fk_category_template' => 1, 'category_key' => 2, 'is_active' => 3, 'is_clickable' => 4, 'is_in_menu' => 5, 'is_searchable' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCategory' => 'ID_CATEGORY',
        'SpyCategory.IdCategory' => 'ID_CATEGORY',
        'idCategory' => 'ID_CATEGORY',
        'spyCategory.idCategory' => 'ID_CATEGORY',
        'SpyCategoryTableMap::COL_ID_CATEGORY' => 'ID_CATEGORY',
        'COL_ID_CATEGORY' => 'ID_CATEGORY',
        'id_category' => 'ID_CATEGORY',
        'spy_category.id_category' => 'ID_CATEGORY',
        'FkCategoryTemplate' => 'FK_CATEGORY_TEMPLATE',
        'SpyCategory.FkCategoryTemplate' => 'FK_CATEGORY_TEMPLATE',
        'fkCategoryTemplate' => 'FK_CATEGORY_TEMPLATE',
        'spyCategory.fkCategoryTemplate' => 'FK_CATEGORY_TEMPLATE',
        'SpyCategoryTableMap::COL_FK_CATEGORY_TEMPLATE' => 'FK_CATEGORY_TEMPLATE',
        'COL_FK_CATEGORY_TEMPLATE' => 'FK_CATEGORY_TEMPLATE',
        'fk_category_template' => 'FK_CATEGORY_TEMPLATE',
        'spy_category.fk_category_template' => 'FK_CATEGORY_TEMPLATE',
        'CategoryKey' => 'CATEGORY_KEY',
        'SpyCategory.CategoryKey' => 'CATEGORY_KEY',
        'categoryKey' => 'CATEGORY_KEY',
        'spyCategory.categoryKey' => 'CATEGORY_KEY',
        'SpyCategoryTableMap::COL_CATEGORY_KEY' => 'CATEGORY_KEY',
        'COL_CATEGORY_KEY' => 'CATEGORY_KEY',
        'category_key' => 'CATEGORY_KEY',
        'spy_category.category_key' => 'CATEGORY_KEY',
        'IsActive' => 'IS_ACTIVE',
        'SpyCategory.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyCategory.isActive' => 'IS_ACTIVE',
        'SpyCategoryTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_category.is_active' => 'IS_ACTIVE',
        'IsClickable' => 'IS_CLICKABLE',
        'SpyCategory.IsClickable' => 'IS_CLICKABLE',
        'isClickable' => 'IS_CLICKABLE',
        'spyCategory.isClickable' => 'IS_CLICKABLE',
        'SpyCategoryTableMap::COL_IS_CLICKABLE' => 'IS_CLICKABLE',
        'COL_IS_CLICKABLE' => 'IS_CLICKABLE',
        'is_clickable' => 'IS_CLICKABLE',
        'spy_category.is_clickable' => 'IS_CLICKABLE',
        'IsInMenu' => 'IS_IN_MENU',
        'SpyCategory.IsInMenu' => 'IS_IN_MENU',
        'isInMenu' => 'IS_IN_MENU',
        'spyCategory.isInMenu' => 'IS_IN_MENU',
        'SpyCategoryTableMap::COL_IS_IN_MENU' => 'IS_IN_MENU',
        'COL_IS_IN_MENU' => 'IS_IN_MENU',
        'is_in_menu' => 'IS_IN_MENU',
        'spy_category.is_in_menu' => 'IS_IN_MENU',
        'IsSearchable' => 'IS_SEARCHABLE',
        'SpyCategory.IsSearchable' => 'IS_SEARCHABLE',
        'isSearchable' => 'IS_SEARCHABLE',
        'spyCategory.isSearchable' => 'IS_SEARCHABLE',
        'SpyCategoryTableMap::COL_IS_SEARCHABLE' => 'IS_SEARCHABLE',
        'COL_IS_SEARCHABLE' => 'IS_SEARCHABLE',
        'is_searchable' => 'IS_SEARCHABLE',
        'spy_category.is_searchable' => 'IS_SEARCHABLE',
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
        $this->setName('spy_category');
        $this->setPhpName('SpyCategory');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Category\\Persistence\\SpyCategory');
        $this->setPackage('src.Orm.Zed.Category.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_category_pk_seq');
        // columns
        $this->addPrimaryKey('id_category', 'IdCategory', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_category_template', 'FkCategoryTemplate', 'INTEGER', 'spy_category_template', 'id_category_template', true, null, null);
        $this->addColumn('category_key', 'CategoryKey', 'VARCHAR', true, 255, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', false, 1, true);
        $this->addColumn('is_clickable', 'IsClickable', 'BOOLEAN', false, 1, true);
        $this->addColumn('is_in_menu', 'IsInMenu', 'BOOLEAN', false, 1, true);
        $this->addColumn('is_searchable', 'IsSearchable', 'BOOLEAN', false, 1, true);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('CategoryTemplate', '\\Orm\\Zed\\Category\\Persistence\\SpyCategoryTemplate', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_category_template',
    1 => ':id_category_template',
  ),
), null, null, null, false);
        $this->addRelation('Attribute', '\\Orm\\Zed\\Category\\Persistence\\SpyCategoryAttribute', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_category',
    1 => ':id_category',
  ),
), null, null, 'Attributes', false);
        $this->addRelation('Node', '\\Orm\\Zed\\Category\\Persistence\\SpyCategoryNode', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_category',
    1 => ':id_category',
  ),
), null, null, 'Nodes', false);
        $this->addRelation('SpyCategoryStore', '\\Orm\\Zed\\Category\\Persistence\\SpyCategoryStore', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_category',
    1 => ':id_category',
  ),
), 'CASCADE', null, 'SpyCategoryStores', false);
        $this->addRelation('SpyCategoryImageSet', '\\Orm\\Zed\\CategoryImage\\Persistence\\SpyCategoryImageSet', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_category',
    1 => ':id_category',
  ),
), null, null, 'SpyCategoryImageSets', false);
        $this->addRelation('SpyCmsBlockCategoryConnector', '\\Orm\\Zed\\CmsBlockCategoryConnector\\Persistence\\SpyCmsBlockCategoryConnector', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_category',
    1 => ':id_category',
  ),
), 'CASCADE', null, 'SpyCmsBlockCategoryConnectors', false);
        $this->addRelation('SpyMerchantCategory', '\\Orm\\Zed\\MerchantCategory\\Persistence\\SpyMerchantCategory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_category',
    1 => ':id_category',
  ),
), 'CASCADE', null, 'SpyMerchantCategories', false);
        $this->addRelation('SpyProductCategory', '\\Orm\\Zed\\ProductCategory\\Persistence\\SpyProductCategory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_category',
    1 => ':id_category',
  ),
), null, null, 'SpyProductCategories', false);
        $this->addRelation('SpyProductCategoryFilter', '\\Orm\\Zed\\ProductCategoryFilter\\Persistence\\SpyProductCategoryFilter', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_category',
    1 => ':id_category',
  ),
), null, null, 'SpyProductCategoryFilters', false);
        $this->addRelation('SpyProductListCategory', '\\Orm\\Zed\\ProductList\\Persistence\\SpyProductListCategory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_category',
    1 => ':id_category',
  ),
), 'CASCADE', null, 'SpyProductListCategories', false);
        $this->addRelation('SpyProductList', '\\Orm\\Zed\\ProductList\\Persistence\\SpyProductList', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'SpyProductLists');
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
            'event' => ['spy_category_all' => ['column' => '*']],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_category     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyCategoryStoreTableMap::clearInstancePool();
        SpyCmsBlockCategoryConnectorTableMap::clearInstancePool();
        SpyMerchantCategoryTableMap::clearInstancePool();
        SpyProductListCategoryTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategory', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategory', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategory', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategory', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategory', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategory', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCategory', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCategoryTableMap::CLASS_DEFAULT : SpyCategoryTableMap::OM_CLASS;
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
     * @return array (SpyCategory object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCategoryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCategoryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCategoryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCategoryTableMap::OM_CLASS;
            /** @var SpyCategory $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCategoryTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCategoryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCategoryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCategory $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCategoryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCategoryTableMap::COL_ID_CATEGORY);
            $criteria->addSelectColumn(SpyCategoryTableMap::COL_FK_CATEGORY_TEMPLATE);
            $criteria->addSelectColumn(SpyCategoryTableMap::COL_CATEGORY_KEY);
            $criteria->addSelectColumn(SpyCategoryTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyCategoryTableMap::COL_IS_CLICKABLE);
            $criteria->addSelectColumn(SpyCategoryTableMap::COL_IS_IN_MENU);
            $criteria->addSelectColumn(SpyCategoryTableMap::COL_IS_SEARCHABLE);
        } else {
            $criteria->addSelectColumn($alias . '.id_category');
            $criteria->addSelectColumn($alias . '.fk_category_template');
            $criteria->addSelectColumn($alias . '.category_key');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.is_clickable');
            $criteria->addSelectColumn($alias . '.is_in_menu');
            $criteria->addSelectColumn($alias . '.is_searchable');
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
            $criteria->removeSelectColumn(SpyCategoryTableMap::COL_ID_CATEGORY);
            $criteria->removeSelectColumn(SpyCategoryTableMap::COL_FK_CATEGORY_TEMPLATE);
            $criteria->removeSelectColumn(SpyCategoryTableMap::COL_CATEGORY_KEY);
            $criteria->removeSelectColumn(SpyCategoryTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyCategoryTableMap::COL_IS_CLICKABLE);
            $criteria->removeSelectColumn(SpyCategoryTableMap::COL_IS_IN_MENU);
            $criteria->removeSelectColumn(SpyCategoryTableMap::COL_IS_SEARCHABLE);
        } else {
            $criteria->removeSelectColumn($alias . '.id_category');
            $criteria->removeSelectColumn($alias . '.fk_category_template');
            $criteria->removeSelectColumn($alias . '.category_key');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.is_clickable');
            $criteria->removeSelectColumn($alias . '.is_in_menu');
            $criteria->removeSelectColumn($alias . '.is_searchable');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCategoryTableMap::DATABASE_NAME)->getTable(SpyCategoryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCategory or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCategory object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Category\Persistence\SpyCategory) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCategoryTableMap::DATABASE_NAME);
            $criteria->add(SpyCategoryTableMap::COL_ID_CATEGORY, (array) $values, Criteria::IN);
        }

        $query = SpyCategoryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCategoryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCategoryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_category table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCategoryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCategory or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCategory object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCategory object
        }

        if ($criteria->containsKey(SpyCategoryTableMap::COL_ID_CATEGORY) && $criteria->keyContainsValue(SpyCategoryTableMap::COL_ID_CATEGORY) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCategoryTableMap::COL_ID_CATEGORY.')');
        }


        // Set the correct dbName
        $query = SpyCategoryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
