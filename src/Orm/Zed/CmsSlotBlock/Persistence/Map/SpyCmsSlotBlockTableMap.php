<?php

namespace Orm\Zed\CmsSlotBlock\Persistence\Map;

use Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlock;
use Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlockQuery;
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
 * This class defines the structure of the 'spy_cms_slot_block' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCmsSlotBlockTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CmsSlotBlock.Persistence.Map.SpyCmsSlotBlockTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_cms_slot_block';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCmsSlotBlock';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CmsSlotBlock\\Persistence\\SpyCmsSlotBlock';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CmsSlotBlock.Persistence.SpyCmsSlotBlock';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the id_cms_slot_block field
     */
    public const COL_ID_CMS_SLOT_BLOCK = 'spy_cms_slot_block.id_cms_slot_block';

    /**
     * the column name for the fk_cms_block field
     */
    public const COL_FK_CMS_BLOCK = 'spy_cms_slot_block.fk_cms_block';

    /**
     * the column name for the fk_cms_slot field
     */
    public const COL_FK_CMS_SLOT = 'spy_cms_slot_block.fk_cms_slot';

    /**
     * the column name for the fk_cms_slot_template field
     */
    public const COL_FK_CMS_SLOT_TEMPLATE = 'spy_cms_slot_block.fk_cms_slot_template';

    /**
     * the column name for the conditions field
     */
    public const COL_CONDITIONS = 'spy_cms_slot_block.conditions';

    /**
     * the column name for the position field
     */
    public const COL_POSITION = 'spy_cms_slot_block.position';

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
        self::TYPE_PHPNAME       => ['IdCmsSlotBlock', 'FkCmsBlock', 'FkCmsSlot', 'FkCmsSlotTemplate', 'Conditions', 'Position', ],
        self::TYPE_CAMELNAME     => ['idCmsSlotBlock', 'fkCmsBlock', 'fkCmsSlot', 'fkCmsSlotTemplate', 'conditions', 'position', ],
        self::TYPE_COLNAME       => [SpyCmsSlotBlockTableMap::COL_ID_CMS_SLOT_BLOCK, SpyCmsSlotBlockTableMap::COL_FK_CMS_BLOCK, SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT, SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT_TEMPLATE, SpyCmsSlotBlockTableMap::COL_CONDITIONS, SpyCmsSlotBlockTableMap::COL_POSITION, ],
        self::TYPE_FIELDNAME     => ['id_cms_slot_block', 'fk_cms_block', 'fk_cms_slot', 'fk_cms_slot_template', 'conditions', 'position', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
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
        self::TYPE_PHPNAME       => ['IdCmsSlotBlock' => 0, 'FkCmsBlock' => 1, 'FkCmsSlot' => 2, 'FkCmsSlotTemplate' => 3, 'Conditions' => 4, 'Position' => 5, ],
        self::TYPE_CAMELNAME     => ['idCmsSlotBlock' => 0, 'fkCmsBlock' => 1, 'fkCmsSlot' => 2, 'fkCmsSlotTemplate' => 3, 'conditions' => 4, 'position' => 5, ],
        self::TYPE_COLNAME       => [SpyCmsSlotBlockTableMap::COL_ID_CMS_SLOT_BLOCK => 0, SpyCmsSlotBlockTableMap::COL_FK_CMS_BLOCK => 1, SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT => 2, SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT_TEMPLATE => 3, SpyCmsSlotBlockTableMap::COL_CONDITIONS => 4, SpyCmsSlotBlockTableMap::COL_POSITION => 5, ],
        self::TYPE_FIELDNAME     => ['id_cms_slot_block' => 0, 'fk_cms_block' => 1, 'fk_cms_slot' => 2, 'fk_cms_slot_template' => 3, 'conditions' => 4, 'position' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCmsSlotBlock' => 'ID_CMS_SLOT_BLOCK',
        'SpyCmsSlotBlock.IdCmsSlotBlock' => 'ID_CMS_SLOT_BLOCK',
        'idCmsSlotBlock' => 'ID_CMS_SLOT_BLOCK',
        'spyCmsSlotBlock.idCmsSlotBlock' => 'ID_CMS_SLOT_BLOCK',
        'SpyCmsSlotBlockTableMap::COL_ID_CMS_SLOT_BLOCK' => 'ID_CMS_SLOT_BLOCK',
        'COL_ID_CMS_SLOT_BLOCK' => 'ID_CMS_SLOT_BLOCK',
        'id_cms_slot_block' => 'ID_CMS_SLOT_BLOCK',
        'spy_cms_slot_block.id_cms_slot_block' => 'ID_CMS_SLOT_BLOCK',
        'FkCmsBlock' => 'FK_CMS_BLOCK',
        'SpyCmsSlotBlock.FkCmsBlock' => 'FK_CMS_BLOCK',
        'fkCmsBlock' => 'FK_CMS_BLOCK',
        'spyCmsSlotBlock.fkCmsBlock' => 'FK_CMS_BLOCK',
        'SpyCmsSlotBlockTableMap::COL_FK_CMS_BLOCK' => 'FK_CMS_BLOCK',
        'COL_FK_CMS_BLOCK' => 'FK_CMS_BLOCK',
        'fk_cms_block' => 'FK_CMS_BLOCK',
        'spy_cms_slot_block.fk_cms_block' => 'FK_CMS_BLOCK',
        'FkCmsSlot' => 'FK_CMS_SLOT',
        'SpyCmsSlotBlock.FkCmsSlot' => 'FK_CMS_SLOT',
        'fkCmsSlot' => 'FK_CMS_SLOT',
        'spyCmsSlotBlock.fkCmsSlot' => 'FK_CMS_SLOT',
        'SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT' => 'FK_CMS_SLOT',
        'COL_FK_CMS_SLOT' => 'FK_CMS_SLOT',
        'fk_cms_slot' => 'FK_CMS_SLOT',
        'spy_cms_slot_block.fk_cms_slot' => 'FK_CMS_SLOT',
        'FkCmsSlotTemplate' => 'FK_CMS_SLOT_TEMPLATE',
        'SpyCmsSlotBlock.FkCmsSlotTemplate' => 'FK_CMS_SLOT_TEMPLATE',
        'fkCmsSlotTemplate' => 'FK_CMS_SLOT_TEMPLATE',
        'spyCmsSlotBlock.fkCmsSlotTemplate' => 'FK_CMS_SLOT_TEMPLATE',
        'SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT_TEMPLATE' => 'FK_CMS_SLOT_TEMPLATE',
        'COL_FK_CMS_SLOT_TEMPLATE' => 'FK_CMS_SLOT_TEMPLATE',
        'fk_cms_slot_template' => 'FK_CMS_SLOT_TEMPLATE',
        'spy_cms_slot_block.fk_cms_slot_template' => 'FK_CMS_SLOT_TEMPLATE',
        'Conditions' => 'CONDITIONS',
        'SpyCmsSlotBlock.Conditions' => 'CONDITIONS',
        'conditions' => 'CONDITIONS',
        'spyCmsSlotBlock.conditions' => 'CONDITIONS',
        'SpyCmsSlotBlockTableMap::COL_CONDITIONS' => 'CONDITIONS',
        'COL_CONDITIONS' => 'CONDITIONS',
        'spy_cms_slot_block.conditions' => 'CONDITIONS',
        'Position' => 'POSITION',
        'SpyCmsSlotBlock.Position' => 'POSITION',
        'position' => 'POSITION',
        'spyCmsSlotBlock.position' => 'POSITION',
        'SpyCmsSlotBlockTableMap::COL_POSITION' => 'POSITION',
        'COL_POSITION' => 'POSITION',
        'spy_cms_slot_block.position' => 'POSITION',
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
        $this->setName('spy_cms_slot_block');
        $this->setPhpName('SpyCmsSlotBlock');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\CmsSlotBlock\\Persistence\\SpyCmsSlotBlock');
        $this->setPackage('src.Orm.Zed.CmsSlotBlock.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_cms_slot_block_pk_seq');
        // columns
        $this->addPrimaryKey('id_cms_slot_block', 'IdCmsSlotBlock', 'BIGINT', true, null, null);
        $this->addForeignKey('fk_cms_block', 'FkCmsBlock', 'INTEGER', 'spy_cms_block', 'id_cms_block', true, null, null);
        $this->addForeignKey('fk_cms_slot', 'FkCmsSlot', 'INTEGER', 'spy_cms_slot', 'id_cms_slot', true, null, null);
        $this->addForeignKey('fk_cms_slot_template', 'FkCmsSlotTemplate', 'INTEGER', 'spy_cms_slot_template', 'id_cms_slot_template', true, null, null);
        $this->addColumn('conditions', 'Conditions', 'LONGVARCHAR', false, null, null);
        $this->addColumn('position', 'Position', 'INTEGER', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('CmsSlotTemplate', '\\Orm\\Zed\\CmsSlot\\Persistence\\SpyCmsSlotTemplate', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_cms_slot_template',
    1 => ':id_cms_slot_template',
  ),
), null, null, null, false);
        $this->addRelation('CmsSlot', '\\Orm\\Zed\\CmsSlot\\Persistence\\SpyCmsSlot', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_cms_slot',
    1 => ':id_cms_slot',
  ),
), null, null, null, false);
        $this->addRelation('CmsBlock', '\\Orm\\Zed\\CmsBlock\\Persistence\\SpyCmsBlock', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_cms_block',
    1 => ':id_cms_block',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotBlock', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotBlock', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotBlock', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotBlock', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotBlock', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsSlotBlock', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdCmsSlotBlock', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCmsSlotBlockTableMap::CLASS_DEFAULT : SpyCmsSlotBlockTableMap::OM_CLASS;
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
     * @return array (SpyCmsSlotBlock object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCmsSlotBlockTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCmsSlotBlockTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCmsSlotBlockTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCmsSlotBlockTableMap::OM_CLASS;
            /** @var SpyCmsSlotBlock $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCmsSlotBlockTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCmsSlotBlockTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCmsSlotBlockTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCmsSlotBlock $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCmsSlotBlockTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCmsSlotBlockTableMap::COL_ID_CMS_SLOT_BLOCK);
            $criteria->addSelectColumn(SpyCmsSlotBlockTableMap::COL_FK_CMS_BLOCK);
            $criteria->addSelectColumn(SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT);
            $criteria->addSelectColumn(SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT_TEMPLATE);
            $criteria->addSelectColumn(SpyCmsSlotBlockTableMap::COL_CONDITIONS);
            $criteria->addSelectColumn(SpyCmsSlotBlockTableMap::COL_POSITION);
        } else {
            $criteria->addSelectColumn($alias . '.id_cms_slot_block');
            $criteria->addSelectColumn($alias . '.fk_cms_block');
            $criteria->addSelectColumn($alias . '.fk_cms_slot');
            $criteria->addSelectColumn($alias . '.fk_cms_slot_template');
            $criteria->addSelectColumn($alias . '.conditions');
            $criteria->addSelectColumn($alias . '.position');
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
            $criteria->removeSelectColumn(SpyCmsSlotBlockTableMap::COL_ID_CMS_SLOT_BLOCK);
            $criteria->removeSelectColumn(SpyCmsSlotBlockTableMap::COL_FK_CMS_BLOCK);
            $criteria->removeSelectColumn(SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT);
            $criteria->removeSelectColumn(SpyCmsSlotBlockTableMap::COL_FK_CMS_SLOT_TEMPLATE);
            $criteria->removeSelectColumn(SpyCmsSlotBlockTableMap::COL_CONDITIONS);
            $criteria->removeSelectColumn(SpyCmsSlotBlockTableMap::COL_POSITION);
        } else {
            $criteria->removeSelectColumn($alias . '.id_cms_slot_block');
            $criteria->removeSelectColumn($alias . '.fk_cms_block');
            $criteria->removeSelectColumn($alias . '.fk_cms_slot');
            $criteria->removeSelectColumn($alias . '.fk_cms_slot_template');
            $criteria->removeSelectColumn($alias . '.conditions');
            $criteria->removeSelectColumn($alias . '.position');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCmsSlotBlockTableMap::DATABASE_NAME)->getTable(SpyCmsSlotBlockTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCmsSlotBlock or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCmsSlotBlock object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsSlotBlockTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CmsSlotBlock\Persistence\SpyCmsSlotBlock) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCmsSlotBlockTableMap::DATABASE_NAME);
            $criteria->add(SpyCmsSlotBlockTableMap::COL_ID_CMS_SLOT_BLOCK, (array) $values, Criteria::IN);
        }

        $query = SpyCmsSlotBlockQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCmsSlotBlockTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCmsSlotBlockTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_cms_slot_block table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCmsSlotBlockQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCmsSlotBlock or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCmsSlotBlock object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsSlotBlockTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCmsSlotBlock object
        }


        // Set the correct dbName
        $query = SpyCmsSlotBlockQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
