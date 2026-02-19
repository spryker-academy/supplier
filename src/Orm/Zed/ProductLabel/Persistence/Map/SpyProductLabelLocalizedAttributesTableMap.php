<?php

namespace Orm\Zed\ProductLabel\Persistence\Map;

use Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributes;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributesQuery;
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
 * This class defines the structure of the 'spy_product_label_localized_attributes' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductLabelLocalizedAttributesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductLabel.Persistence.Map.SpyProductLabelLocalizedAttributesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_label_localized_attributes';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductLabelLocalizedAttributes';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductLabel\\Persistence\\SpyProductLabelLocalizedAttributes';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductLabel.Persistence.SpyProductLabelLocalizedAttributes';

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
     * the column name for the id_product_label_localized_attributes field
     */
    public const COL_ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES = 'spy_product_label_localized_attributes.id_product_label_localized_attributes';

    /**
     * the column name for the fk_locale field
     */
    public const COL_FK_LOCALE = 'spy_product_label_localized_attributes.fk_locale';

    /**
     * the column name for the fk_product_label field
     */
    public const COL_FK_PRODUCT_LABEL = 'spy_product_label_localized_attributes.fk_product_label';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_product_label_localized_attributes.name';

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
        self::TYPE_PHPNAME       => ['IdProductLabelLocalizedAttributes', 'FkLocale', 'FkProductLabel', 'Name', ],
        self::TYPE_CAMELNAME     => ['idProductLabelLocalizedAttributes', 'fkLocale', 'fkProductLabel', 'name', ],
        self::TYPE_COLNAME       => [SpyProductLabelLocalizedAttributesTableMap::COL_ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES, SpyProductLabelLocalizedAttributesTableMap::COL_FK_LOCALE, SpyProductLabelLocalizedAttributesTableMap::COL_FK_PRODUCT_LABEL, SpyProductLabelLocalizedAttributesTableMap::COL_NAME, ],
        self::TYPE_FIELDNAME     => ['id_product_label_localized_attributes', 'fk_locale', 'fk_product_label', 'name', ],
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
        self::TYPE_PHPNAME       => ['IdProductLabelLocalizedAttributes' => 0, 'FkLocale' => 1, 'FkProductLabel' => 2, 'Name' => 3, ],
        self::TYPE_CAMELNAME     => ['idProductLabelLocalizedAttributes' => 0, 'fkLocale' => 1, 'fkProductLabel' => 2, 'name' => 3, ],
        self::TYPE_COLNAME       => [SpyProductLabelLocalizedAttributesTableMap::COL_ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES => 0, SpyProductLabelLocalizedAttributesTableMap::COL_FK_LOCALE => 1, SpyProductLabelLocalizedAttributesTableMap::COL_FK_PRODUCT_LABEL => 2, SpyProductLabelLocalizedAttributesTableMap::COL_NAME => 3, ],
        self::TYPE_FIELDNAME     => ['id_product_label_localized_attributes' => 0, 'fk_locale' => 1, 'fk_product_label' => 2, 'name' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductLabelLocalizedAttributes' => 'ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES',
        'SpyProductLabelLocalizedAttributes.IdProductLabelLocalizedAttributes' => 'ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES',
        'idProductLabelLocalizedAttributes' => 'ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES',
        'spyProductLabelLocalizedAttributes.idProductLabelLocalizedAttributes' => 'ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES',
        'SpyProductLabelLocalizedAttributesTableMap::COL_ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES' => 'ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES',
        'COL_ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES' => 'ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES',
        'id_product_label_localized_attributes' => 'ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES',
        'spy_product_label_localized_attributes.id_product_label_localized_attributes' => 'ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES',
        'FkLocale' => 'FK_LOCALE',
        'SpyProductLabelLocalizedAttributes.FkLocale' => 'FK_LOCALE',
        'fkLocale' => 'FK_LOCALE',
        'spyProductLabelLocalizedAttributes.fkLocale' => 'FK_LOCALE',
        'SpyProductLabelLocalizedAttributesTableMap::COL_FK_LOCALE' => 'FK_LOCALE',
        'COL_FK_LOCALE' => 'FK_LOCALE',
        'fk_locale' => 'FK_LOCALE',
        'spy_product_label_localized_attributes.fk_locale' => 'FK_LOCALE',
        'FkProductLabel' => 'FK_PRODUCT_LABEL',
        'SpyProductLabelLocalizedAttributes.FkProductLabel' => 'FK_PRODUCT_LABEL',
        'fkProductLabel' => 'FK_PRODUCT_LABEL',
        'spyProductLabelLocalizedAttributes.fkProductLabel' => 'FK_PRODUCT_LABEL',
        'SpyProductLabelLocalizedAttributesTableMap::COL_FK_PRODUCT_LABEL' => 'FK_PRODUCT_LABEL',
        'COL_FK_PRODUCT_LABEL' => 'FK_PRODUCT_LABEL',
        'fk_product_label' => 'FK_PRODUCT_LABEL',
        'spy_product_label_localized_attributes.fk_product_label' => 'FK_PRODUCT_LABEL',
        'Name' => 'NAME',
        'SpyProductLabelLocalizedAttributes.Name' => 'NAME',
        'name' => 'NAME',
        'spyProductLabelLocalizedAttributes.name' => 'NAME',
        'SpyProductLabelLocalizedAttributesTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_product_label_localized_attributes.name' => 'NAME',
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
        $this->setName('spy_product_label_localized_attributes');
        $this->setPhpName('SpyProductLabelLocalizedAttributes');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ProductLabel\\Persistence\\SpyProductLabelLocalizedAttributes');
        $this->setPackage('src.Orm.Zed.ProductLabel.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_label_localized_attributes_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_label_localized_attributes', 'IdProductLabelLocalizedAttributes', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_locale', 'FkLocale', 'INTEGER', 'spy_locale', 'id_locale', true, null, null);
        $this->addForeignKey('fk_product_label', 'FkProductLabel', 'INTEGER', 'spy_product_label', 'id_product_label', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('SpyProductLabel', '\\Orm\\Zed\\ProductLabel\\Persistence\\SpyProductLabel', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_label',
    1 => ':id_product_label',
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
            'event' => ['spy_product_label_localized_attributes_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductLabelLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductLabelLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductLabelLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductLabelLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductLabelLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductLabelLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductLabelLocalizedAttributes', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductLabelLocalizedAttributesTableMap::CLASS_DEFAULT : SpyProductLabelLocalizedAttributesTableMap::OM_CLASS;
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
     * @return array (SpyProductLabelLocalizedAttributes object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductLabelLocalizedAttributesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductLabelLocalizedAttributesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductLabelLocalizedAttributesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductLabelLocalizedAttributesTableMap::OM_CLASS;
            /** @var SpyProductLabelLocalizedAttributes $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductLabelLocalizedAttributesTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductLabelLocalizedAttributesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductLabelLocalizedAttributesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductLabelLocalizedAttributes $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductLabelLocalizedAttributesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductLabelLocalizedAttributesTableMap::COL_ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES);
            $criteria->addSelectColumn(SpyProductLabelLocalizedAttributesTableMap::COL_FK_LOCALE);
            $criteria->addSelectColumn(SpyProductLabelLocalizedAttributesTableMap::COL_FK_PRODUCT_LABEL);
            $criteria->addSelectColumn(SpyProductLabelLocalizedAttributesTableMap::COL_NAME);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_label_localized_attributes');
            $criteria->addSelectColumn($alias . '.fk_locale');
            $criteria->addSelectColumn($alias . '.fk_product_label');
            $criteria->addSelectColumn($alias . '.name');
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
            $criteria->removeSelectColumn(SpyProductLabelLocalizedAttributesTableMap::COL_ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES);
            $criteria->removeSelectColumn(SpyProductLabelLocalizedAttributesTableMap::COL_FK_LOCALE);
            $criteria->removeSelectColumn(SpyProductLabelLocalizedAttributesTableMap::COL_FK_PRODUCT_LABEL);
            $criteria->removeSelectColumn(SpyProductLabelLocalizedAttributesTableMap::COL_NAME);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_label_localized_attributes');
            $criteria->removeSelectColumn($alias . '.fk_locale');
            $criteria->removeSelectColumn($alias . '.fk_product_label');
            $criteria->removeSelectColumn($alias . '.name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductLabelLocalizedAttributesTableMap::DATABASE_NAME)->getTable(SpyProductLabelLocalizedAttributesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductLabelLocalizedAttributes or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductLabelLocalizedAttributes object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductLabelLocalizedAttributesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductLabel\Persistence\SpyProductLabelLocalizedAttributes) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductLabelLocalizedAttributesTableMap::DATABASE_NAME);
            $criteria->add(SpyProductLabelLocalizedAttributesTableMap::COL_ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES, (array) $values, Criteria::IN);
        }

        $query = SpyProductLabelLocalizedAttributesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductLabelLocalizedAttributesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductLabelLocalizedAttributesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_label_localized_attributes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductLabelLocalizedAttributesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductLabelLocalizedAttributes or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductLabelLocalizedAttributes object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductLabelLocalizedAttributesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductLabelLocalizedAttributes object
        }

        if ($criteria->containsKey(SpyProductLabelLocalizedAttributesTableMap::COL_ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES) && $criteria->keyContainsValue(SpyProductLabelLocalizedAttributesTableMap::COL_ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyProductLabelLocalizedAttributesTableMap::COL_ID_PRODUCT_LABEL_LOCALIZED_ATTRIBUTES.')');
        }


        // Set the correct dbName
        $query = SpyProductLabelLocalizedAttributesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
