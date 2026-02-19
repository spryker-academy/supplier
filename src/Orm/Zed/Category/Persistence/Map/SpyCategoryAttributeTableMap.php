<?php

namespace Orm\Zed\Category\Persistence\Map;

use Orm\Zed\Category\Persistence\SpyCategoryAttribute;
use Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery;
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
 * This class defines the structure of the 'spy_category_attribute' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCategoryAttributeTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Category.Persistence.Map.SpyCategoryAttributeTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_category_attribute';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCategoryAttribute';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Category\\Persistence\\SpyCategoryAttribute';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Category.Persistence.SpyCategoryAttribute';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id_category_attribute field
     */
    public const COL_ID_CATEGORY_ATTRIBUTE = 'spy_category_attribute.id_category_attribute';

    /**
     * the column name for the fk_category field
     */
    public const COL_FK_CATEGORY = 'spy_category_attribute.fk_category';

    /**
     * the column name for the fk_locale field
     */
    public const COL_FK_LOCALE = 'spy_category_attribute.fk_locale';

    /**
     * the column name for the category_image_name field
     */
    public const COL_CATEGORY_IMAGE_NAME = 'spy_category_attribute.category_image_name';

    /**
     * the column name for the meta_description field
     */
    public const COL_META_DESCRIPTION = 'spy_category_attribute.meta_description';

    /**
     * the column name for the meta_keywords field
     */
    public const COL_META_KEYWORDS = 'spy_category_attribute.meta_keywords';

    /**
     * the column name for the meta_title field
     */
    public const COL_META_TITLE = 'spy_category_attribute.meta_title';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_category_attribute.name';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_category_attribute.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_category_attribute.updated_at';

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
        self::TYPE_PHPNAME       => ['IdCategoryAttribute', 'FkCategory', 'FkLocale', 'CategoryImageName', 'MetaDescription', 'MetaKeywords', 'MetaTitle', 'Name', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idCategoryAttribute', 'fkCategory', 'fkLocale', 'categoryImageName', 'metaDescription', 'metaKeywords', 'metaTitle', 'name', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyCategoryAttributeTableMap::COL_ID_CATEGORY_ATTRIBUTE, SpyCategoryAttributeTableMap::COL_FK_CATEGORY, SpyCategoryAttributeTableMap::COL_FK_LOCALE, SpyCategoryAttributeTableMap::COL_CATEGORY_IMAGE_NAME, SpyCategoryAttributeTableMap::COL_META_DESCRIPTION, SpyCategoryAttributeTableMap::COL_META_KEYWORDS, SpyCategoryAttributeTableMap::COL_META_TITLE, SpyCategoryAttributeTableMap::COL_NAME, SpyCategoryAttributeTableMap::COL_CREATED_AT, SpyCategoryAttributeTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_category_attribute', 'fk_category', 'fk_locale', 'category_image_name', 'meta_description', 'meta_keywords', 'meta_title', 'name', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['IdCategoryAttribute' => 0, 'FkCategory' => 1, 'FkLocale' => 2, 'CategoryImageName' => 3, 'MetaDescription' => 4, 'MetaKeywords' => 5, 'MetaTitle' => 6, 'Name' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ],
        self::TYPE_CAMELNAME     => ['idCategoryAttribute' => 0, 'fkCategory' => 1, 'fkLocale' => 2, 'categoryImageName' => 3, 'metaDescription' => 4, 'metaKeywords' => 5, 'metaTitle' => 6, 'name' => 7, 'createdAt' => 8, 'updatedAt' => 9, ],
        self::TYPE_COLNAME       => [SpyCategoryAttributeTableMap::COL_ID_CATEGORY_ATTRIBUTE => 0, SpyCategoryAttributeTableMap::COL_FK_CATEGORY => 1, SpyCategoryAttributeTableMap::COL_FK_LOCALE => 2, SpyCategoryAttributeTableMap::COL_CATEGORY_IMAGE_NAME => 3, SpyCategoryAttributeTableMap::COL_META_DESCRIPTION => 4, SpyCategoryAttributeTableMap::COL_META_KEYWORDS => 5, SpyCategoryAttributeTableMap::COL_META_TITLE => 6, SpyCategoryAttributeTableMap::COL_NAME => 7, SpyCategoryAttributeTableMap::COL_CREATED_AT => 8, SpyCategoryAttributeTableMap::COL_UPDATED_AT => 9, ],
        self::TYPE_FIELDNAME     => ['id_category_attribute' => 0, 'fk_category' => 1, 'fk_locale' => 2, 'category_image_name' => 3, 'meta_description' => 4, 'meta_keywords' => 5, 'meta_title' => 6, 'name' => 7, 'created_at' => 8, 'updated_at' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCategoryAttribute' => 'ID_CATEGORY_ATTRIBUTE',
        'SpyCategoryAttribute.IdCategoryAttribute' => 'ID_CATEGORY_ATTRIBUTE',
        'idCategoryAttribute' => 'ID_CATEGORY_ATTRIBUTE',
        'spyCategoryAttribute.idCategoryAttribute' => 'ID_CATEGORY_ATTRIBUTE',
        'SpyCategoryAttributeTableMap::COL_ID_CATEGORY_ATTRIBUTE' => 'ID_CATEGORY_ATTRIBUTE',
        'COL_ID_CATEGORY_ATTRIBUTE' => 'ID_CATEGORY_ATTRIBUTE',
        'id_category_attribute' => 'ID_CATEGORY_ATTRIBUTE',
        'spy_category_attribute.id_category_attribute' => 'ID_CATEGORY_ATTRIBUTE',
        'FkCategory' => 'FK_CATEGORY',
        'SpyCategoryAttribute.FkCategory' => 'FK_CATEGORY',
        'fkCategory' => 'FK_CATEGORY',
        'spyCategoryAttribute.fkCategory' => 'FK_CATEGORY',
        'SpyCategoryAttributeTableMap::COL_FK_CATEGORY' => 'FK_CATEGORY',
        'COL_FK_CATEGORY' => 'FK_CATEGORY',
        'fk_category' => 'FK_CATEGORY',
        'spy_category_attribute.fk_category' => 'FK_CATEGORY',
        'FkLocale' => 'FK_LOCALE',
        'SpyCategoryAttribute.FkLocale' => 'FK_LOCALE',
        'fkLocale' => 'FK_LOCALE',
        'spyCategoryAttribute.fkLocale' => 'FK_LOCALE',
        'SpyCategoryAttributeTableMap::COL_FK_LOCALE' => 'FK_LOCALE',
        'COL_FK_LOCALE' => 'FK_LOCALE',
        'fk_locale' => 'FK_LOCALE',
        'spy_category_attribute.fk_locale' => 'FK_LOCALE',
        'CategoryImageName' => 'CATEGORY_IMAGE_NAME',
        'SpyCategoryAttribute.CategoryImageName' => 'CATEGORY_IMAGE_NAME',
        'categoryImageName' => 'CATEGORY_IMAGE_NAME',
        'spyCategoryAttribute.categoryImageName' => 'CATEGORY_IMAGE_NAME',
        'SpyCategoryAttributeTableMap::COL_CATEGORY_IMAGE_NAME' => 'CATEGORY_IMAGE_NAME',
        'COL_CATEGORY_IMAGE_NAME' => 'CATEGORY_IMAGE_NAME',
        'category_image_name' => 'CATEGORY_IMAGE_NAME',
        'spy_category_attribute.category_image_name' => 'CATEGORY_IMAGE_NAME',
        'MetaDescription' => 'META_DESCRIPTION',
        'SpyCategoryAttribute.MetaDescription' => 'META_DESCRIPTION',
        'metaDescription' => 'META_DESCRIPTION',
        'spyCategoryAttribute.metaDescription' => 'META_DESCRIPTION',
        'SpyCategoryAttributeTableMap::COL_META_DESCRIPTION' => 'META_DESCRIPTION',
        'COL_META_DESCRIPTION' => 'META_DESCRIPTION',
        'meta_description' => 'META_DESCRIPTION',
        'spy_category_attribute.meta_description' => 'META_DESCRIPTION',
        'MetaKeywords' => 'META_KEYWORDS',
        'SpyCategoryAttribute.MetaKeywords' => 'META_KEYWORDS',
        'metaKeywords' => 'META_KEYWORDS',
        'spyCategoryAttribute.metaKeywords' => 'META_KEYWORDS',
        'SpyCategoryAttributeTableMap::COL_META_KEYWORDS' => 'META_KEYWORDS',
        'COL_META_KEYWORDS' => 'META_KEYWORDS',
        'meta_keywords' => 'META_KEYWORDS',
        'spy_category_attribute.meta_keywords' => 'META_KEYWORDS',
        'MetaTitle' => 'META_TITLE',
        'SpyCategoryAttribute.MetaTitle' => 'META_TITLE',
        'metaTitle' => 'META_TITLE',
        'spyCategoryAttribute.metaTitle' => 'META_TITLE',
        'SpyCategoryAttributeTableMap::COL_META_TITLE' => 'META_TITLE',
        'COL_META_TITLE' => 'META_TITLE',
        'meta_title' => 'META_TITLE',
        'spy_category_attribute.meta_title' => 'META_TITLE',
        'Name' => 'NAME',
        'SpyCategoryAttribute.Name' => 'NAME',
        'name' => 'NAME',
        'spyCategoryAttribute.name' => 'NAME',
        'SpyCategoryAttributeTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_category_attribute.name' => 'NAME',
        'CreatedAt' => 'CREATED_AT',
        'SpyCategoryAttribute.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyCategoryAttribute.createdAt' => 'CREATED_AT',
        'SpyCategoryAttributeTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_category_attribute.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyCategoryAttribute.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyCategoryAttribute.updatedAt' => 'UPDATED_AT',
        'SpyCategoryAttributeTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_category_attribute.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_category_attribute');
        $this->setPhpName('SpyCategoryAttribute');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Category\\Persistence\\SpyCategoryAttribute');
        $this->setPackage('src.Orm.Zed.Category.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_category_attribute_pk_seq');
        // columns
        $this->addPrimaryKey('id_category_attribute', 'IdCategoryAttribute', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_category', 'FkCategory', 'INTEGER', 'spy_category', 'id_category', true, null, null);
        $this->addForeignKey('fk_locale', 'FkLocale', 'INTEGER', 'spy_locale', 'id_locale', true, null, null);
        $this->addColumn('category_image_name', 'CategoryImageName', 'VARCHAR', false, 255, null);
        $this->addColumn('meta_description', 'MetaDescription', 'LONGVARCHAR', false, null, null);
        $this->addColumn('meta_keywords', 'MetaKeywords', 'LONGVARCHAR', false, null, null);
        $this->addColumn('meta_title', 'MetaTitle', 'LONGVARCHAR', false, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
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
        $this->addRelation('Locale', '\\Orm\\Zed\\Locale\\Persistence\\SpyLocale', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_locale',
    1 => ':id_locale',
  ),
), null, null, null, false);
        $this->addRelation('Category', '\\Orm\\Zed\\Category\\Persistence\\SpyCategory', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_category',
    1 => ':id_category',
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
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', 'is_timestamp' => 'true'],
            'event' => ['spy_category_attribute_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryAttribute', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryAttribute', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryAttribute', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryAttribute', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryAttribute', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCategoryAttribute', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCategoryAttribute', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCategoryAttributeTableMap::CLASS_DEFAULT : SpyCategoryAttributeTableMap::OM_CLASS;
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
     * @return array (SpyCategoryAttribute object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCategoryAttributeTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCategoryAttributeTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCategoryAttributeTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCategoryAttributeTableMap::OM_CLASS;
            /** @var SpyCategoryAttribute $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCategoryAttributeTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCategoryAttributeTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCategoryAttributeTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCategoryAttribute $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCategoryAttributeTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCategoryAttributeTableMap::COL_ID_CATEGORY_ATTRIBUTE);
            $criteria->addSelectColumn(SpyCategoryAttributeTableMap::COL_FK_CATEGORY);
            $criteria->addSelectColumn(SpyCategoryAttributeTableMap::COL_FK_LOCALE);
            $criteria->addSelectColumn(SpyCategoryAttributeTableMap::COL_CATEGORY_IMAGE_NAME);
            $criteria->addSelectColumn(SpyCategoryAttributeTableMap::COL_META_DESCRIPTION);
            $criteria->addSelectColumn(SpyCategoryAttributeTableMap::COL_META_KEYWORDS);
            $criteria->addSelectColumn(SpyCategoryAttributeTableMap::COL_META_TITLE);
            $criteria->addSelectColumn(SpyCategoryAttributeTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyCategoryAttributeTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyCategoryAttributeTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_category_attribute');
            $criteria->addSelectColumn($alias . '.fk_category');
            $criteria->addSelectColumn($alias . '.fk_locale');
            $criteria->addSelectColumn($alias . '.category_image_name');
            $criteria->addSelectColumn($alias . '.meta_description');
            $criteria->addSelectColumn($alias . '.meta_keywords');
            $criteria->addSelectColumn($alias . '.meta_title');
            $criteria->addSelectColumn($alias . '.name');
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
            $criteria->removeSelectColumn(SpyCategoryAttributeTableMap::COL_ID_CATEGORY_ATTRIBUTE);
            $criteria->removeSelectColumn(SpyCategoryAttributeTableMap::COL_FK_CATEGORY);
            $criteria->removeSelectColumn(SpyCategoryAttributeTableMap::COL_FK_LOCALE);
            $criteria->removeSelectColumn(SpyCategoryAttributeTableMap::COL_CATEGORY_IMAGE_NAME);
            $criteria->removeSelectColumn(SpyCategoryAttributeTableMap::COL_META_DESCRIPTION);
            $criteria->removeSelectColumn(SpyCategoryAttributeTableMap::COL_META_KEYWORDS);
            $criteria->removeSelectColumn(SpyCategoryAttributeTableMap::COL_META_TITLE);
            $criteria->removeSelectColumn(SpyCategoryAttributeTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyCategoryAttributeTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyCategoryAttributeTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_category_attribute');
            $criteria->removeSelectColumn($alias . '.fk_category');
            $criteria->removeSelectColumn($alias . '.fk_locale');
            $criteria->removeSelectColumn($alias . '.category_image_name');
            $criteria->removeSelectColumn($alias . '.meta_description');
            $criteria->removeSelectColumn($alias . '.meta_keywords');
            $criteria->removeSelectColumn($alias . '.meta_title');
            $criteria->removeSelectColumn($alias . '.name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCategoryAttributeTableMap::DATABASE_NAME)->getTable(SpyCategoryAttributeTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCategoryAttribute or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCategoryAttribute object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryAttributeTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Category\Persistence\SpyCategoryAttribute) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCategoryAttributeTableMap::DATABASE_NAME);
            $criteria->add(SpyCategoryAttributeTableMap::COL_ID_CATEGORY_ATTRIBUTE, (array) $values, Criteria::IN);
        }

        $query = SpyCategoryAttributeQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCategoryAttributeTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCategoryAttributeTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_category_attribute table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCategoryAttributeQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCategoryAttribute or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCategoryAttribute object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCategoryAttributeTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCategoryAttribute object
        }

        if ($criteria->containsKey(SpyCategoryAttributeTableMap::COL_ID_CATEGORY_ATTRIBUTE) && $criteria->keyContainsValue(SpyCategoryAttributeTableMap::COL_ID_CATEGORY_ATTRIBUTE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCategoryAttributeTableMap::COL_ID_CATEGORY_ATTRIBUTE.')');
        }


        // Set the correct dbName
        $query = SpyCategoryAttributeQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
