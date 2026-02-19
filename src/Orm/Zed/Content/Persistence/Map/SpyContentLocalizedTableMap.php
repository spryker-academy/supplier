<?php

namespace Orm\Zed\Content\Persistence\Map;

use Orm\Zed\Content\Persistence\SpyContentLocalized;
use Orm\Zed\Content\Persistence\SpyContentLocalizedQuery;
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
 * This class defines the structure of the 'spy_content_localized' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyContentLocalizedTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Content.Persistence.Map.SpyContentLocalizedTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_content_localized';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyContentLocalized';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Content\\Persistence\\SpyContentLocalized';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Content.Persistence.SpyContentLocalized';

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
     * the column name for the id_content_localized field
     */
    public const COL_ID_CONTENT_LOCALIZED = 'spy_content_localized.id_content_localized';

    /**
     * the column name for the fk_content field
     */
    public const COL_FK_CONTENT = 'spy_content_localized.fk_content';

    /**
     * the column name for the fk_locale field
     */
    public const COL_FK_LOCALE = 'spy_content_localized.fk_locale';

    /**
     * the column name for the parameters field
     */
    public const COL_PARAMETERS = 'spy_content_localized.parameters';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_content_localized.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_content_localized.updated_at';

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
        self::TYPE_PHPNAME       => ['IdContentLocalized', 'FkContent', 'FkLocale', 'Parameters', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idContentLocalized', 'fkContent', 'fkLocale', 'parameters', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyContentLocalizedTableMap::COL_ID_CONTENT_LOCALIZED, SpyContentLocalizedTableMap::COL_FK_CONTENT, SpyContentLocalizedTableMap::COL_FK_LOCALE, SpyContentLocalizedTableMap::COL_PARAMETERS, SpyContentLocalizedTableMap::COL_CREATED_AT, SpyContentLocalizedTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_content_localized', 'fk_content', 'fk_locale', 'parameters', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdContentLocalized' => 0, 'FkContent' => 1, 'FkLocale' => 2, 'Parameters' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idContentLocalized' => 0, 'fkContent' => 1, 'fkLocale' => 2, 'parameters' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [SpyContentLocalizedTableMap::COL_ID_CONTENT_LOCALIZED => 0, SpyContentLocalizedTableMap::COL_FK_CONTENT => 1, SpyContentLocalizedTableMap::COL_FK_LOCALE => 2, SpyContentLocalizedTableMap::COL_PARAMETERS => 3, SpyContentLocalizedTableMap::COL_CREATED_AT => 4, SpyContentLocalizedTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['id_content_localized' => 0, 'fk_content' => 1, 'fk_locale' => 2, 'parameters' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdContentLocalized' => 'ID_CONTENT_LOCALIZED',
        'SpyContentLocalized.IdContentLocalized' => 'ID_CONTENT_LOCALIZED',
        'idContentLocalized' => 'ID_CONTENT_LOCALIZED',
        'spyContentLocalized.idContentLocalized' => 'ID_CONTENT_LOCALIZED',
        'SpyContentLocalizedTableMap::COL_ID_CONTENT_LOCALIZED' => 'ID_CONTENT_LOCALIZED',
        'COL_ID_CONTENT_LOCALIZED' => 'ID_CONTENT_LOCALIZED',
        'id_content_localized' => 'ID_CONTENT_LOCALIZED',
        'spy_content_localized.id_content_localized' => 'ID_CONTENT_LOCALIZED',
        'FkContent' => 'FK_CONTENT',
        'SpyContentLocalized.FkContent' => 'FK_CONTENT',
        'fkContent' => 'FK_CONTENT',
        'spyContentLocalized.fkContent' => 'FK_CONTENT',
        'SpyContentLocalizedTableMap::COL_FK_CONTENT' => 'FK_CONTENT',
        'COL_FK_CONTENT' => 'FK_CONTENT',
        'fk_content' => 'FK_CONTENT',
        'spy_content_localized.fk_content' => 'FK_CONTENT',
        'FkLocale' => 'FK_LOCALE',
        'SpyContentLocalized.FkLocale' => 'FK_LOCALE',
        'fkLocale' => 'FK_LOCALE',
        'spyContentLocalized.fkLocale' => 'FK_LOCALE',
        'SpyContentLocalizedTableMap::COL_FK_LOCALE' => 'FK_LOCALE',
        'COL_FK_LOCALE' => 'FK_LOCALE',
        'fk_locale' => 'FK_LOCALE',
        'spy_content_localized.fk_locale' => 'FK_LOCALE',
        'Parameters' => 'PARAMETERS',
        'SpyContentLocalized.Parameters' => 'PARAMETERS',
        'parameters' => 'PARAMETERS',
        'spyContentLocalized.parameters' => 'PARAMETERS',
        'SpyContentLocalizedTableMap::COL_PARAMETERS' => 'PARAMETERS',
        'COL_PARAMETERS' => 'PARAMETERS',
        'spy_content_localized.parameters' => 'PARAMETERS',
        'CreatedAt' => 'CREATED_AT',
        'SpyContentLocalized.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyContentLocalized.createdAt' => 'CREATED_AT',
        'SpyContentLocalizedTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_content_localized.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyContentLocalized.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyContentLocalized.updatedAt' => 'UPDATED_AT',
        'SpyContentLocalizedTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_content_localized.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_content_localized');
        $this->setPhpName('SpyContentLocalized');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Content\\Persistence\\SpyContentLocalized');
        $this->setPackage('src.Orm.Zed.Content.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_content_localized_pk_seq');
        // columns
        $this->addPrimaryKey('id_content_localized', 'IdContentLocalized', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_content', 'FkContent', 'INTEGER', 'spy_content', 'id_content', true, null, null);
        $this->addForeignKey('fk_locale', 'FkLocale', 'INTEGER', 'spy_locale', 'id_locale', false, null, null);
        $this->addColumn('parameters', 'Parameters', 'LONGVARCHAR', true, null, null);
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
        $this->addRelation('SpyContent', '\\Orm\\Zed\\Content\\Persistence\\SpyContent', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_content',
    1 => ':id_content',
  ),
), null, null, null, false);
        $this->addRelation('SpyLocale', '\\Orm\\Zed\\Locale\\Persistence\\SpyLocale', RelationMap::MANY_TO_ONE, array (
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdContentLocalized', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdContentLocalized', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdContentLocalized', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdContentLocalized', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdContentLocalized', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdContentLocalized', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdContentLocalized', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyContentLocalizedTableMap::CLASS_DEFAULT : SpyContentLocalizedTableMap::OM_CLASS;
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
     * @return array (SpyContentLocalized object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyContentLocalizedTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyContentLocalizedTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyContentLocalizedTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyContentLocalizedTableMap::OM_CLASS;
            /** @var SpyContentLocalized $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyContentLocalizedTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyContentLocalizedTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyContentLocalizedTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyContentLocalized $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyContentLocalizedTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyContentLocalizedTableMap::COL_ID_CONTENT_LOCALIZED);
            $criteria->addSelectColumn(SpyContentLocalizedTableMap::COL_FK_CONTENT);
            $criteria->addSelectColumn(SpyContentLocalizedTableMap::COL_FK_LOCALE);
            $criteria->addSelectColumn(SpyContentLocalizedTableMap::COL_PARAMETERS);
            $criteria->addSelectColumn(SpyContentLocalizedTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyContentLocalizedTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_content_localized');
            $criteria->addSelectColumn($alias . '.fk_content');
            $criteria->addSelectColumn($alias . '.fk_locale');
            $criteria->addSelectColumn($alias . '.parameters');
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
            $criteria->removeSelectColumn(SpyContentLocalizedTableMap::COL_ID_CONTENT_LOCALIZED);
            $criteria->removeSelectColumn(SpyContentLocalizedTableMap::COL_FK_CONTENT);
            $criteria->removeSelectColumn(SpyContentLocalizedTableMap::COL_FK_LOCALE);
            $criteria->removeSelectColumn(SpyContentLocalizedTableMap::COL_PARAMETERS);
            $criteria->removeSelectColumn(SpyContentLocalizedTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyContentLocalizedTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_content_localized');
            $criteria->removeSelectColumn($alias . '.fk_content');
            $criteria->removeSelectColumn($alias . '.fk_locale');
            $criteria->removeSelectColumn($alias . '.parameters');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyContentLocalizedTableMap::DATABASE_NAME)->getTable(SpyContentLocalizedTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyContentLocalized or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyContentLocalized object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyContentLocalizedTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Content\Persistence\SpyContentLocalized) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyContentLocalizedTableMap::DATABASE_NAME);
            $criteria->add(SpyContentLocalizedTableMap::COL_ID_CONTENT_LOCALIZED, (array) $values, Criteria::IN);
        }

        $query = SpyContentLocalizedQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyContentLocalizedTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyContentLocalizedTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_content_localized table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyContentLocalizedQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyContentLocalized or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyContentLocalized object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyContentLocalizedTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyContentLocalized object
        }

        if ($criteria->containsKey(SpyContentLocalizedTableMap::COL_ID_CONTENT_LOCALIZED) && $criteria->keyContainsValue(SpyContentLocalizedTableMap::COL_ID_CONTENT_LOCALIZED) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyContentLocalizedTableMap::COL_ID_CONTENT_LOCALIZED.')');
        }


        // Set the correct dbName
        $query = SpyContentLocalizedQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
