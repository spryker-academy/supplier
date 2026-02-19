<?php

namespace Orm\Zed\CmsBlockCategoryConnector\Persistence\Map;

use Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector;
use Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnectorQuery;
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
 * This class defines the structure of the 'spy_cms_block_category_connector' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCmsBlockCategoryConnectorTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CmsBlockCategoryConnector.Persistence.Map.SpyCmsBlockCategoryConnectorTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_cms_block_category_connector';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCmsBlockCategoryConnector';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CmsBlockCategoryConnector\\Persistence\\SpyCmsBlockCategoryConnector';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CmsBlockCategoryConnector.Persistence.SpyCmsBlockCategoryConnector';

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
     * the column name for the id_cms_block_category_connector field
     */
    public const COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR = 'spy_cms_block_category_connector.id_cms_block_category_connector';

    /**
     * the column name for the fk_category field
     */
    public const COL_FK_CATEGORY = 'spy_cms_block_category_connector.fk_category';

    /**
     * the column name for the fk_category_template field
     */
    public const COL_FK_CATEGORY_TEMPLATE = 'spy_cms_block_category_connector.fk_category_template';

    /**
     * the column name for the fk_cms_block field
     */
    public const COL_FK_CMS_BLOCK = 'spy_cms_block_category_connector.fk_cms_block';

    /**
     * the column name for the fk_cms_block_category_position field
     */
    public const COL_FK_CMS_BLOCK_CATEGORY_POSITION = 'spy_cms_block_category_connector.fk_cms_block_category_position';

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
        self::TYPE_PHPNAME       => ['IdCmsBlockCategoryConnector', 'FkCategory', 'FkCategoryTemplate', 'FkCmsBlock', 'FkCmsBlockCategoryPosition', ],
        self::TYPE_CAMELNAME     => ['idCmsBlockCategoryConnector', 'fkCategory', 'fkCategoryTemplate', 'fkCmsBlock', 'fkCmsBlockCategoryPosition', ],
        self::TYPE_COLNAME       => [SpyCmsBlockCategoryConnectorTableMap::COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR, SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY, SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY_TEMPLATE, SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK, SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK_CATEGORY_POSITION, ],
        self::TYPE_FIELDNAME     => ['id_cms_block_category_connector', 'fk_category', 'fk_category_template', 'fk_cms_block', 'fk_cms_block_category_position', ],
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
        self::TYPE_PHPNAME       => ['IdCmsBlockCategoryConnector' => 0, 'FkCategory' => 1, 'FkCategoryTemplate' => 2, 'FkCmsBlock' => 3, 'FkCmsBlockCategoryPosition' => 4, ],
        self::TYPE_CAMELNAME     => ['idCmsBlockCategoryConnector' => 0, 'fkCategory' => 1, 'fkCategoryTemplate' => 2, 'fkCmsBlock' => 3, 'fkCmsBlockCategoryPosition' => 4, ],
        self::TYPE_COLNAME       => [SpyCmsBlockCategoryConnectorTableMap::COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR => 0, SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY => 1, SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY_TEMPLATE => 2, SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK => 3, SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK_CATEGORY_POSITION => 4, ],
        self::TYPE_FIELDNAME     => ['id_cms_block_category_connector' => 0, 'fk_category' => 1, 'fk_category_template' => 2, 'fk_cms_block' => 3, 'fk_cms_block_category_position' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCmsBlockCategoryConnector' => 'ID_CMS_BLOCK_CATEGORY_CONNECTOR',
        'SpyCmsBlockCategoryConnector.IdCmsBlockCategoryConnector' => 'ID_CMS_BLOCK_CATEGORY_CONNECTOR',
        'idCmsBlockCategoryConnector' => 'ID_CMS_BLOCK_CATEGORY_CONNECTOR',
        'spyCmsBlockCategoryConnector.idCmsBlockCategoryConnector' => 'ID_CMS_BLOCK_CATEGORY_CONNECTOR',
        'SpyCmsBlockCategoryConnectorTableMap::COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR' => 'ID_CMS_BLOCK_CATEGORY_CONNECTOR',
        'COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR' => 'ID_CMS_BLOCK_CATEGORY_CONNECTOR',
        'id_cms_block_category_connector' => 'ID_CMS_BLOCK_CATEGORY_CONNECTOR',
        'spy_cms_block_category_connector.id_cms_block_category_connector' => 'ID_CMS_BLOCK_CATEGORY_CONNECTOR',
        'FkCategory' => 'FK_CATEGORY',
        'SpyCmsBlockCategoryConnector.FkCategory' => 'FK_CATEGORY',
        'fkCategory' => 'FK_CATEGORY',
        'spyCmsBlockCategoryConnector.fkCategory' => 'FK_CATEGORY',
        'SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY' => 'FK_CATEGORY',
        'COL_FK_CATEGORY' => 'FK_CATEGORY',
        'fk_category' => 'FK_CATEGORY',
        'spy_cms_block_category_connector.fk_category' => 'FK_CATEGORY',
        'FkCategoryTemplate' => 'FK_CATEGORY_TEMPLATE',
        'SpyCmsBlockCategoryConnector.FkCategoryTemplate' => 'FK_CATEGORY_TEMPLATE',
        'fkCategoryTemplate' => 'FK_CATEGORY_TEMPLATE',
        'spyCmsBlockCategoryConnector.fkCategoryTemplate' => 'FK_CATEGORY_TEMPLATE',
        'SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY_TEMPLATE' => 'FK_CATEGORY_TEMPLATE',
        'COL_FK_CATEGORY_TEMPLATE' => 'FK_CATEGORY_TEMPLATE',
        'fk_category_template' => 'FK_CATEGORY_TEMPLATE',
        'spy_cms_block_category_connector.fk_category_template' => 'FK_CATEGORY_TEMPLATE',
        'FkCmsBlock' => 'FK_CMS_BLOCK',
        'SpyCmsBlockCategoryConnector.FkCmsBlock' => 'FK_CMS_BLOCK',
        'fkCmsBlock' => 'FK_CMS_BLOCK',
        'spyCmsBlockCategoryConnector.fkCmsBlock' => 'FK_CMS_BLOCK',
        'SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK' => 'FK_CMS_BLOCK',
        'COL_FK_CMS_BLOCK' => 'FK_CMS_BLOCK',
        'fk_cms_block' => 'FK_CMS_BLOCK',
        'spy_cms_block_category_connector.fk_cms_block' => 'FK_CMS_BLOCK',
        'FkCmsBlockCategoryPosition' => 'FK_CMS_BLOCK_CATEGORY_POSITION',
        'SpyCmsBlockCategoryConnector.FkCmsBlockCategoryPosition' => 'FK_CMS_BLOCK_CATEGORY_POSITION',
        'fkCmsBlockCategoryPosition' => 'FK_CMS_BLOCK_CATEGORY_POSITION',
        'spyCmsBlockCategoryConnector.fkCmsBlockCategoryPosition' => 'FK_CMS_BLOCK_CATEGORY_POSITION',
        'SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK_CATEGORY_POSITION' => 'FK_CMS_BLOCK_CATEGORY_POSITION',
        'COL_FK_CMS_BLOCK_CATEGORY_POSITION' => 'FK_CMS_BLOCK_CATEGORY_POSITION',
        'fk_cms_block_category_position' => 'FK_CMS_BLOCK_CATEGORY_POSITION',
        'spy_cms_block_category_connector.fk_cms_block_category_position' => 'FK_CMS_BLOCK_CATEGORY_POSITION',
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
        $this->setName('spy_cms_block_category_connector');
        $this->setPhpName('SpyCmsBlockCategoryConnector');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\CmsBlockCategoryConnector\\Persistence\\SpyCmsBlockCategoryConnector');
        $this->setPackage('src.Orm.Zed.CmsBlockCategoryConnector.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_cms_block_category_connector_pk_seq');
        // columns
        $this->addPrimaryKey('id_cms_block_category_connector', 'IdCmsBlockCategoryConnector', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_category', 'FkCategory', 'INTEGER', 'spy_category', 'id_category', true, null, null);
        $this->addForeignKey('fk_category_template', 'FkCategoryTemplate', 'INTEGER', 'spy_category_template', 'id_category_template', true, null, null);
        $this->addForeignKey('fk_cms_block', 'FkCmsBlock', 'INTEGER', 'spy_cms_block', 'id_cms_block', true, null, null);
        $this->addForeignKey('fk_cms_block_category_position', 'FkCmsBlockCategoryPosition', 'INTEGER', 'spy_cms_block_category_position', 'id_cms_block_category_position', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('CmsBlock', '\\Orm\\Zed\\CmsBlock\\Persistence\\SpyCmsBlock', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_cms_block',
    1 => ':id_cms_block',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Category', '\\Orm\\Zed\\Category\\Persistence\\SpyCategory', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_category',
    1 => ':id_category',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('CategoryTemplate', '\\Orm\\Zed\\Category\\Persistence\\SpyCategoryTemplate', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_category_template',
    1 => ':id_category_template',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('CmsBlockCategoryPosition', '\\Orm\\Zed\\CmsBlockCategoryConnector\\Persistence\\SpyCmsBlockCategoryPosition', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_cms_block_category_position',
    1 => ':id_cms_block_category_position',
  ),
), 'CASCADE', null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockCategoryConnector', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockCategoryConnector', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockCategoryConnector', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockCategoryConnector', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockCategoryConnector', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockCategoryConnector', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCmsBlockCategoryConnector', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCmsBlockCategoryConnectorTableMap::CLASS_DEFAULT : SpyCmsBlockCategoryConnectorTableMap::OM_CLASS;
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
     * @return array (SpyCmsBlockCategoryConnector object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCmsBlockCategoryConnectorTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCmsBlockCategoryConnectorTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCmsBlockCategoryConnectorTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCmsBlockCategoryConnectorTableMap::OM_CLASS;
            /** @var SpyCmsBlockCategoryConnector $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCmsBlockCategoryConnectorTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCmsBlockCategoryConnectorTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCmsBlockCategoryConnectorTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCmsBlockCategoryConnector $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCmsBlockCategoryConnectorTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCmsBlockCategoryConnectorTableMap::COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR);
            $criteria->addSelectColumn(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY);
            $criteria->addSelectColumn(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY_TEMPLATE);
            $criteria->addSelectColumn(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK);
            $criteria->addSelectColumn(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK_CATEGORY_POSITION);
        } else {
            $criteria->addSelectColumn($alias . '.id_cms_block_category_connector');
            $criteria->addSelectColumn($alias . '.fk_category');
            $criteria->addSelectColumn($alias . '.fk_category_template');
            $criteria->addSelectColumn($alias . '.fk_cms_block');
            $criteria->addSelectColumn($alias . '.fk_cms_block_category_position');
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
            $criteria->removeSelectColumn(SpyCmsBlockCategoryConnectorTableMap::COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR);
            $criteria->removeSelectColumn(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY);
            $criteria->removeSelectColumn(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CATEGORY_TEMPLATE);
            $criteria->removeSelectColumn(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK);
            $criteria->removeSelectColumn(SpyCmsBlockCategoryConnectorTableMap::COL_FK_CMS_BLOCK_CATEGORY_POSITION);
        } else {
            $criteria->removeSelectColumn($alias . '.id_cms_block_category_connector');
            $criteria->removeSelectColumn($alias . '.fk_category');
            $criteria->removeSelectColumn($alias . '.fk_category_template');
            $criteria->removeSelectColumn($alias . '.fk_cms_block');
            $criteria->removeSelectColumn($alias . '.fk_cms_block_category_position');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCmsBlockCategoryConnectorTableMap::DATABASE_NAME)->getTable(SpyCmsBlockCategoryConnectorTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCmsBlockCategoryConnector or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCmsBlockCategoryConnector object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockCategoryConnectorTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CmsBlockCategoryConnector\Persistence\SpyCmsBlockCategoryConnector) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCmsBlockCategoryConnectorTableMap::DATABASE_NAME);
            $criteria->add(SpyCmsBlockCategoryConnectorTableMap::COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR, (array) $values, Criteria::IN);
        }

        $query = SpyCmsBlockCategoryConnectorQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCmsBlockCategoryConnectorTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCmsBlockCategoryConnectorTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_cms_block_category_connector table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCmsBlockCategoryConnectorQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCmsBlockCategoryConnector or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCmsBlockCategoryConnector object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockCategoryConnectorTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCmsBlockCategoryConnector object
        }

        if ($criteria->containsKey(SpyCmsBlockCategoryConnectorTableMap::COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR) && $criteria->keyContainsValue(SpyCmsBlockCategoryConnectorTableMap::COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCmsBlockCategoryConnectorTableMap::COL_ID_CMS_BLOCK_CATEGORY_CONNECTOR.')');
        }


        // Set the correct dbName
        $query = SpyCmsBlockCategoryConnectorQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
