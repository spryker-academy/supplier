<?php

namespace Orm\Zed\CmsBlockProductConnector\Persistence\Map;

use Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector;
use Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnectorQuery;
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
 * This class defines the structure of the 'spy_cms_block_product_connector' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCmsBlockProductConnectorTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CmsBlockProductConnector.Persistence.Map.SpyCmsBlockProductConnectorTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_cms_block_product_connector';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCmsBlockProductConnector';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CmsBlockProductConnector\\Persistence\\SpyCmsBlockProductConnector';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CmsBlockProductConnector.Persistence.SpyCmsBlockProductConnector';

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
     * the column name for the id_cms_block_product_connector field
     */
    public const COL_ID_CMS_BLOCK_PRODUCT_CONNECTOR = 'spy_cms_block_product_connector.id_cms_block_product_connector';

    /**
     * the column name for the fk_cms_block field
     */
    public const COL_FK_CMS_BLOCK = 'spy_cms_block_product_connector.fk_cms_block';

    /**
     * the column name for the fk_product_abstract field
     */
    public const COL_FK_PRODUCT_ABSTRACT = 'spy_cms_block_product_connector.fk_product_abstract';

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
        self::TYPE_PHPNAME       => ['IdCmsBlockProductConnector', 'FkCmsBlock', 'FkProductAbstract', ],
        self::TYPE_CAMELNAME     => ['idCmsBlockProductConnector', 'fkCmsBlock', 'fkProductAbstract', ],
        self::TYPE_COLNAME       => [SpyCmsBlockProductConnectorTableMap::COL_ID_CMS_BLOCK_PRODUCT_CONNECTOR, SpyCmsBlockProductConnectorTableMap::COL_FK_CMS_BLOCK, SpyCmsBlockProductConnectorTableMap::COL_FK_PRODUCT_ABSTRACT, ],
        self::TYPE_FIELDNAME     => ['id_cms_block_product_connector', 'fk_cms_block', 'fk_product_abstract', ],
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
        self::TYPE_PHPNAME       => ['IdCmsBlockProductConnector' => 0, 'FkCmsBlock' => 1, 'FkProductAbstract' => 2, ],
        self::TYPE_CAMELNAME     => ['idCmsBlockProductConnector' => 0, 'fkCmsBlock' => 1, 'fkProductAbstract' => 2, ],
        self::TYPE_COLNAME       => [SpyCmsBlockProductConnectorTableMap::COL_ID_CMS_BLOCK_PRODUCT_CONNECTOR => 0, SpyCmsBlockProductConnectorTableMap::COL_FK_CMS_BLOCK => 1, SpyCmsBlockProductConnectorTableMap::COL_FK_PRODUCT_ABSTRACT => 2, ],
        self::TYPE_FIELDNAME     => ['id_cms_block_product_connector' => 0, 'fk_cms_block' => 1, 'fk_product_abstract' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCmsBlockProductConnector' => 'ID_CMS_BLOCK_PRODUCT_CONNECTOR',
        'SpyCmsBlockProductConnector.IdCmsBlockProductConnector' => 'ID_CMS_BLOCK_PRODUCT_CONNECTOR',
        'idCmsBlockProductConnector' => 'ID_CMS_BLOCK_PRODUCT_CONNECTOR',
        'spyCmsBlockProductConnector.idCmsBlockProductConnector' => 'ID_CMS_BLOCK_PRODUCT_CONNECTOR',
        'SpyCmsBlockProductConnectorTableMap::COL_ID_CMS_BLOCK_PRODUCT_CONNECTOR' => 'ID_CMS_BLOCK_PRODUCT_CONNECTOR',
        'COL_ID_CMS_BLOCK_PRODUCT_CONNECTOR' => 'ID_CMS_BLOCK_PRODUCT_CONNECTOR',
        'id_cms_block_product_connector' => 'ID_CMS_BLOCK_PRODUCT_CONNECTOR',
        'spy_cms_block_product_connector.id_cms_block_product_connector' => 'ID_CMS_BLOCK_PRODUCT_CONNECTOR',
        'FkCmsBlock' => 'FK_CMS_BLOCK',
        'SpyCmsBlockProductConnector.FkCmsBlock' => 'FK_CMS_BLOCK',
        'fkCmsBlock' => 'FK_CMS_BLOCK',
        'spyCmsBlockProductConnector.fkCmsBlock' => 'FK_CMS_BLOCK',
        'SpyCmsBlockProductConnectorTableMap::COL_FK_CMS_BLOCK' => 'FK_CMS_BLOCK',
        'COL_FK_CMS_BLOCK' => 'FK_CMS_BLOCK',
        'fk_cms_block' => 'FK_CMS_BLOCK',
        'spy_cms_block_product_connector.fk_cms_block' => 'FK_CMS_BLOCK',
        'FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyCmsBlockProductConnector.FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'spyCmsBlockProductConnector.fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyCmsBlockProductConnectorTableMap::COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'spy_cms_block_product_connector.fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
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
        $this->setName('spy_cms_block_product_connector');
        $this->setPhpName('SpyCmsBlockProductConnector');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\CmsBlockProductConnector\\Persistence\\SpyCmsBlockProductConnector');
        $this->setPackage('src.Orm.Zed.CmsBlockProductConnector.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_cms_block_product_connector_pk_seq');
        // columns
        $this->addPrimaryKey('id_cms_block_product_connector', 'IdCmsBlockProductConnector', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_cms_block', 'FkCmsBlock', 'INTEGER', 'spy_cms_block', 'id_cms_block', true, null, null);
        $this->addForeignKey('fk_product_abstract', 'FkProductAbstract', 'INTEGER', 'spy_product_abstract', 'id_product_abstract', true, null, null);
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
        $this->addRelation('ProductAbstract', '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstract', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockProductConnector', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockProductConnector', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockProductConnector', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockProductConnector', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockProductConnector', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsBlockProductConnector', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCmsBlockProductConnector', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCmsBlockProductConnectorTableMap::CLASS_DEFAULT : SpyCmsBlockProductConnectorTableMap::OM_CLASS;
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
     * @return array (SpyCmsBlockProductConnector object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCmsBlockProductConnectorTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCmsBlockProductConnectorTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCmsBlockProductConnectorTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCmsBlockProductConnectorTableMap::OM_CLASS;
            /** @var SpyCmsBlockProductConnector $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCmsBlockProductConnectorTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCmsBlockProductConnectorTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCmsBlockProductConnectorTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCmsBlockProductConnector $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCmsBlockProductConnectorTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCmsBlockProductConnectorTableMap::COL_ID_CMS_BLOCK_PRODUCT_CONNECTOR);
            $criteria->addSelectColumn(SpyCmsBlockProductConnectorTableMap::COL_FK_CMS_BLOCK);
            $criteria->addSelectColumn(SpyCmsBlockProductConnectorTableMap::COL_FK_PRODUCT_ABSTRACT);
        } else {
            $criteria->addSelectColumn($alias . '.id_cms_block_product_connector');
            $criteria->addSelectColumn($alias . '.fk_cms_block');
            $criteria->addSelectColumn($alias . '.fk_product_abstract');
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
            $criteria->removeSelectColumn(SpyCmsBlockProductConnectorTableMap::COL_ID_CMS_BLOCK_PRODUCT_CONNECTOR);
            $criteria->removeSelectColumn(SpyCmsBlockProductConnectorTableMap::COL_FK_CMS_BLOCK);
            $criteria->removeSelectColumn(SpyCmsBlockProductConnectorTableMap::COL_FK_PRODUCT_ABSTRACT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_cms_block_product_connector');
            $criteria->removeSelectColumn($alias . '.fk_cms_block');
            $criteria->removeSelectColumn($alias . '.fk_product_abstract');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCmsBlockProductConnectorTableMap::DATABASE_NAME)->getTable(SpyCmsBlockProductConnectorTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCmsBlockProductConnector or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCmsBlockProductConnector object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockProductConnectorTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CmsBlockProductConnector\Persistence\SpyCmsBlockProductConnector) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCmsBlockProductConnectorTableMap::DATABASE_NAME);
            $criteria->add(SpyCmsBlockProductConnectorTableMap::COL_ID_CMS_BLOCK_PRODUCT_CONNECTOR, (array) $values, Criteria::IN);
        }

        $query = SpyCmsBlockProductConnectorQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCmsBlockProductConnectorTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCmsBlockProductConnectorTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_cms_block_product_connector table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCmsBlockProductConnectorQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCmsBlockProductConnector or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCmsBlockProductConnector object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsBlockProductConnectorTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCmsBlockProductConnector object
        }

        if ($criteria->containsKey(SpyCmsBlockProductConnectorTableMap::COL_ID_CMS_BLOCK_PRODUCT_CONNECTOR) && $criteria->keyContainsValue(SpyCmsBlockProductConnectorTableMap::COL_ID_CMS_BLOCK_PRODUCT_CONNECTOR) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCmsBlockProductConnectorTableMap::COL_ID_CMS_BLOCK_PRODUCT_CONNECTOR.')');
        }


        // Set the correct dbName
        $query = SpyCmsBlockProductConnectorQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
