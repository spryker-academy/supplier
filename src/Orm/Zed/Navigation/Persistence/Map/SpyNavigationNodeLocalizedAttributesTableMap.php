<?php

namespace Orm\Zed\Navigation\Persistence\Map;

use Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes;
use Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributesQuery;
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
 * This class defines the structure of the 'spy_navigation_node_localized_attributes' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyNavigationNodeLocalizedAttributesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Navigation.Persistence.Map.SpyNavigationNodeLocalizedAttributesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_navigation_node_localized_attributes';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyNavigationNodeLocalizedAttributes';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Navigation\\Persistence\\SpyNavigationNodeLocalizedAttributes';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Navigation.Persistence.SpyNavigationNodeLocalizedAttributes';

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
     * the column name for the id_navigation_node_localized_attributes field
     */
    public const COL_ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES = 'spy_navigation_node_localized_attributes.id_navigation_node_localized_attributes';

    /**
     * the column name for the fk_locale field
     */
    public const COL_FK_LOCALE = 'spy_navigation_node_localized_attributes.fk_locale';

    /**
     * the column name for the fk_navigation_node field
     */
    public const COL_FK_NAVIGATION_NODE = 'spy_navigation_node_localized_attributes.fk_navigation_node';

    /**
     * the column name for the fk_url field
     */
    public const COL_FK_URL = 'spy_navigation_node_localized_attributes.fk_url';

    /**
     * the column name for the css_class field
     */
    public const COL_CSS_CLASS = 'spy_navigation_node_localized_attributes.css_class';

    /**
     * the column name for the external_url field
     */
    public const COL_EXTERNAL_URL = 'spy_navigation_node_localized_attributes.external_url';

    /**
     * the column name for the link field
     */
    public const COL_LINK = 'spy_navigation_node_localized_attributes.link';

    /**
     * the column name for the title field
     */
    public const COL_TITLE = 'spy_navigation_node_localized_attributes.title';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_navigation_node_localized_attributes.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_navigation_node_localized_attributes.updated_at';

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
        self::TYPE_PHPNAME       => ['IdNavigationNodeLocalizedAttributes', 'FkLocale', 'FkNavigationNode', 'FkUrl', 'CssClass', 'ExternalUrl', 'Link', 'Title', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idNavigationNodeLocalizedAttributes', 'fkLocale', 'fkNavigationNode', 'fkUrl', 'cssClass', 'externalUrl', 'link', 'title', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyNavigationNodeLocalizedAttributesTableMap::COL_ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES, SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_LOCALE, SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_NAVIGATION_NODE, SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_URL, SpyNavigationNodeLocalizedAttributesTableMap::COL_CSS_CLASS, SpyNavigationNodeLocalizedAttributesTableMap::COL_EXTERNAL_URL, SpyNavigationNodeLocalizedAttributesTableMap::COL_LINK, SpyNavigationNodeLocalizedAttributesTableMap::COL_TITLE, SpyNavigationNodeLocalizedAttributesTableMap::COL_CREATED_AT, SpyNavigationNodeLocalizedAttributesTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_navigation_node_localized_attributes', 'fk_locale', 'fk_navigation_node', 'fk_url', 'css_class', 'external_url', 'link', 'title', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdNavigationNodeLocalizedAttributes' => 0, 'FkLocale' => 1, 'FkNavigationNode' => 2, 'FkUrl' => 3, 'CssClass' => 4, 'ExternalUrl' => 5, 'Link' => 6, 'Title' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ],
        self::TYPE_CAMELNAME     => ['idNavigationNodeLocalizedAttributes' => 0, 'fkLocale' => 1, 'fkNavigationNode' => 2, 'fkUrl' => 3, 'cssClass' => 4, 'externalUrl' => 5, 'link' => 6, 'title' => 7, 'createdAt' => 8, 'updatedAt' => 9, ],
        self::TYPE_COLNAME       => [SpyNavigationNodeLocalizedAttributesTableMap::COL_ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES => 0, SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_LOCALE => 1, SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_NAVIGATION_NODE => 2, SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_URL => 3, SpyNavigationNodeLocalizedAttributesTableMap::COL_CSS_CLASS => 4, SpyNavigationNodeLocalizedAttributesTableMap::COL_EXTERNAL_URL => 5, SpyNavigationNodeLocalizedAttributesTableMap::COL_LINK => 6, SpyNavigationNodeLocalizedAttributesTableMap::COL_TITLE => 7, SpyNavigationNodeLocalizedAttributesTableMap::COL_CREATED_AT => 8, SpyNavigationNodeLocalizedAttributesTableMap::COL_UPDATED_AT => 9, ],
        self::TYPE_FIELDNAME     => ['id_navigation_node_localized_attributes' => 0, 'fk_locale' => 1, 'fk_navigation_node' => 2, 'fk_url' => 3, 'css_class' => 4, 'external_url' => 5, 'link' => 6, 'title' => 7, 'created_at' => 8, 'updated_at' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdNavigationNodeLocalizedAttributes' => 'ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES',
        'SpyNavigationNodeLocalizedAttributes.IdNavigationNodeLocalizedAttributes' => 'ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES',
        'idNavigationNodeLocalizedAttributes' => 'ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES',
        'spyNavigationNodeLocalizedAttributes.idNavigationNodeLocalizedAttributes' => 'ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES',
        'SpyNavigationNodeLocalizedAttributesTableMap::COL_ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES' => 'ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES',
        'COL_ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES' => 'ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES',
        'id_navigation_node_localized_attributes' => 'ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES',
        'spy_navigation_node_localized_attributes.id_navigation_node_localized_attributes' => 'ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES',
        'FkLocale' => 'FK_LOCALE',
        'SpyNavigationNodeLocalizedAttributes.FkLocale' => 'FK_LOCALE',
        'fkLocale' => 'FK_LOCALE',
        'spyNavigationNodeLocalizedAttributes.fkLocale' => 'FK_LOCALE',
        'SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_LOCALE' => 'FK_LOCALE',
        'COL_FK_LOCALE' => 'FK_LOCALE',
        'fk_locale' => 'FK_LOCALE',
        'spy_navigation_node_localized_attributes.fk_locale' => 'FK_LOCALE',
        'FkNavigationNode' => 'FK_NAVIGATION_NODE',
        'SpyNavigationNodeLocalizedAttributes.FkNavigationNode' => 'FK_NAVIGATION_NODE',
        'fkNavigationNode' => 'FK_NAVIGATION_NODE',
        'spyNavigationNodeLocalizedAttributes.fkNavigationNode' => 'FK_NAVIGATION_NODE',
        'SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_NAVIGATION_NODE' => 'FK_NAVIGATION_NODE',
        'COL_FK_NAVIGATION_NODE' => 'FK_NAVIGATION_NODE',
        'fk_navigation_node' => 'FK_NAVIGATION_NODE',
        'spy_navigation_node_localized_attributes.fk_navigation_node' => 'FK_NAVIGATION_NODE',
        'FkUrl' => 'FK_URL',
        'SpyNavigationNodeLocalizedAttributes.FkUrl' => 'FK_URL',
        'fkUrl' => 'FK_URL',
        'spyNavigationNodeLocalizedAttributes.fkUrl' => 'FK_URL',
        'SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_URL' => 'FK_URL',
        'COL_FK_URL' => 'FK_URL',
        'fk_url' => 'FK_URL',
        'spy_navigation_node_localized_attributes.fk_url' => 'FK_URL',
        'CssClass' => 'CSS_CLASS',
        'SpyNavigationNodeLocalizedAttributes.CssClass' => 'CSS_CLASS',
        'cssClass' => 'CSS_CLASS',
        'spyNavigationNodeLocalizedAttributes.cssClass' => 'CSS_CLASS',
        'SpyNavigationNodeLocalizedAttributesTableMap::COL_CSS_CLASS' => 'CSS_CLASS',
        'COL_CSS_CLASS' => 'CSS_CLASS',
        'css_class' => 'CSS_CLASS',
        'spy_navigation_node_localized_attributes.css_class' => 'CSS_CLASS',
        'ExternalUrl' => 'EXTERNAL_URL',
        'SpyNavigationNodeLocalizedAttributes.ExternalUrl' => 'EXTERNAL_URL',
        'externalUrl' => 'EXTERNAL_URL',
        'spyNavigationNodeLocalizedAttributes.externalUrl' => 'EXTERNAL_URL',
        'SpyNavigationNodeLocalizedAttributesTableMap::COL_EXTERNAL_URL' => 'EXTERNAL_URL',
        'COL_EXTERNAL_URL' => 'EXTERNAL_URL',
        'external_url' => 'EXTERNAL_URL',
        'spy_navigation_node_localized_attributes.external_url' => 'EXTERNAL_URL',
        'Link' => 'LINK',
        'SpyNavigationNodeLocalizedAttributes.Link' => 'LINK',
        'link' => 'LINK',
        'spyNavigationNodeLocalizedAttributes.link' => 'LINK',
        'SpyNavigationNodeLocalizedAttributesTableMap::COL_LINK' => 'LINK',
        'COL_LINK' => 'LINK',
        'spy_navigation_node_localized_attributes.link' => 'LINK',
        'Title' => 'TITLE',
        'SpyNavigationNodeLocalizedAttributes.Title' => 'TITLE',
        'title' => 'TITLE',
        'spyNavigationNodeLocalizedAttributes.title' => 'TITLE',
        'SpyNavigationNodeLocalizedAttributesTableMap::COL_TITLE' => 'TITLE',
        'COL_TITLE' => 'TITLE',
        'spy_navigation_node_localized_attributes.title' => 'TITLE',
        'CreatedAt' => 'CREATED_AT',
        'SpyNavigationNodeLocalizedAttributes.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyNavigationNodeLocalizedAttributes.createdAt' => 'CREATED_AT',
        'SpyNavigationNodeLocalizedAttributesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_navigation_node_localized_attributes.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyNavigationNodeLocalizedAttributes.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyNavigationNodeLocalizedAttributes.updatedAt' => 'UPDATED_AT',
        'SpyNavigationNodeLocalizedAttributesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_navigation_node_localized_attributes.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_navigation_node_localized_attributes');
        $this->setPhpName('SpyNavigationNodeLocalizedAttributes');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Navigation\\Persistence\\SpyNavigationNodeLocalizedAttributes');
        $this->setPackage('src.Orm.Zed.Navigation.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_navigation_node_localized_attributes_pk_seq');
        // columns
        $this->addPrimaryKey('id_navigation_node_localized_attributes', 'IdNavigationNodeLocalizedAttributes', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_locale', 'FkLocale', 'INTEGER', 'spy_locale', 'id_locale', true, null, null);
        $this->addForeignKey('fk_navigation_node', 'FkNavigationNode', 'INTEGER', 'spy_navigation_node', 'id_navigation_node', true, null, null);
        $this->addForeignKey('fk_url', 'FkUrl', 'INTEGER', 'spy_url', 'id_url', false, null, null);
        $this->addColumn('css_class', 'CssClass', 'VARCHAR', false, 255, null);
        $this->addColumn('external_url', 'ExternalUrl', 'VARCHAR', false, 255, null);
        $this->addColumn('link', 'Link', 'VARCHAR', false, 255, null);
        $this->addColumn('title', 'Title', 'VARCHAR', true, 255, null);
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
        $this->addRelation('SpyNavigationNode', '\\Orm\\Zed\\Navigation\\Persistence\\SpyNavigationNode', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_navigation_node',
    1 => ':id_navigation_node',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyLocale', '\\Orm\\Zed\\Locale\\Persistence\\SpyLocale', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_locale',
    1 => ':id_locale',
  ),
), null, null, null, false);
        $this->addRelation('SpyUrl', '\\Orm\\Zed\\Url\\Persistence\\SpyUrl', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_url',
    1 => ':id_url',
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
            'event' => ['spy_navigation_node_localized_attributes-all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationNodeLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationNodeLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationNodeLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationNodeLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationNodeLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdNavigationNodeLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdNavigationNodeLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyNavigationNodeLocalizedAttributesTableMap::CLASS_DEFAULT : SpyNavigationNodeLocalizedAttributesTableMap::OM_CLASS;
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
     * @return array (SpyNavigationNodeLocalizedAttributes object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyNavigationNodeLocalizedAttributesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyNavigationNodeLocalizedAttributesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyNavigationNodeLocalizedAttributesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyNavigationNodeLocalizedAttributesTableMap::OM_CLASS;
            /** @var SpyNavigationNodeLocalizedAttributes $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyNavigationNodeLocalizedAttributesTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyNavigationNodeLocalizedAttributesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyNavigationNodeLocalizedAttributesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyNavigationNodeLocalizedAttributes $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyNavigationNodeLocalizedAttributesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES);
            $criteria->addSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_LOCALE);
            $criteria->addSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_NAVIGATION_NODE);
            $criteria->addSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_URL);
            $criteria->addSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_CSS_CLASS);
            $criteria->addSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_EXTERNAL_URL);
            $criteria->addSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_LINK);
            $criteria->addSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_TITLE);
            $criteria->addSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_navigation_node_localized_attributes');
            $criteria->addSelectColumn($alias . '.fk_locale');
            $criteria->addSelectColumn($alias . '.fk_navigation_node');
            $criteria->addSelectColumn($alias . '.fk_url');
            $criteria->addSelectColumn($alias . '.css_class');
            $criteria->addSelectColumn($alias . '.external_url');
            $criteria->addSelectColumn($alias . '.link');
            $criteria->addSelectColumn($alias . '.title');
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
            $criteria->removeSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES);
            $criteria->removeSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_LOCALE);
            $criteria->removeSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_NAVIGATION_NODE);
            $criteria->removeSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_FK_URL);
            $criteria->removeSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_CSS_CLASS);
            $criteria->removeSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_EXTERNAL_URL);
            $criteria->removeSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_LINK);
            $criteria->removeSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_TITLE);
            $criteria->removeSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyNavigationNodeLocalizedAttributesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_navigation_node_localized_attributes');
            $criteria->removeSelectColumn($alias . '.fk_locale');
            $criteria->removeSelectColumn($alias . '.fk_navigation_node');
            $criteria->removeSelectColumn($alias . '.fk_url');
            $criteria->removeSelectColumn($alias . '.css_class');
            $criteria->removeSelectColumn($alias . '.external_url');
            $criteria->removeSelectColumn($alias . '.link');
            $criteria->removeSelectColumn($alias . '.title');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyNavigationNodeLocalizedAttributesTableMap::DATABASE_NAME)->getTable(SpyNavigationNodeLocalizedAttributesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyNavigationNodeLocalizedAttributes or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyNavigationNodeLocalizedAttributes object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyNavigationNodeLocalizedAttributesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Navigation\Persistence\SpyNavigationNodeLocalizedAttributes) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyNavigationNodeLocalizedAttributesTableMap::DATABASE_NAME);
            $criteria->add(SpyNavigationNodeLocalizedAttributesTableMap::COL_ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES, (array) $values, Criteria::IN);
        }

        $query = SpyNavigationNodeLocalizedAttributesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyNavigationNodeLocalizedAttributesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyNavigationNodeLocalizedAttributesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_navigation_node_localized_attributes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyNavigationNodeLocalizedAttributesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyNavigationNodeLocalizedAttributes or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyNavigationNodeLocalizedAttributes object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyNavigationNodeLocalizedAttributesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyNavigationNodeLocalizedAttributes object
        }

        if ($criteria->containsKey(SpyNavigationNodeLocalizedAttributesTableMap::COL_ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES) && $criteria->keyContainsValue(SpyNavigationNodeLocalizedAttributesTableMap::COL_ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyNavigationNodeLocalizedAttributesTableMap::COL_ID_NAVIGATION_NODE_LOCALIZED_ATTRIBUTES.')');
        }


        // Set the correct dbName
        $query = SpyNavigationNodeLocalizedAttributesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
