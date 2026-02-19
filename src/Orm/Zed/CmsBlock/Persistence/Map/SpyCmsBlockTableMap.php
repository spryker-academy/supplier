<?php

namespace Orm\Zed\CmsBlock\Persistence\Map;

use Orm\Zed\CmsBlockCategoryConnector\Persistence\Map\SpyCmsBlockCategoryConnectorTableMap;
use Orm\Zed\CmsBlockProductConnector\Persistence\Map\SpyCmsBlockProductConnectorTableMap;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlock;
use Orm\Zed\CmsBlock\Persistence\SpyCmsBlockQuery;
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
 * This class defines the structure of the 'spy_cms_block' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCmsBlockTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CmsBlock.Persistence.Map.SpyCmsBlockTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_cms_block';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCmsBlock';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CmsBlock\\Persistence\\SpyCmsBlock';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CmsBlock.Persistence.SpyCmsBlock';

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
     * the column name for the id_cms_block field
     */
    public const COL_ID_CMS_BLOCK = 'spy_cms_block.id_cms_block';

    /**
     * the column name for the fk_template field
     */
    public const COL_FK_TEMPLATE = 'spy_cms_block.fk_template';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_cms_block.is_active';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_cms_block.key';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_cms_block.name';

    /**
     * the column name for the valid_from field
     */
    public const COL_VALID_FROM = 'spy_cms_block.valid_from';

    /**
     * the column name for the valid_to field
     */
    public const COL_VALID_TO = 'spy_cms_block.valid_to';

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
        self::TYPE_PHPNAME       => ['IdCmsBlock', 'FkTemplate', 'IsActive', 'Key', 'Name', 'ValidFrom', 'ValidTo', ],
        self::TYPE_CAMELNAME     => ['idCmsBlock', 'fkTemplate', 'isActive', 'key', 'name', 'validFrom', 'validTo', ],
        self::TYPE_COLNAME       => [SpyCmsBlockTableMap::COL_ID_CMS_BLOCK, SpyCmsBlockTableMap::COL_FK_TEMPLATE, SpyCmsBlockTableMap::COL_IS_ACTIVE, SpyCmsBlockTableMap::COL_KEY, SpyCmsBlockTableMap::COL_NAME, SpyCmsBlockTableMap::COL_VALID_FROM, SpyCmsBlockTableMap::COL_VALID_TO, ],
        self::TYPE_FIELDNAME     => ['id_cms_block', 'fk_template', 'is_active', 'key', 'name', 'valid_from', 'valid_to', ],
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
        self::TYPE_PHPNAME       => ['IdCmsBlock' => 0, 'FkTemplate' => 1, 'IsActive' => 2, 'Key' => 3, 'Name' => 4, 'ValidFrom' => 5, 'ValidTo' => 6, ],
        self::TYPE_CAMELNAME     => ['idCmsBlock' => 0, 'fkTemplate' => 1, 'isActive' => 2, 'key' => 3, 'name' => 4, 'validFrom' => 5, 'validTo' => 6, ],
        self::TYPE_COLNAME       => [SpyCmsBlockTableMap::COL_ID_CMS_BLOCK => 0, SpyCmsBlockTableMap::COL_FK_TEMPLATE => 1, SpyCmsBlockTableMap::COL_IS_ACTIVE => 2, SpyCmsBlockTableMap::COL_KEY => 3, SpyCmsBlockTableMap::COL_NAME => 4, SpyCmsBlockTableMap::COL_VALID_FROM => 5, SpyCmsBlockTableMap::COL_VALID_TO => 6, ],
        self::TYPE_FIELDNAME     => ['id_cms_block' => 0, 'fk_template' => 1, 'is_active' => 2, 'key' => 3, 'name' => 4, 'valid_from' => 5, 'valid_to' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCmsBlock' => 'ID_CMS_BLOCK',
        'SpyCmsBlock.IdCmsBlock' => 'ID_CMS_BLOCK',
        'idCmsBlock' => 'ID_CMS_BLOCK',
        'spyCmsBlock.idCmsBlock' => 'ID_CMS_BLOCK',
        'SpyCmsBlockTableMap::COL_ID_CMS_BLOCK' => 'ID_CMS_BLOCK',
        'COL_ID_CMS_BLOCK' => 'ID_CMS_BLOCK',
        'id_cms_block' => 'ID_CMS_BLOCK',
        'spy_cms_block.id_cms_block' => 'ID_CMS_BLOCK',
        'FkTemplate' => 'FK_TEMPLATE',
        'SpyCmsBlock.FkTemplate' => 'FK_TEMPLATE',
        'fkTemplate' => 'FK_TEMPLATE',
        'spyCmsBlock.fkTemplate' => 'FK_TEMPLATE',
        'SpyCmsBlockTableMap::COL_FK_TEMPLATE' => 'FK_TEMPLATE',
        'COL_FK_TEMPLATE' => 'FK_TEMPLATE',
        'fk_template' => 'FK_TEMPLATE',
        'spy_cms_block.fk_template' => 'FK_TEMPLATE',
        'IsActive' => 'IS_ACTIVE',
        'SpyCmsBlock.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyCmsBlock.isActive' => 'IS_ACTIVE',
        'SpyCmsBlockTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_cms_block.is_active' => 'IS_ACTIVE',
        'Key' => 'KEY',
        'SpyCmsBlock.Key' => 'KEY',
        'key' => 'KEY',
        'spyCmsBlock.key' => 'KEY',
        'SpyCmsBlockTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_cms_block.key' => 'KEY',
        'Name' => 'NAME',
        'SpyCmsBlock.Name' => 'NAME',
        'name' => 'NAME',
        'spyCmsBlock.name' => 'NAME',
        'SpyCmsBlockTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_cms_block.name' => 'NAME',
        'ValidFrom' => 'VALID_FROM',
        'SpyCmsBlock.ValidFrom' => 'VALID_FROM',
        'validFrom' => 'VALID_FROM',
        'spyCmsBlock.validFrom' => 'VALID_FROM',
        'SpyCmsBlockTableMap::COL_VALID_FROM' => 'VALID_FROM',
        'COL_VALID_FROM' => 'VALID_FROM',
        'valid_from' => 'VALID_FROM',
        'spy_cms_block.valid_from' => 'VALID_FROM',
        'ValidTo' => 'VALID_TO',
        'SpyCmsBlock.ValidTo' => 'VALID_TO',
        'validTo' => 'VALID_TO',
        'spyCmsBlock.validTo' => 'VALID_TO',
        'SpyCmsBlockTableMap::COL_VALID_TO' => 'VALID_TO',
        'COL_VALID_TO' => 'VALID_TO',
        'valid_to' => 'VALID_TO',
        'spy_cms_block.valid_to' => 'VALID_TO',
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
        $this->setName('spy_cms_block');
        $this->setPhpName('SpyCmsBlock');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\CmsBlock\\Persistence\\SpyCmsBlock');
        $this->setPackage('src.Orm.Zed.CmsBlock.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_cms_block_pk_seq');
        // columns
        $this->addPrimaryKey('id_cms_block', 'IdCmsBlock', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_template', 'FkTemplate', 'INTEGER', 'spy_cms_block_template', 'id_cms_block_template', false, null, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', true, 1, false);
        $this->addColumn('key', 'Key', 'VARCHAR', true, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
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
        $this->addRelation('CmsBlockTemplate', '\\Orm\\Zed\\CmsBlock\\Persistence\\SpyCmsBlockTemplate', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_template',
    1 => ':id_cms_block_template',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyCmsBlockGlossaryKeyMapping', '\\Orm\\Zed\\CmsBlock\\Persistence\\SpyCmsBlockGlossaryKeyMapping', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_cms_block',
    1 => ':id_cms_block',
  ),
), 'CASCADE', null, 'SpyCmsBlockGlossaryKeyMappings', false);
        $this->addRelation('SpyCmsBlockStore', '\\Orm\\Zed\\CmsBlock\\Persistence\\SpyCmsBlockStore', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_cms_block',
    1 => ':id_cms_block',
  ),
), null, null, 'SpyCmsBlockStores', false);
        $this->addRelation('SpyCmsBlockCategoryConnector', '\\Orm\\Zed\\CmsBlockCategoryConnector\\Persistence\\SpyCmsBlockCategoryConnector', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_cms_block',
    1 => ':id_cms_block',
  ),
), 'CASCADE', null, 'SpyCmsBlockCategoryConnectors', false);
        $this->addRelation('SpyCmsBlockProductConnector', '\\Orm\\Zed\\CmsBlockProductConnector\\Persistence\\SpyCmsBlockProductConnector', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_cms_block',
    1 => ':id_cms_block',
  ),
), 'CASCADE', null, 'SpyCmsBlockProductConnectors', false);
        $this->addRelation('SpyCmsSlotBlock', '\\Orm\\Zed\\CmsSlotBlock\\Persistence\\SpyCmsSlotBlock', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_cms_block',
    1 => ':id_cms_block',
  ),
), null, null, 'SpyCmsSlotBlocks', false);
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
            'event' => ['spy_cms_block_all' => ['column' => '*']],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_cms_block     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyCmsBlockGlossaryKeyMappingTableMap::clearInstancePool();
        SpyCmsBlockCategoryConnectorTableMap::clearInstancePool();
        SpyCmsBlockProductConnectorTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlock', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlock', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlock', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlock', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlock', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlock', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCmsBlock', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCmsBlockTableMap::CLASS_DEFAULT : SpyCmsBlockTableMap::OM_CLASS;
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
     * @return array (SpyCmsBlock object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCmsBlockTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCmsBlockTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCmsBlockTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCmsBlockTableMap::OM_CLASS;
            /** @var SpyCmsBlock $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCmsBlockTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCmsBlockTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCmsBlockTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCmsBlock $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCmsBlockTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK);
            $criteria->addSelectColumn(SpyCmsBlockTableMap::COL_FK_TEMPLATE);
            $criteria->addSelectColumn(SpyCmsBlockTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyCmsBlockTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyCmsBlockTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyCmsBlockTableMap::COL_VALID_FROM);
            $criteria->addSelectColumn(SpyCmsBlockTableMap::COL_VALID_TO);
        } else {
            $criteria->addSelectColumn($alias . '.id_cms_block');
            $criteria->addSelectColumn($alias . '.fk_template');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.name');
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
            $criteria->removeSelectColumn(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK);
            $criteria->removeSelectColumn(SpyCmsBlockTableMap::COL_FK_TEMPLATE);
            $criteria->removeSelectColumn(SpyCmsBlockTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyCmsBlockTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyCmsBlockTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyCmsBlockTableMap::COL_VALID_FROM);
            $criteria->removeSelectColumn(SpyCmsBlockTableMap::COL_VALID_TO);
        } else {
            $criteria->removeSelectColumn($alias . '.id_cms_block');
            $criteria->removeSelectColumn($alias . '.fk_template');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCmsBlockTableMap::DATABASE_NAME)->getTable(SpyCmsBlockTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCmsBlock or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCmsBlock object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CmsBlock\Persistence\SpyCmsBlock) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCmsBlockTableMap::DATABASE_NAME);
            $criteria->add(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK, (array) $values, Criteria::IN);
        }

        $query = SpyCmsBlockQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCmsBlockTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCmsBlockTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_cms_block table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCmsBlockQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCmsBlock or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCmsBlock object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCmsBlock object
        }

        if ($criteria->containsKey(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK) && $criteria->keyContainsValue(SpyCmsBlockTableMap::COL_ID_CMS_BLOCK) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCmsBlockTableMap::COL_ID_CMS_BLOCK.')');
        }


        // Set the correct dbName
        $query = SpyCmsBlockQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
