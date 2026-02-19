<?php

namespace Orm\Zed\Url\Persistence\Map;

use Orm\Zed\Url\Persistence\SpyUrl;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
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
 * This class defines the structure of the 'spy_url' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyUrlTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Url.Persistence.Map.SpyUrlTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_url';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyUrl';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Url\\Persistence\\SpyUrl';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Url.Persistence.SpyUrl';

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
     * the column name for the id_url field
     */
    public const COL_ID_URL = 'spy_url.id_url';

    /**
     * the column name for the fk_locale field
     */
    public const COL_FK_LOCALE = 'spy_url.fk_locale';

    /**
     * the column name for the fk_resource_categorynode field
     */
    public const COL_FK_RESOURCE_CATEGORYNODE = 'spy_url.fk_resource_categorynode';

    /**
     * the column name for the fk_resource_merchant field
     */
    public const COL_FK_RESOURCE_MERCHANT = 'spy_url.fk_resource_merchant';

    /**
     * the column name for the fk_resource_page field
     */
    public const COL_FK_RESOURCE_PAGE = 'spy_url.fk_resource_page';

    /**
     * the column name for the fk_resource_product_abstract field
     */
    public const COL_FK_RESOURCE_PRODUCT_ABSTRACT = 'spy_url.fk_resource_product_abstract';

    /**
     * the column name for the fk_resource_product_set field
     */
    public const COL_FK_RESOURCE_PRODUCT_SET = 'spy_url.fk_resource_product_set';

    /**
     * the column name for the fk_resource_redirect field
     */
    public const COL_FK_RESOURCE_REDIRECT = 'spy_url.fk_resource_redirect';

    /**
     * the column name for the url field
     */
    public const COL_URL = 'spy_url.url';

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
        self::TYPE_PHPNAME       => ['IdUrl', 'FkLocale', 'FkResourceCategorynode', 'FkResourceMerchant', 'FkResourcePage', 'FkResourceProductAbstract', 'FkResourceProductSet', 'FkResourceRedirect', 'Url', ],
        self::TYPE_CAMELNAME     => ['idUrl', 'fkLocale', 'fkResourceCategorynode', 'fkResourceMerchant', 'fkResourcePage', 'fkResourceProductAbstract', 'fkResourceProductSet', 'fkResourceRedirect', 'url', ],
        self::TYPE_COLNAME       => [SpyUrlTableMap::COL_ID_URL, SpyUrlTableMap::COL_FK_LOCALE, SpyUrlTableMap::COL_FK_RESOURCE_CATEGORYNODE, SpyUrlTableMap::COL_FK_RESOURCE_MERCHANT, SpyUrlTableMap::COL_FK_RESOURCE_PAGE, SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_ABSTRACT, SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_SET, SpyUrlTableMap::COL_FK_RESOURCE_REDIRECT, SpyUrlTableMap::COL_URL, ],
        self::TYPE_FIELDNAME     => ['id_url', 'fk_locale', 'fk_resource_categorynode', 'fk_resource_merchant', 'fk_resource_page', 'fk_resource_product_abstract', 'fk_resource_product_set', 'fk_resource_redirect', 'url', ],
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
        self::TYPE_PHPNAME       => ['IdUrl' => 0, 'FkLocale' => 1, 'FkResourceCategorynode' => 2, 'FkResourceMerchant' => 3, 'FkResourcePage' => 4, 'FkResourceProductAbstract' => 5, 'FkResourceProductSet' => 6, 'FkResourceRedirect' => 7, 'Url' => 8, ],
        self::TYPE_CAMELNAME     => ['idUrl' => 0, 'fkLocale' => 1, 'fkResourceCategorynode' => 2, 'fkResourceMerchant' => 3, 'fkResourcePage' => 4, 'fkResourceProductAbstract' => 5, 'fkResourceProductSet' => 6, 'fkResourceRedirect' => 7, 'url' => 8, ],
        self::TYPE_COLNAME       => [SpyUrlTableMap::COL_ID_URL => 0, SpyUrlTableMap::COL_FK_LOCALE => 1, SpyUrlTableMap::COL_FK_RESOURCE_CATEGORYNODE => 2, SpyUrlTableMap::COL_FK_RESOURCE_MERCHANT => 3, SpyUrlTableMap::COL_FK_RESOURCE_PAGE => 4, SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_ABSTRACT => 5, SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_SET => 6, SpyUrlTableMap::COL_FK_RESOURCE_REDIRECT => 7, SpyUrlTableMap::COL_URL => 8, ],
        self::TYPE_FIELDNAME     => ['id_url' => 0, 'fk_locale' => 1, 'fk_resource_categorynode' => 2, 'fk_resource_merchant' => 3, 'fk_resource_page' => 4, 'fk_resource_product_abstract' => 5, 'fk_resource_product_set' => 6, 'fk_resource_redirect' => 7, 'url' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdUrl' => 'ID_URL',
        'SpyUrl.IdUrl' => 'ID_URL',
        'idUrl' => 'ID_URL',
        'spyUrl.idUrl' => 'ID_URL',
        'SpyUrlTableMap::COL_ID_URL' => 'ID_URL',
        'COL_ID_URL' => 'ID_URL',
        'id_url' => 'ID_URL',
        'spy_url.id_url' => 'ID_URL',
        'FkLocale' => 'FK_LOCALE',
        'SpyUrl.FkLocale' => 'FK_LOCALE',
        'fkLocale' => 'FK_LOCALE',
        'spyUrl.fkLocale' => 'FK_LOCALE',
        'SpyUrlTableMap::COL_FK_LOCALE' => 'FK_LOCALE',
        'COL_FK_LOCALE' => 'FK_LOCALE',
        'fk_locale' => 'FK_LOCALE',
        'spy_url.fk_locale' => 'FK_LOCALE',
        'FkResourceCategorynode' => 'FK_RESOURCE_CATEGORYNODE',
        'SpyUrl.FkResourceCategorynode' => 'FK_RESOURCE_CATEGORYNODE',
        'fkResourceCategorynode' => 'FK_RESOURCE_CATEGORYNODE',
        'spyUrl.fkResourceCategorynode' => 'FK_RESOURCE_CATEGORYNODE',
        'SpyUrlTableMap::COL_FK_RESOURCE_CATEGORYNODE' => 'FK_RESOURCE_CATEGORYNODE',
        'COL_FK_RESOURCE_CATEGORYNODE' => 'FK_RESOURCE_CATEGORYNODE',
        'fk_resource_categorynode' => 'FK_RESOURCE_CATEGORYNODE',
        'spy_url.fk_resource_categorynode' => 'FK_RESOURCE_CATEGORYNODE',
        'FkResourceMerchant' => 'FK_RESOURCE_MERCHANT',
        'SpyUrl.FkResourceMerchant' => 'FK_RESOURCE_MERCHANT',
        'fkResourceMerchant' => 'FK_RESOURCE_MERCHANT',
        'spyUrl.fkResourceMerchant' => 'FK_RESOURCE_MERCHANT',
        'SpyUrlTableMap::COL_FK_RESOURCE_MERCHANT' => 'FK_RESOURCE_MERCHANT',
        'COL_FK_RESOURCE_MERCHANT' => 'FK_RESOURCE_MERCHANT',
        'fk_resource_merchant' => 'FK_RESOURCE_MERCHANT',
        'spy_url.fk_resource_merchant' => 'FK_RESOURCE_MERCHANT',
        'FkResourcePage' => 'FK_RESOURCE_PAGE',
        'SpyUrl.FkResourcePage' => 'FK_RESOURCE_PAGE',
        'fkResourcePage' => 'FK_RESOURCE_PAGE',
        'spyUrl.fkResourcePage' => 'FK_RESOURCE_PAGE',
        'SpyUrlTableMap::COL_FK_RESOURCE_PAGE' => 'FK_RESOURCE_PAGE',
        'COL_FK_RESOURCE_PAGE' => 'FK_RESOURCE_PAGE',
        'fk_resource_page' => 'FK_RESOURCE_PAGE',
        'spy_url.fk_resource_page' => 'FK_RESOURCE_PAGE',
        'FkResourceProductAbstract' => 'FK_RESOURCE_PRODUCT_ABSTRACT',
        'SpyUrl.FkResourceProductAbstract' => 'FK_RESOURCE_PRODUCT_ABSTRACT',
        'fkResourceProductAbstract' => 'FK_RESOURCE_PRODUCT_ABSTRACT',
        'spyUrl.fkResourceProductAbstract' => 'FK_RESOURCE_PRODUCT_ABSTRACT',
        'SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_ABSTRACT' => 'FK_RESOURCE_PRODUCT_ABSTRACT',
        'COL_FK_RESOURCE_PRODUCT_ABSTRACT' => 'FK_RESOURCE_PRODUCT_ABSTRACT',
        'fk_resource_product_abstract' => 'FK_RESOURCE_PRODUCT_ABSTRACT',
        'spy_url.fk_resource_product_abstract' => 'FK_RESOURCE_PRODUCT_ABSTRACT',
        'FkResourceProductSet' => 'FK_RESOURCE_PRODUCT_SET',
        'SpyUrl.FkResourceProductSet' => 'FK_RESOURCE_PRODUCT_SET',
        'fkResourceProductSet' => 'FK_RESOURCE_PRODUCT_SET',
        'spyUrl.fkResourceProductSet' => 'FK_RESOURCE_PRODUCT_SET',
        'SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_SET' => 'FK_RESOURCE_PRODUCT_SET',
        'COL_FK_RESOURCE_PRODUCT_SET' => 'FK_RESOURCE_PRODUCT_SET',
        'fk_resource_product_set' => 'FK_RESOURCE_PRODUCT_SET',
        'spy_url.fk_resource_product_set' => 'FK_RESOURCE_PRODUCT_SET',
        'FkResourceRedirect' => 'FK_RESOURCE_REDIRECT',
        'SpyUrl.FkResourceRedirect' => 'FK_RESOURCE_REDIRECT',
        'fkResourceRedirect' => 'FK_RESOURCE_REDIRECT',
        'spyUrl.fkResourceRedirect' => 'FK_RESOURCE_REDIRECT',
        'SpyUrlTableMap::COL_FK_RESOURCE_REDIRECT' => 'FK_RESOURCE_REDIRECT',
        'COL_FK_RESOURCE_REDIRECT' => 'FK_RESOURCE_REDIRECT',
        'fk_resource_redirect' => 'FK_RESOURCE_REDIRECT',
        'spy_url.fk_resource_redirect' => 'FK_RESOURCE_REDIRECT',
        'Url' => 'URL',
        'SpyUrl.Url' => 'URL',
        'url' => 'URL',
        'spyUrl.url' => 'URL',
        'SpyUrlTableMap::COL_URL' => 'URL',
        'COL_URL' => 'URL',
        'spy_url.url' => 'URL',
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
        $this->setName('spy_url');
        $this->setPhpName('SpyUrl');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Url\\Persistence\\SpyUrl');
        $this->setPackage('src.Orm.Zed.Url.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_url_pk_seq');
        // columns
        $this->addPrimaryKey('id_url', 'IdUrl', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_locale', 'FkLocale', 'INTEGER', 'spy_locale', 'id_locale', true, null, null);
        $this->addForeignKey('fk_resource_categorynode', 'FkResourceCategorynode', 'INTEGER', 'spy_category_node', 'id_category_node', false, null, null);
        $this->addForeignKey('fk_resource_merchant', 'FkResourceMerchant', 'INTEGER', 'spy_merchant', 'id_merchant', false, null, null);
        $this->addForeignKey('fk_resource_page', 'FkResourcePage', 'INTEGER', 'spy_cms_page', 'id_cms_page', false, null, null);
        $this->addForeignKey('fk_resource_product_abstract', 'FkResourceProductAbstract', 'INTEGER', 'spy_product_abstract', 'id_product_abstract', false, null, null);
        $this->addForeignKey('fk_resource_product_set', 'FkResourceProductSet', 'INTEGER', 'spy_product_set', 'id_product_set', false, null, null);
        $this->addForeignKey('fk_resource_redirect', 'FkResourceRedirect', 'INTEGER', 'spy_url_redirect', 'id_url_redirect', false, null, null);
        $this->addColumn('url', 'Url', 'VARCHAR', true, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyCategoryNode', '\\Orm\\Zed\\Category\\Persistence\\SpyCategoryNode', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_resource_categorynode',
    1 => ':id_category_node',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('CmsPage', '\\Orm\\Zed\\Cms\\Persistence\\SpyCmsPage', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_resource_page',
    1 => ':id_cms_page',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyMerchant', '\\Orm\\Zed\\Merchant\\Persistence\\SpyMerchant', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_resource_merchant',
    1 => ':id_merchant',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyProductSet', '\\Orm\\Zed\\ProductSet\\Persistence\\SpyProductSet', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_resource_product_set',
    1 => ':id_product_set',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyProduct', '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstract', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_resource_product_abstract',
    1 => ':id_product_abstract',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyLocale', '\\Orm\\Zed\\Locale\\Persistence\\SpyLocale', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_locale',
    1 => ':id_locale',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyUrlRedirect', '\\Orm\\Zed\\Url\\Persistence\\SpyUrlRedirect', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_resource_redirect',
    1 => ':id_url_redirect',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyNavigationNodeLocalizedAttributes', '\\Orm\\Zed\\Navigation\\Persistence\\SpyNavigationNodeLocalizedAttributes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_url',
    1 => ':id_url',
  ),
), null, null, 'SpyNavigationNodeLocalizedAttributess', false);
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
            'event' => ['spy_url_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUrl', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUrl', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUrl', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUrl', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUrl', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdUrl', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdUrl', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyUrlTableMap::CLASS_DEFAULT : SpyUrlTableMap::OM_CLASS;
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
     * @return array (SpyUrl object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyUrlTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyUrlTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyUrlTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyUrlTableMap::OM_CLASS;
            /** @var SpyUrl $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyUrlTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyUrlTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyUrlTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyUrl $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyUrlTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyUrlTableMap::COL_ID_URL);
            $criteria->addSelectColumn(SpyUrlTableMap::COL_FK_LOCALE);
            $criteria->addSelectColumn(SpyUrlTableMap::COL_FK_RESOURCE_CATEGORYNODE);
            $criteria->addSelectColumn(SpyUrlTableMap::COL_FK_RESOURCE_MERCHANT);
            $criteria->addSelectColumn(SpyUrlTableMap::COL_FK_RESOURCE_PAGE);
            $criteria->addSelectColumn(SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_ABSTRACT);
            $criteria->addSelectColumn(SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_SET);
            $criteria->addSelectColumn(SpyUrlTableMap::COL_FK_RESOURCE_REDIRECT);
            $criteria->addSelectColumn(SpyUrlTableMap::COL_URL);
        } else {
            $criteria->addSelectColumn($alias . '.id_url');
            $criteria->addSelectColumn($alias . '.fk_locale');
            $criteria->addSelectColumn($alias . '.fk_resource_categorynode');
            $criteria->addSelectColumn($alias . '.fk_resource_merchant');
            $criteria->addSelectColumn($alias . '.fk_resource_page');
            $criteria->addSelectColumn($alias . '.fk_resource_product_abstract');
            $criteria->addSelectColumn($alias . '.fk_resource_product_set');
            $criteria->addSelectColumn($alias . '.fk_resource_redirect');
            $criteria->addSelectColumn($alias . '.url');
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
            $criteria->removeSelectColumn(SpyUrlTableMap::COL_ID_URL);
            $criteria->removeSelectColumn(SpyUrlTableMap::COL_FK_LOCALE);
            $criteria->removeSelectColumn(SpyUrlTableMap::COL_FK_RESOURCE_CATEGORYNODE);
            $criteria->removeSelectColumn(SpyUrlTableMap::COL_FK_RESOURCE_MERCHANT);
            $criteria->removeSelectColumn(SpyUrlTableMap::COL_FK_RESOURCE_PAGE);
            $criteria->removeSelectColumn(SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_ABSTRACT);
            $criteria->removeSelectColumn(SpyUrlTableMap::COL_FK_RESOURCE_PRODUCT_SET);
            $criteria->removeSelectColumn(SpyUrlTableMap::COL_FK_RESOURCE_REDIRECT);
            $criteria->removeSelectColumn(SpyUrlTableMap::COL_URL);
        } else {
            $criteria->removeSelectColumn($alias . '.id_url');
            $criteria->removeSelectColumn($alias . '.fk_locale');
            $criteria->removeSelectColumn($alias . '.fk_resource_categorynode');
            $criteria->removeSelectColumn($alias . '.fk_resource_merchant');
            $criteria->removeSelectColumn($alias . '.fk_resource_page');
            $criteria->removeSelectColumn($alias . '.fk_resource_product_abstract');
            $criteria->removeSelectColumn($alias . '.fk_resource_product_set');
            $criteria->removeSelectColumn($alias . '.fk_resource_redirect');
            $criteria->removeSelectColumn($alias . '.url');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyUrlTableMap::DATABASE_NAME)->getTable(SpyUrlTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyUrl or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyUrl object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyUrlTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Url\Persistence\SpyUrl) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyUrlTableMap::DATABASE_NAME);
            $criteria->add(SpyUrlTableMap::COL_ID_URL, (array) $values, Criteria::IN);
        }

        $query = SpyUrlQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyUrlTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyUrlTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_url table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyUrlQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyUrl or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyUrl object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyUrlTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyUrl object
        }

        if ($criteria->containsKey(SpyUrlTableMap::COL_ID_URL) && $criteria->keyContainsValue(SpyUrlTableMap::COL_ID_URL) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyUrlTableMap::COL_ID_URL.')');
        }


        // Set the correct dbName
        $query = SpyUrlQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
