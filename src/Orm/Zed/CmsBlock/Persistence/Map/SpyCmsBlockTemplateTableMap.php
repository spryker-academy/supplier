<?php

namespace Orm\Zed\CmsBlock\Persistence\Map;

use Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplate;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplateQuery;
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
 * This class defines the structure of the 'spy_cms_block_template' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCmsBlockTemplateTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CmsBlock.Persistence.Map.SpyCmsBlockTemplateTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_cms_block_template';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCmsBlockTemplate';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CmsBlock\\Persistence\\SpyCmsBlockTemplate';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CmsBlock.Persistence.SpyCmsBlockTemplate';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the id_cms_block_template field
     */
    public const COL_ID_CMS_BLOCK_TEMPLATE = 'spy_cms_block_template.id_cms_block_template';

    /**
     * the column name for the template_name field
     */
    public const COL_TEMPLATE_NAME = 'spy_cms_block_template.template_name';

    /**
     * the column name for the template_path field
     */
    public const COL_TEMPLATE_PATH = 'spy_cms_block_template.template_path';

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
        self::TYPE_PHPNAME       => ['IdCmsBlockTemplate', 'TemplateName', 'TemplatePath', ],
        self::TYPE_CAMELNAME     => ['idCmsBlockTemplate', 'templateName', 'templatePath', ],
        self::TYPE_COLNAME       => [SpyCmsBlockTemplateTableMap::COL_ID_CMS_BLOCK_TEMPLATE, SpyCmsBlockTemplateTableMap::COL_TEMPLATE_NAME, SpyCmsBlockTemplateTableMap::COL_TEMPLATE_PATH, ],
        self::TYPE_FIELDNAME     => ['id_cms_block_template', 'template_name', 'template_path', ],
        self::TYPE_NUM           => [0, 1, 2, ]
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
        self::TYPE_PHPNAME       => ['IdCmsBlockTemplate' => 0, 'TemplateName' => 1, 'TemplatePath' => 2, ],
        self::TYPE_CAMELNAME     => ['idCmsBlockTemplate' => 0, 'templateName' => 1, 'templatePath' => 2, ],
        self::TYPE_COLNAME       => [SpyCmsBlockTemplateTableMap::COL_ID_CMS_BLOCK_TEMPLATE => 0, SpyCmsBlockTemplateTableMap::COL_TEMPLATE_NAME => 1, SpyCmsBlockTemplateTableMap::COL_TEMPLATE_PATH => 2, ],
        self::TYPE_FIELDNAME     => ['id_cms_block_template' => 0, 'template_name' => 1, 'template_path' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCmsBlockTemplate' => 'ID_CMS_BLOCK_TEMPLATE',
        'SpyCmsBlockTemplate.IdCmsBlockTemplate' => 'ID_CMS_BLOCK_TEMPLATE',
        'idCmsBlockTemplate' => 'ID_CMS_BLOCK_TEMPLATE',
        'spyCmsBlockTemplate.idCmsBlockTemplate' => 'ID_CMS_BLOCK_TEMPLATE',
        'SpyCmsBlockTemplateTableMap::COL_ID_CMS_BLOCK_TEMPLATE' => 'ID_CMS_BLOCK_TEMPLATE',
        'COL_ID_CMS_BLOCK_TEMPLATE' => 'ID_CMS_BLOCK_TEMPLATE',
        'id_cms_block_template' => 'ID_CMS_BLOCK_TEMPLATE',
        'spy_cms_block_template.id_cms_block_template' => 'ID_CMS_BLOCK_TEMPLATE',
        'TemplateName' => 'TEMPLATE_NAME',
        'SpyCmsBlockTemplate.TemplateName' => 'TEMPLATE_NAME',
        'templateName' => 'TEMPLATE_NAME',
        'spyCmsBlockTemplate.templateName' => 'TEMPLATE_NAME',
        'SpyCmsBlockTemplateTableMap::COL_TEMPLATE_NAME' => 'TEMPLATE_NAME',
        'COL_TEMPLATE_NAME' => 'TEMPLATE_NAME',
        'template_name' => 'TEMPLATE_NAME',
        'spy_cms_block_template.template_name' => 'TEMPLATE_NAME',
        'TemplatePath' => 'TEMPLATE_PATH',
        'SpyCmsBlockTemplate.TemplatePath' => 'TEMPLATE_PATH',
        'templatePath' => 'TEMPLATE_PATH',
        'spyCmsBlockTemplate.templatePath' => 'TEMPLATE_PATH',
        'SpyCmsBlockTemplateTableMap::COL_TEMPLATE_PATH' => 'TEMPLATE_PATH',
        'COL_TEMPLATE_PATH' => 'TEMPLATE_PATH',
        'template_path' => 'TEMPLATE_PATH',
        'spy_cms_block_template.template_path' => 'TEMPLATE_PATH',
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
        $this->setName('spy_cms_block_template');
        $this->setPhpName('SpyCmsBlockTemplate');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\CmsBlock\\Persistence\\SpyCmsBlockTemplate');
        $this->setPackage('src.Orm.Zed.CmsBlock.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_cms_block_template_pk_seq');
        // columns
        $this->addPrimaryKey('id_cms_block_template', 'IdCmsBlockTemplate', 'INTEGER', true, null, null);
        $this->addColumn('template_name', 'TemplateName', 'VARCHAR', true, 255, null);
        $this->addColumn('template_path', 'TemplatePath', 'VARCHAR', true, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyCmsBlock', '\\Orm\\Zed\\CmsBlock\\Persistence\\SpyCmsBlock', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_template',
    1 => ':id_cms_block_template',
  ),
), 'CASCADE', null, 'SpyCmsBlocks', false);
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
     * Method to invalidate the instance pool of all tables related to spy_cms_block_template     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyCmsBlockTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockTemplate', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockTemplate', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockTemplate', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockTemplate', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockTemplate', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockTemplate', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCmsBlockTemplate', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCmsBlockTemplateTableMap::CLASS_DEFAULT : SpyCmsBlockTemplateTableMap::OM_CLASS;
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
     * @return array (SpyCmsBlockTemplate object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCmsBlockTemplateTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCmsBlockTemplateTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCmsBlockTemplateTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCmsBlockTemplateTableMap::OM_CLASS;
            /** @var SpyCmsBlockTemplate $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCmsBlockTemplateTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCmsBlockTemplateTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCmsBlockTemplateTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCmsBlockTemplate $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCmsBlockTemplateTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCmsBlockTemplateTableMap::COL_ID_CMS_BLOCK_TEMPLATE);
            $criteria->addSelectColumn(SpyCmsBlockTemplateTableMap::COL_TEMPLATE_NAME);
            $criteria->addSelectColumn(SpyCmsBlockTemplateTableMap::COL_TEMPLATE_PATH);
        } else {
            $criteria->addSelectColumn($alias . '.id_cms_block_template');
            $criteria->addSelectColumn($alias . '.template_name');
            $criteria->addSelectColumn($alias . '.template_path');
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
            $criteria->removeSelectColumn(SpyCmsBlockTemplateTableMap::COL_ID_CMS_BLOCK_TEMPLATE);
            $criteria->removeSelectColumn(SpyCmsBlockTemplateTableMap::COL_TEMPLATE_NAME);
            $criteria->removeSelectColumn(SpyCmsBlockTemplateTableMap::COL_TEMPLATE_PATH);
        } else {
            $criteria->removeSelectColumn($alias . '.id_cms_block_template');
            $criteria->removeSelectColumn($alias . '.template_name');
            $criteria->removeSelectColumn($alias . '.template_path');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCmsBlockTemplateTableMap::DATABASE_NAME)->getTable(SpyCmsBlockTemplateTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCmsBlockTemplate or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCmsBlockTemplate object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockTemplateTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CmsBlock\Persistence\SpyCmsBlockTemplate) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCmsBlockTemplateTableMap::DATABASE_NAME);
            $criteria->add(SpyCmsBlockTemplateTableMap::COL_ID_CMS_BLOCK_TEMPLATE, (array) $values, Criteria::IN);
        }

        $query = SpyCmsBlockTemplateQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCmsBlockTemplateTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCmsBlockTemplateTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_cms_block_template table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCmsBlockTemplateQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCmsBlockTemplate or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCmsBlockTemplate object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockTemplateTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCmsBlockTemplate object
        }

        if ($criteria->containsKey(SpyCmsBlockTemplateTableMap::COL_ID_CMS_BLOCK_TEMPLATE) && $criteria->keyContainsValue(SpyCmsBlockTemplateTableMap::COL_ID_CMS_BLOCK_TEMPLATE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCmsBlockTemplateTableMap::COL_ID_CMS_BLOCK_TEMPLATE.')');
        }


        // Set the correct dbName
        $query = SpyCmsBlockTemplateQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
