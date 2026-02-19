<?php

namespace Orm\Zed\Cms\Persistence\Map;

use Orm\Zed\Cms\Persistence\SpyCmsGlossaryKeyMapping;
use Orm\Zed\Cms\Persistence\SpyCmsGlossaryKeyMappingQuery;
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
 * This class defines the structure of the 'spy_cms_glossary_key_mapping' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCmsGlossaryKeyMappingTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Cms.Persistence.Map.SpyCmsGlossaryKeyMappingTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_cms_glossary_key_mapping';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCmsGlossaryKeyMapping';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Cms\\Persistence\\SpyCmsGlossaryKeyMapping';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Cms.Persistence.SpyCmsGlossaryKeyMapping';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the id_cms_glossary_key_mapping field
     */
    public const COL_ID_CMS_GLOSSARY_KEY_MAPPING = 'spy_cms_glossary_key_mapping.id_cms_glossary_key_mapping';

    /**
     * the column name for the fk_glossary_key field
     */
    public const COL_FK_GLOSSARY_KEY = 'spy_cms_glossary_key_mapping.fk_glossary_key';

    /**
     * the column name for the fk_page field
     */
    public const COL_FK_PAGE = 'spy_cms_glossary_key_mapping.fk_page';

    /**
     * the column name for the placeholder field
     */
    public const COL_PLACEHOLDER = 'spy_cms_glossary_key_mapping.placeholder';

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
        self::TYPE_PHPNAME       => ['IdCmsGlossaryKeyMapping', 'FkGlossaryKey', 'FkPage', 'Placeholder', ],
        self::TYPE_CAMELNAME     => ['idCmsGlossaryKeyMapping', 'fkGlossaryKey', 'fkPage', 'placeholder', ],
        self::TYPE_COLNAME       => [SpyCmsGlossaryKeyMappingTableMap::COL_ID_CMS_GLOSSARY_KEY_MAPPING, SpyCmsGlossaryKeyMappingTableMap::COL_FK_GLOSSARY_KEY, SpyCmsGlossaryKeyMappingTableMap::COL_FK_PAGE, SpyCmsGlossaryKeyMappingTableMap::COL_PLACEHOLDER, ],
        self::TYPE_FIELDNAME     => ['id_cms_glossary_key_mapping', 'fk_glossary_key', 'fk_page', 'placeholder', ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
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
        self::TYPE_PHPNAME       => ['IdCmsGlossaryKeyMapping' => 0, 'FkGlossaryKey' => 1, 'FkPage' => 2, 'Placeholder' => 3, ],
        self::TYPE_CAMELNAME     => ['idCmsGlossaryKeyMapping' => 0, 'fkGlossaryKey' => 1, 'fkPage' => 2, 'placeholder' => 3, ],
        self::TYPE_COLNAME       => [SpyCmsGlossaryKeyMappingTableMap::COL_ID_CMS_GLOSSARY_KEY_MAPPING => 0, SpyCmsGlossaryKeyMappingTableMap::COL_FK_GLOSSARY_KEY => 1, SpyCmsGlossaryKeyMappingTableMap::COL_FK_PAGE => 2, SpyCmsGlossaryKeyMappingTableMap::COL_PLACEHOLDER => 3, ],
        self::TYPE_FIELDNAME     => ['id_cms_glossary_key_mapping' => 0, 'fk_glossary_key' => 1, 'fk_page' => 2, 'placeholder' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCmsGlossaryKeyMapping' => 'ID_CMS_GLOSSARY_KEY_MAPPING',
        'SpyCmsGlossaryKeyMapping.IdCmsGlossaryKeyMapping' => 'ID_CMS_GLOSSARY_KEY_MAPPING',
        'idCmsGlossaryKeyMapping' => 'ID_CMS_GLOSSARY_KEY_MAPPING',
        'spyCmsGlossaryKeyMapping.idCmsGlossaryKeyMapping' => 'ID_CMS_GLOSSARY_KEY_MAPPING',
        'SpyCmsGlossaryKeyMappingTableMap::COL_ID_CMS_GLOSSARY_KEY_MAPPING' => 'ID_CMS_GLOSSARY_KEY_MAPPING',
        'COL_ID_CMS_GLOSSARY_KEY_MAPPING' => 'ID_CMS_GLOSSARY_KEY_MAPPING',
        'id_cms_glossary_key_mapping' => 'ID_CMS_GLOSSARY_KEY_MAPPING',
        'spy_cms_glossary_key_mapping.id_cms_glossary_key_mapping' => 'ID_CMS_GLOSSARY_KEY_MAPPING',
        'FkGlossaryKey' => 'FK_GLOSSARY_KEY',
        'SpyCmsGlossaryKeyMapping.FkGlossaryKey' => 'FK_GLOSSARY_KEY',
        'fkGlossaryKey' => 'FK_GLOSSARY_KEY',
        'spyCmsGlossaryKeyMapping.fkGlossaryKey' => 'FK_GLOSSARY_KEY',
        'SpyCmsGlossaryKeyMappingTableMap::COL_FK_GLOSSARY_KEY' => 'FK_GLOSSARY_KEY',
        'COL_FK_GLOSSARY_KEY' => 'FK_GLOSSARY_KEY',
        'fk_glossary_key' => 'FK_GLOSSARY_KEY',
        'spy_cms_glossary_key_mapping.fk_glossary_key' => 'FK_GLOSSARY_KEY',
        'FkPage' => 'FK_PAGE',
        'SpyCmsGlossaryKeyMapping.FkPage' => 'FK_PAGE',
        'fkPage' => 'FK_PAGE',
        'spyCmsGlossaryKeyMapping.fkPage' => 'FK_PAGE',
        'SpyCmsGlossaryKeyMappingTableMap::COL_FK_PAGE' => 'FK_PAGE',
        'COL_FK_PAGE' => 'FK_PAGE',
        'fk_page' => 'FK_PAGE',
        'spy_cms_glossary_key_mapping.fk_page' => 'FK_PAGE',
        'Placeholder' => 'PLACEHOLDER',
        'SpyCmsGlossaryKeyMapping.Placeholder' => 'PLACEHOLDER',
        'placeholder' => 'PLACEHOLDER',
        'spyCmsGlossaryKeyMapping.placeholder' => 'PLACEHOLDER',
        'SpyCmsGlossaryKeyMappingTableMap::COL_PLACEHOLDER' => 'PLACEHOLDER',
        'COL_PLACEHOLDER' => 'PLACEHOLDER',
        'spy_cms_glossary_key_mapping.placeholder' => 'PLACEHOLDER',
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
        $this->setName('spy_cms_glossary_key_mapping');
        $this->setPhpName('SpyCmsGlossaryKeyMapping');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Cms\\Persistence\\SpyCmsGlossaryKeyMapping');
        $this->setPackage('src.Orm.Zed.Cms.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_cms_glossary_key_mapping_pk_seq');
        // columns
        $this->addPrimaryKey('id_cms_glossary_key_mapping', 'IdCmsGlossaryKeyMapping', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_glossary_key', 'FkGlossaryKey', 'INTEGER', 'spy_glossary_key', 'id_glossary_key', true, null, null);
        $this->addForeignKey('fk_page', 'FkPage', 'INTEGER', 'spy_cms_page', 'id_cms_page', true, null, null);
        $this->addColumn('placeholder', 'Placeholder', 'VARCHAR', true, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('CmsPage', '\\Orm\\Zed\\Cms\\Persistence\\SpyCmsPage', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_page',
    1 => ':id_cms_page',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('GlossaryKey', '\\Orm\\Zed\\Glossary\\Persistence\\SpyGlossaryKey', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_glossary_key',
    1 => ':id_glossary_key',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsGlossaryKeyMapping', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsGlossaryKeyMapping', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsGlossaryKeyMapping', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsGlossaryKeyMapping', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsGlossaryKeyMapping', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCmsGlossaryKeyMapping', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCmsGlossaryKeyMapping', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCmsGlossaryKeyMappingTableMap::CLASS_DEFAULT : SpyCmsGlossaryKeyMappingTableMap::OM_CLASS;
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
     * @return array (SpyCmsGlossaryKeyMapping object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCmsGlossaryKeyMappingTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCmsGlossaryKeyMappingTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCmsGlossaryKeyMappingTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCmsGlossaryKeyMappingTableMap::OM_CLASS;
            /** @var SpyCmsGlossaryKeyMapping $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCmsGlossaryKeyMappingTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCmsGlossaryKeyMappingTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCmsGlossaryKeyMappingTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCmsGlossaryKeyMapping $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCmsGlossaryKeyMappingTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCmsGlossaryKeyMappingTableMap::COL_ID_CMS_GLOSSARY_KEY_MAPPING);
            $criteria->addSelectColumn(SpyCmsGlossaryKeyMappingTableMap::COL_FK_GLOSSARY_KEY);
            $criteria->addSelectColumn(SpyCmsGlossaryKeyMappingTableMap::COL_FK_PAGE);
            $criteria->addSelectColumn(SpyCmsGlossaryKeyMappingTableMap::COL_PLACEHOLDER);
        } else {
            $criteria->addSelectColumn($alias . '.id_cms_glossary_key_mapping');
            $criteria->addSelectColumn($alias . '.fk_glossary_key');
            $criteria->addSelectColumn($alias . '.fk_page');
            $criteria->addSelectColumn($alias . '.placeholder');
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
            $criteria->removeSelectColumn(SpyCmsGlossaryKeyMappingTableMap::COL_ID_CMS_GLOSSARY_KEY_MAPPING);
            $criteria->removeSelectColumn(SpyCmsGlossaryKeyMappingTableMap::COL_FK_GLOSSARY_KEY);
            $criteria->removeSelectColumn(SpyCmsGlossaryKeyMappingTableMap::COL_FK_PAGE);
            $criteria->removeSelectColumn(SpyCmsGlossaryKeyMappingTableMap::COL_PLACEHOLDER);
        } else {
            $criteria->removeSelectColumn($alias . '.id_cms_glossary_key_mapping');
            $criteria->removeSelectColumn($alias . '.fk_glossary_key');
            $criteria->removeSelectColumn($alias . '.fk_page');
            $criteria->removeSelectColumn($alias . '.placeholder');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCmsGlossaryKeyMappingTableMap::DATABASE_NAME)->getTable(SpyCmsGlossaryKeyMappingTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCmsGlossaryKeyMapping or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCmsGlossaryKeyMapping object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsGlossaryKeyMappingTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Cms\Persistence\SpyCmsGlossaryKeyMapping) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCmsGlossaryKeyMappingTableMap::DATABASE_NAME);
            $criteria->add(SpyCmsGlossaryKeyMappingTableMap::COL_ID_CMS_GLOSSARY_KEY_MAPPING, (array) $values, Criteria::IN);
        }

        $query = SpyCmsGlossaryKeyMappingQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCmsGlossaryKeyMappingTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCmsGlossaryKeyMappingTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_cms_glossary_key_mapping table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCmsGlossaryKeyMappingQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCmsGlossaryKeyMapping or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCmsGlossaryKeyMapping object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCmsGlossaryKeyMappingTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCmsGlossaryKeyMapping object
        }

        if ($criteria->containsKey(SpyCmsGlossaryKeyMappingTableMap::COL_ID_CMS_GLOSSARY_KEY_MAPPING) && $criteria->keyContainsValue(SpyCmsGlossaryKeyMappingTableMap::COL_ID_CMS_GLOSSARY_KEY_MAPPING) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCmsGlossaryKeyMappingTableMap::COL_ID_CMS_GLOSSARY_KEY_MAPPING.')');
        }


        // Set the correct dbName
        $query = SpyCmsGlossaryKeyMappingQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
