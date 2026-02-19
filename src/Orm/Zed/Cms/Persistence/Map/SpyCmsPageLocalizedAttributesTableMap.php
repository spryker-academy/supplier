<?php

namespace Orm\Zed\Cms\Persistence\Map;

use Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributes;
use Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributesQuery;
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
 * This class defines the structure of the 'spy_cms_page_localized_attributes' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCmsPageLocalizedAttributesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Cms.Persistence.Map.SpyCmsPageLocalizedAttributesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_cms_page_localized_attributes';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCmsPageLocalizedAttributes';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Cms\\Persistence\\SpyCmsPageLocalizedAttributes';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Cms.Persistence.SpyCmsPageLocalizedAttributes';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id_cms_page_localized_attributes field
     */
    public const COL_ID_CMS_PAGE_LOCALIZED_ATTRIBUTES = 'spy_cms_page_localized_attributes.id_cms_page_localized_attributes';

    /**
     * the column name for the fk_cms_page field
     */
    public const COL_FK_CMS_PAGE = 'spy_cms_page_localized_attributes.fk_cms_page';

    /**
     * the column name for the fk_locale field
     */
    public const COL_FK_LOCALE = 'spy_cms_page_localized_attributes.fk_locale';

    /**
     * the column name for the meta_description field
     */
    public const COL_META_DESCRIPTION = 'spy_cms_page_localized_attributes.meta_description';

    /**
     * the column name for the meta_keywords field
     */
    public const COL_META_KEYWORDS = 'spy_cms_page_localized_attributes.meta_keywords';

    /**
     * the column name for the meta_title field
     */
    public const COL_META_TITLE = 'spy_cms_page_localized_attributes.meta_title';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_cms_page_localized_attributes.name';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_cms_page_localized_attributes.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_cms_page_localized_attributes.updated_at';

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
        self::TYPE_PHPNAME       => ['IdCmsPageLocalizedAttributes', 'FkCmsPage', 'FkLocale', 'MetaDescription', 'MetaKeywords', 'MetaTitle', 'Name', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idCmsPageLocalizedAttributes', 'fkCmsPage', 'fkLocale', 'metaDescription', 'metaKeywords', 'metaTitle', 'name', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyCmsPageLocalizedAttributesTableMap::COL_ID_CMS_PAGE_LOCALIZED_ATTRIBUTES, SpyCmsPageLocalizedAttributesTableMap::COL_FK_CMS_PAGE, SpyCmsPageLocalizedAttributesTableMap::COL_FK_LOCALE, SpyCmsPageLocalizedAttributesTableMap::COL_META_DESCRIPTION, SpyCmsPageLocalizedAttributesTableMap::COL_META_KEYWORDS, SpyCmsPageLocalizedAttributesTableMap::COL_META_TITLE, SpyCmsPageLocalizedAttributesTableMap::COL_NAME, SpyCmsPageLocalizedAttributesTableMap::COL_CREATED_AT, SpyCmsPageLocalizedAttributesTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_cms_page_localized_attributes', 'fk_cms_page', 'fk_locale', 'meta_description', 'meta_keywords', 'meta_title', 'name', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
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
        self::TYPE_PHPNAME       => ['IdCmsPageLocalizedAttributes' => 0, 'FkCmsPage' => 1, 'FkLocale' => 2, 'MetaDescription' => 3, 'MetaKeywords' => 4, 'MetaTitle' => 5, 'Name' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idCmsPageLocalizedAttributes' => 0, 'fkCmsPage' => 1, 'fkLocale' => 2, 'metaDescription' => 3, 'metaKeywords' => 4, 'metaTitle' => 5, 'name' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpyCmsPageLocalizedAttributesTableMap::COL_ID_CMS_PAGE_LOCALIZED_ATTRIBUTES => 0, SpyCmsPageLocalizedAttributesTableMap::COL_FK_CMS_PAGE => 1, SpyCmsPageLocalizedAttributesTableMap::COL_FK_LOCALE => 2, SpyCmsPageLocalizedAttributesTableMap::COL_META_DESCRIPTION => 3, SpyCmsPageLocalizedAttributesTableMap::COL_META_KEYWORDS => 4, SpyCmsPageLocalizedAttributesTableMap::COL_META_TITLE => 5, SpyCmsPageLocalizedAttributesTableMap::COL_NAME => 6, SpyCmsPageLocalizedAttributesTableMap::COL_CREATED_AT => 7, SpyCmsPageLocalizedAttributesTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_cms_page_localized_attributes' => 0, 'fk_cms_page' => 1, 'fk_locale' => 2, 'meta_description' => 3, 'meta_keywords' => 4, 'meta_title' => 5, 'name' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCmsPageLocalizedAttributes' => 'ID_CMS_PAGE_LOCALIZED_ATTRIBUTES',
        'SpyCmsPageLocalizedAttributes.IdCmsPageLocalizedAttributes' => 'ID_CMS_PAGE_LOCALIZED_ATTRIBUTES',
        'idCmsPageLocalizedAttributes' => 'ID_CMS_PAGE_LOCALIZED_ATTRIBUTES',
        'spyCmsPageLocalizedAttributes.idCmsPageLocalizedAttributes' => 'ID_CMS_PAGE_LOCALIZED_ATTRIBUTES',
        'SpyCmsPageLocalizedAttributesTableMap::COL_ID_CMS_PAGE_LOCALIZED_ATTRIBUTES' => 'ID_CMS_PAGE_LOCALIZED_ATTRIBUTES',
        'COL_ID_CMS_PAGE_LOCALIZED_ATTRIBUTES' => 'ID_CMS_PAGE_LOCALIZED_ATTRIBUTES',
        'id_cms_page_localized_attributes' => 'ID_CMS_PAGE_LOCALIZED_ATTRIBUTES',
        'spy_cms_page_localized_attributes.id_cms_page_localized_attributes' => 'ID_CMS_PAGE_LOCALIZED_ATTRIBUTES',
        'FkCmsPage' => 'FK_CMS_PAGE',
        'SpyCmsPageLocalizedAttributes.FkCmsPage' => 'FK_CMS_PAGE',
        'fkCmsPage' => 'FK_CMS_PAGE',
        'spyCmsPageLocalizedAttributes.fkCmsPage' => 'FK_CMS_PAGE',
        'SpyCmsPageLocalizedAttributesTableMap::COL_FK_CMS_PAGE' => 'FK_CMS_PAGE',
        'COL_FK_CMS_PAGE' => 'FK_CMS_PAGE',
        'fk_cms_page' => 'FK_CMS_PAGE',
        'spy_cms_page_localized_attributes.fk_cms_page' => 'FK_CMS_PAGE',
        'FkLocale' => 'FK_LOCALE',
        'SpyCmsPageLocalizedAttributes.FkLocale' => 'FK_LOCALE',
        'fkLocale' => 'FK_LOCALE',
        'spyCmsPageLocalizedAttributes.fkLocale' => 'FK_LOCALE',
        'SpyCmsPageLocalizedAttributesTableMap::COL_FK_LOCALE' => 'FK_LOCALE',
        'COL_FK_LOCALE' => 'FK_LOCALE',
        'fk_locale' => 'FK_LOCALE',
        'spy_cms_page_localized_attributes.fk_locale' => 'FK_LOCALE',
        'MetaDescription' => 'META_DESCRIPTION',
        'SpyCmsPageLocalizedAttributes.MetaDescription' => 'META_DESCRIPTION',
        'metaDescription' => 'META_DESCRIPTION',
        'spyCmsPageLocalizedAttributes.metaDescription' => 'META_DESCRIPTION',
        'SpyCmsPageLocalizedAttributesTableMap::COL_META_DESCRIPTION' => 'META_DESCRIPTION',
        'COL_META_DESCRIPTION' => 'META_DESCRIPTION',
        'meta_description' => 'META_DESCRIPTION',
        'spy_cms_page_localized_attributes.meta_description' => 'META_DESCRIPTION',
        'MetaKeywords' => 'META_KEYWORDS',
        'SpyCmsPageLocalizedAttributes.MetaKeywords' => 'META_KEYWORDS',
        'metaKeywords' => 'META_KEYWORDS',
        'spyCmsPageLocalizedAttributes.metaKeywords' => 'META_KEYWORDS',
        'SpyCmsPageLocalizedAttributesTableMap::COL_META_KEYWORDS' => 'META_KEYWORDS',
        'COL_META_KEYWORDS' => 'META_KEYWORDS',
        'meta_keywords' => 'META_KEYWORDS',
        'spy_cms_page_localized_attributes.meta_keywords' => 'META_KEYWORDS',
        'MetaTitle' => 'META_TITLE',
        'SpyCmsPageLocalizedAttributes.MetaTitle' => 'META_TITLE',
        'metaTitle' => 'META_TITLE',
        'spyCmsPageLocalizedAttributes.metaTitle' => 'META_TITLE',
        'SpyCmsPageLocalizedAttributesTableMap::COL_META_TITLE' => 'META_TITLE',
        'COL_META_TITLE' => 'META_TITLE',
        'meta_title' => 'META_TITLE',
        'spy_cms_page_localized_attributes.meta_title' => 'META_TITLE',
        'Name' => 'NAME',
        'SpyCmsPageLocalizedAttributes.Name' => 'NAME',
        'name' => 'NAME',
        'spyCmsPageLocalizedAttributes.name' => 'NAME',
        'SpyCmsPageLocalizedAttributesTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_cms_page_localized_attributes.name' => 'NAME',
        'CreatedAt' => 'CREATED_AT',
        'SpyCmsPageLocalizedAttributes.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyCmsPageLocalizedAttributes.createdAt' => 'CREATED_AT',
        'SpyCmsPageLocalizedAttributesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_cms_page_localized_attributes.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyCmsPageLocalizedAttributes.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyCmsPageLocalizedAttributes.updatedAt' => 'UPDATED_AT',
        'SpyCmsPageLocalizedAttributesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_cms_page_localized_attributes.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_cms_page_localized_attributes');
        $this->setPhpName('SpyCmsPageLocalizedAttributes');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Cms\\Persistence\\SpyCmsPageLocalizedAttributes');
        $this->setPackage('src.Orm.Zed.Cms.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_cms_page_localized_attributes_pk_seq');
        // columns
        $this->addPrimaryKey('id_cms_page_localized_attributes', 'IdCmsPageLocalizedAttributes', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_cms_page', 'FkCmsPage', 'INTEGER', 'spy_cms_page', 'id_cms_page', true, null, null);
        $this->addForeignKey('fk_locale', 'FkLocale', 'INTEGER', 'spy_locale', 'id_locale', true, null, null);
        $this->addColumn('meta_description', 'MetaDescription', 'LONGVARCHAR', false, null, null);
        $this->addColumn('meta_keywords', 'MetaKeywords', 'LONGVARCHAR', false, null, null);
        $this->addColumn('meta_title', 'MetaTitle', 'VARCHAR', false, 255, null);
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
        $this->addRelation('SpyCmsPage', '\\Orm\\Zed\\Cms\\Persistence\\SpyCmsPage', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_cms_page',
    1 => ':id_cms_page',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('Locale', '\\Orm\\Zed\\Locale\\Persistence\\SpyLocale', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_locale',
    1 => ':id_locale',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPageLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPageLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPageLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPageLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPageLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPageLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCmsPageLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCmsPageLocalizedAttributesTableMap::CLASS_DEFAULT : SpyCmsPageLocalizedAttributesTableMap::OM_CLASS;
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
     * @return array (SpyCmsPageLocalizedAttributes object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCmsPageLocalizedAttributesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCmsPageLocalizedAttributesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCmsPageLocalizedAttributesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCmsPageLocalizedAttributesTableMap::OM_CLASS;
            /** @var SpyCmsPageLocalizedAttributes $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCmsPageLocalizedAttributesTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCmsPageLocalizedAttributesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCmsPageLocalizedAttributesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCmsPageLocalizedAttributes $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCmsPageLocalizedAttributesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_ID_CMS_PAGE_LOCALIZED_ATTRIBUTES);
            $criteria->addSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_FK_CMS_PAGE);
            $criteria->addSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_FK_LOCALE);
            $criteria->addSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_META_DESCRIPTION);
            $criteria->addSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_META_KEYWORDS);
            $criteria->addSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_META_TITLE);
            $criteria->addSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_cms_page_localized_attributes');
            $criteria->addSelectColumn($alias . '.fk_cms_page');
            $criteria->addSelectColumn($alias . '.fk_locale');
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
            $criteria->removeSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_ID_CMS_PAGE_LOCALIZED_ATTRIBUTES);
            $criteria->removeSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_FK_CMS_PAGE);
            $criteria->removeSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_FK_LOCALE);
            $criteria->removeSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_META_DESCRIPTION);
            $criteria->removeSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_META_KEYWORDS);
            $criteria->removeSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_META_TITLE);
            $criteria->removeSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyCmsPageLocalizedAttributesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_cms_page_localized_attributes');
            $criteria->removeSelectColumn($alias . '.fk_cms_page');
            $criteria->removeSelectColumn($alias . '.fk_locale');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCmsPageLocalizedAttributesTableMap::DATABASE_NAME)->getTable(SpyCmsPageLocalizedAttributesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCmsPageLocalizedAttributes or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCmsPageLocalizedAttributes object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsPageLocalizedAttributesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Cms\Persistence\SpyCmsPageLocalizedAttributes) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCmsPageLocalizedAttributesTableMap::DATABASE_NAME);
            $criteria->add(SpyCmsPageLocalizedAttributesTableMap::COL_ID_CMS_PAGE_LOCALIZED_ATTRIBUTES, (array) $values, Criteria::IN);
        }

        $query = SpyCmsPageLocalizedAttributesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCmsPageLocalizedAttributesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCmsPageLocalizedAttributesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_cms_page_localized_attributes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCmsPageLocalizedAttributesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCmsPageLocalizedAttributes or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCmsPageLocalizedAttributes object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsPageLocalizedAttributesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCmsPageLocalizedAttributes object
        }


        // Set the correct dbName
        $query = SpyCmsPageLocalizedAttributesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
