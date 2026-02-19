<?php

namespace Orm\Zed\Cms\Persistence\Map;

use Orm\Zed\Cms\Persistence\SpyCmsPage;
use Orm\Zed\Cms\Persistence\SpyCmsPageQuery;
use Orm\Zed\Url\Persistence\Map\SpyUrlTableMap;
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
 * This class defines the structure of the 'spy_cms_page' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCmsPageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Cms.Persistence.Map.SpyCmsPageTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_cms_page';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCmsPage';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Cms\\Persistence\\SpyCmsPage';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Cms.Persistence.SpyCmsPage';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id_cms_page field
     */
    public const COL_ID_CMS_PAGE = 'spy_cms_page.id_cms_page';

    /**
     * the column name for the fk_template field
     */
    public const COL_FK_TEMPLATE = 'spy_cms_page.fk_template';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_cms_page.is_active';

    /**
     * the column name for the is_searchable field
     */
    public const COL_IS_SEARCHABLE = 'spy_cms_page.is_searchable';

    /**
     * the column name for the page_key field
     */
    public const COL_PAGE_KEY = 'spy_cms_page.page_key';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_cms_page.uuid';

    /**
     * the column name for the valid_from field
     */
    public const COL_VALID_FROM = 'spy_cms_page.valid_from';

    /**
     * the column name for the valid_to field
     */
    public const COL_VALID_TO = 'spy_cms_page.valid_to';

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
        self::TYPE_PHPNAME       => ['IdCmsPage', 'FkTemplate', 'IsActive', 'IsSearchable', 'PageKey', 'Uuid', 'ValidFrom', 'ValidTo', ],
        self::TYPE_CAMELNAME     => ['idCmsPage', 'fkTemplate', 'isActive', 'isSearchable', 'pageKey', 'uuid', 'validFrom', 'validTo', ],
        self::TYPE_COLNAME       => [SpyCmsPageTableMap::COL_ID_CMS_PAGE, SpyCmsPageTableMap::COL_FK_TEMPLATE, SpyCmsPageTableMap::COL_IS_ACTIVE, SpyCmsPageTableMap::COL_IS_SEARCHABLE, SpyCmsPageTableMap::COL_PAGE_KEY, SpyCmsPageTableMap::COL_UUID, SpyCmsPageTableMap::COL_VALID_FROM, SpyCmsPageTableMap::COL_VALID_TO, ],
        self::TYPE_FIELDNAME     => ['id_cms_page', 'fk_template', 'is_active', 'is_searchable', 'page_key', 'uuid', 'valid_from', 'valid_to', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['IdCmsPage' => 0, 'FkTemplate' => 1, 'IsActive' => 2, 'IsSearchable' => 3, 'PageKey' => 4, 'Uuid' => 5, 'ValidFrom' => 6, 'ValidTo' => 7, ],
        self::TYPE_CAMELNAME     => ['idCmsPage' => 0, 'fkTemplate' => 1, 'isActive' => 2, 'isSearchable' => 3, 'pageKey' => 4, 'uuid' => 5, 'validFrom' => 6, 'validTo' => 7, ],
        self::TYPE_COLNAME       => [SpyCmsPageTableMap::COL_ID_CMS_PAGE => 0, SpyCmsPageTableMap::COL_FK_TEMPLATE => 1, SpyCmsPageTableMap::COL_IS_ACTIVE => 2, SpyCmsPageTableMap::COL_IS_SEARCHABLE => 3, SpyCmsPageTableMap::COL_PAGE_KEY => 4, SpyCmsPageTableMap::COL_UUID => 5, SpyCmsPageTableMap::COL_VALID_FROM => 6, SpyCmsPageTableMap::COL_VALID_TO => 7, ],
        self::TYPE_FIELDNAME     => ['id_cms_page' => 0, 'fk_template' => 1, 'is_active' => 2, 'is_searchable' => 3, 'page_key' => 4, 'uuid' => 5, 'valid_from' => 6, 'valid_to' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCmsPage' => 'ID_CMS_PAGE',
        'SpyCmsPage.IdCmsPage' => 'ID_CMS_PAGE',
        'idCmsPage' => 'ID_CMS_PAGE',
        'spyCmsPage.idCmsPage' => 'ID_CMS_PAGE',
        'SpyCmsPageTableMap::COL_ID_CMS_PAGE' => 'ID_CMS_PAGE',
        'COL_ID_CMS_PAGE' => 'ID_CMS_PAGE',
        'id_cms_page' => 'ID_CMS_PAGE',
        'spy_cms_page.id_cms_page' => 'ID_CMS_PAGE',
        'FkTemplate' => 'FK_TEMPLATE',
        'SpyCmsPage.FkTemplate' => 'FK_TEMPLATE',
        'fkTemplate' => 'FK_TEMPLATE',
        'spyCmsPage.fkTemplate' => 'FK_TEMPLATE',
        'SpyCmsPageTableMap::COL_FK_TEMPLATE' => 'FK_TEMPLATE',
        'COL_FK_TEMPLATE' => 'FK_TEMPLATE',
        'fk_template' => 'FK_TEMPLATE',
        'spy_cms_page.fk_template' => 'FK_TEMPLATE',
        'IsActive' => 'IS_ACTIVE',
        'SpyCmsPage.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyCmsPage.isActive' => 'IS_ACTIVE',
        'SpyCmsPageTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_cms_page.is_active' => 'IS_ACTIVE',
        'IsSearchable' => 'IS_SEARCHABLE',
        'SpyCmsPage.IsSearchable' => 'IS_SEARCHABLE',
        'isSearchable' => 'IS_SEARCHABLE',
        'spyCmsPage.isSearchable' => 'IS_SEARCHABLE',
        'SpyCmsPageTableMap::COL_IS_SEARCHABLE' => 'IS_SEARCHABLE',
        'COL_IS_SEARCHABLE' => 'IS_SEARCHABLE',
        'is_searchable' => 'IS_SEARCHABLE',
        'spy_cms_page.is_searchable' => 'IS_SEARCHABLE',
        'PageKey' => 'PAGE_KEY',
        'SpyCmsPage.PageKey' => 'PAGE_KEY',
        'pageKey' => 'PAGE_KEY',
        'spyCmsPage.pageKey' => 'PAGE_KEY',
        'SpyCmsPageTableMap::COL_PAGE_KEY' => 'PAGE_KEY',
        'COL_PAGE_KEY' => 'PAGE_KEY',
        'page_key' => 'PAGE_KEY',
        'spy_cms_page.page_key' => 'PAGE_KEY',
        'Uuid' => 'UUID',
        'SpyCmsPage.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyCmsPage.uuid' => 'UUID',
        'SpyCmsPageTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_cms_page.uuid' => 'UUID',
        'ValidFrom' => 'VALID_FROM',
        'SpyCmsPage.ValidFrom' => 'VALID_FROM',
        'validFrom' => 'VALID_FROM',
        'spyCmsPage.validFrom' => 'VALID_FROM',
        'SpyCmsPageTableMap::COL_VALID_FROM' => 'VALID_FROM',
        'COL_VALID_FROM' => 'VALID_FROM',
        'valid_from' => 'VALID_FROM',
        'spy_cms_page.valid_from' => 'VALID_FROM',
        'ValidTo' => 'VALID_TO',
        'SpyCmsPage.ValidTo' => 'VALID_TO',
        'validTo' => 'VALID_TO',
        'spyCmsPage.validTo' => 'VALID_TO',
        'SpyCmsPageTableMap::COL_VALID_TO' => 'VALID_TO',
        'COL_VALID_TO' => 'VALID_TO',
        'valid_to' => 'VALID_TO',
        'spy_cms_page.valid_to' => 'VALID_TO',
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
        $this->setName('spy_cms_page');
        $this->setPhpName('SpyCmsPage');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Cms\\Persistence\\SpyCmsPage');
        $this->setPackage('src.Orm.Zed.Cms.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_cms_page_pk_seq');
        // columns
        $this->addPrimaryKey('id_cms_page', 'IdCmsPage', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_template', 'FkTemplate', 'INTEGER', 'spy_cms_template', 'id_cms_template', true, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', true, 1, false);
        $this->addColumn('is_searchable', 'IsSearchable', 'BOOLEAN', true, 1, false);
        $this->addColumn('page_key', 'PageKey', 'VARCHAR', false, 32, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 36, null);
        $this->addColumn('valid_from', 'ValidFrom', 'TIMESTAMP', false, null, null);
        $this->addColumn('valid_to', 'ValidTo', 'TIMESTAMP', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('CmsTemplate', '\\Orm\\Zed\\Cms\\Persistence\\SpyCmsTemplate', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_template',
    1 => ':id_cms_template',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyCmsVersion', '\\Orm\\Zed\\Cms\\Persistence\\SpyCmsVersion', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_cms_page',
    1 => ':id_cms_page',
  ),
), 'CASCADE', null, 'SpyCmsVersions', false);
        $this->addRelation('SpyCmsPageLocalizedAttributes', '\\Orm\\Zed\\Cms\\Persistence\\SpyCmsPageLocalizedAttributes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_cms_page',
    1 => ':id_cms_page',
  ),
), 'CASCADE', 'CASCADE', 'SpyCmsPageLocalizedAttributess', false);
        $this->addRelation('SpyCmsGlossaryKeyMapping', '\\Orm\\Zed\\Cms\\Persistence\\SpyCmsGlossaryKeyMapping', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_page',
    1 => ':id_cms_page',
  ),
), 'CASCADE', null, 'SpyCmsGlossaryKeyMappings', false);
        $this->addRelation('SpyCmsPageStore', '\\Orm\\Zed\\Cms\\Persistence\\SpyCmsPageStore', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_cms_page',
    1 => ':id_cms_page',
  ),
), null, null, 'SpyCmsPageStores', false);
        $this->addRelation('SpyUrl', '\\Orm\\Zed\\Url\\Persistence\\SpyUrl', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_resource_page',
    1 => ':id_cms_page',
  ),
), 'CASCADE', null, 'SpyUrls', false);
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_cms_page'],
            'event' => ['spy_cms_page_all' => ['column' => '*']],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_cms_page     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyCmsVersionTableMap::clearInstancePool();
        SpyCmsPageLocalizedAttributesTableMap::clearInstancePool();
        SpyCmsGlossaryKeyMappingTableMap::clearInstancePool();
        SpyUrlTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPage', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPage', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPage', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPage', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPage', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsPage', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCmsPage', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCmsPageTableMap::CLASS_DEFAULT : SpyCmsPageTableMap::OM_CLASS;
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
     * @return array (SpyCmsPage object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCmsPageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCmsPageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCmsPageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCmsPageTableMap::OM_CLASS;
            /** @var SpyCmsPage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCmsPageTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCmsPageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCmsPageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCmsPage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCmsPageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCmsPageTableMap::COL_ID_CMS_PAGE);
            $criteria->addSelectColumn(SpyCmsPageTableMap::COL_FK_TEMPLATE);
            $criteria->addSelectColumn(SpyCmsPageTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyCmsPageTableMap::COL_IS_SEARCHABLE);
            $criteria->addSelectColumn(SpyCmsPageTableMap::COL_PAGE_KEY);
            $criteria->addSelectColumn(SpyCmsPageTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyCmsPageTableMap::COL_VALID_FROM);
            $criteria->addSelectColumn(SpyCmsPageTableMap::COL_VALID_TO);
        } else {
            $criteria->addSelectColumn($alias . '.id_cms_page');
            $criteria->addSelectColumn($alias . '.fk_template');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.is_searchable');
            $criteria->addSelectColumn($alias . '.page_key');
            $criteria->addSelectColumn($alias . '.uuid');
            $criteria->addSelectColumn($alias . '.valid_from');
            $criteria->addSelectColumn($alias . '.valid_to');
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
            $criteria->removeSelectColumn(SpyCmsPageTableMap::COL_ID_CMS_PAGE);
            $criteria->removeSelectColumn(SpyCmsPageTableMap::COL_FK_TEMPLATE);
            $criteria->removeSelectColumn(SpyCmsPageTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyCmsPageTableMap::COL_IS_SEARCHABLE);
            $criteria->removeSelectColumn(SpyCmsPageTableMap::COL_PAGE_KEY);
            $criteria->removeSelectColumn(SpyCmsPageTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyCmsPageTableMap::COL_VALID_FROM);
            $criteria->removeSelectColumn(SpyCmsPageTableMap::COL_VALID_TO);
        } else {
            $criteria->removeSelectColumn($alias . '.id_cms_page');
            $criteria->removeSelectColumn($alias . '.fk_template');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.is_searchable');
            $criteria->removeSelectColumn($alias . '.page_key');
            $criteria->removeSelectColumn($alias . '.uuid');
            $criteria->removeSelectColumn($alias . '.valid_from');
            $criteria->removeSelectColumn($alias . '.valid_to');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCmsPageTableMap::DATABASE_NAME)->getTable(SpyCmsPageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCmsPage or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCmsPage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsPageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Cms\Persistence\SpyCmsPage) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCmsPageTableMap::DATABASE_NAME);
            $criteria->add(SpyCmsPageTableMap::COL_ID_CMS_PAGE, (array) $values, Criteria::IN);
        }

        $query = SpyCmsPageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCmsPageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCmsPageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_cms_page table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCmsPageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCmsPage or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCmsPage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsPageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCmsPage object
        }


        // Set the correct dbName
        $query = SpyCmsPageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
