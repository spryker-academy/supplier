<?php

namespace Orm\Zed\ProductOption\Persistence\Map;

use Orm\Zed\MerchantProductOption\Persistence\Map\SpyMerchantProductOptionGroupTableMap;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionGroup;
use Orm\Zed\ProductOption\Persistence\SpyProductOptionGroupQuery;
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
 * This class defines the structure of the 'spy_product_option_group' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductOptionGroupTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductOption.Persistence.Map.SpyProductOptionGroupTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_option_group';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductOptionGroup';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductOption\\Persistence\\SpyProductOptionGroup';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductOption.Persistence.SpyProductOptionGroup';

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
     * the column name for the id_product_option_group field
     */
    public const COL_ID_PRODUCT_OPTION_GROUP = 'spy_product_option_group.id_product_option_group';

    /**
     * the column name for the fk_tax_set field
     */
    public const COL_FK_TAX_SET = 'spy_product_option_group.fk_tax_set';

    /**
     * the column name for the active field
     */
    public const COL_ACTIVE = 'spy_product_option_group.active';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_product_option_group.key';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_product_option_group.name';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_option_group.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_option_group.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductOptionGroup', 'FkTaxSet', 'Active', 'Key', 'Name', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductOptionGroup', 'fkTaxSet', 'active', 'key', 'name', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP, SpyProductOptionGroupTableMap::COL_FK_TAX_SET, SpyProductOptionGroupTableMap::COL_ACTIVE, SpyProductOptionGroupTableMap::COL_KEY, SpyProductOptionGroupTableMap::COL_NAME, SpyProductOptionGroupTableMap::COL_CREATED_AT, SpyProductOptionGroupTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_option_group', 'fk_tax_set', 'active', 'key', 'name', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProductOptionGroup' => 0, 'FkTaxSet' => 1, 'Active' => 2, 'Key' => 3, 'Name' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idProductOptionGroup' => 0, 'fkTaxSet' => 1, 'active' => 2, 'key' => 3, 'name' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP => 0, SpyProductOptionGroupTableMap::COL_FK_TAX_SET => 1, SpyProductOptionGroupTableMap::COL_ACTIVE => 2, SpyProductOptionGroupTableMap::COL_KEY => 3, SpyProductOptionGroupTableMap::COL_NAME => 4, SpyProductOptionGroupTableMap::COL_CREATED_AT => 5, SpyProductOptionGroupTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_product_option_group' => 0, 'fk_tax_set' => 1, 'active' => 2, 'key' => 3, 'name' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductOptionGroup' => 'ID_PRODUCT_OPTION_GROUP',
        'SpyProductOptionGroup.IdProductOptionGroup' => 'ID_PRODUCT_OPTION_GROUP',
        'idProductOptionGroup' => 'ID_PRODUCT_OPTION_GROUP',
        'spyProductOptionGroup.idProductOptionGroup' => 'ID_PRODUCT_OPTION_GROUP',
        'SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP' => 'ID_PRODUCT_OPTION_GROUP',
        'COL_ID_PRODUCT_OPTION_GROUP' => 'ID_PRODUCT_OPTION_GROUP',
        'id_product_option_group' => 'ID_PRODUCT_OPTION_GROUP',
        'spy_product_option_group.id_product_option_group' => 'ID_PRODUCT_OPTION_GROUP',
        'FkTaxSet' => 'FK_TAX_SET',
        'SpyProductOptionGroup.FkTaxSet' => 'FK_TAX_SET',
        'fkTaxSet' => 'FK_TAX_SET',
        'spyProductOptionGroup.fkTaxSet' => 'FK_TAX_SET',
        'SpyProductOptionGroupTableMap::COL_FK_TAX_SET' => 'FK_TAX_SET',
        'COL_FK_TAX_SET' => 'FK_TAX_SET',
        'fk_tax_set' => 'FK_TAX_SET',
        'spy_product_option_group.fk_tax_set' => 'FK_TAX_SET',
        'Active' => 'ACTIVE',
        'SpyProductOptionGroup.Active' => 'ACTIVE',
        'active' => 'ACTIVE',
        'spyProductOptionGroup.active' => 'ACTIVE',
        'SpyProductOptionGroupTableMap::COL_ACTIVE' => 'ACTIVE',
        'COL_ACTIVE' => 'ACTIVE',
        'spy_product_option_group.active' => 'ACTIVE',
        'Key' => 'KEY',
        'SpyProductOptionGroup.Key' => 'KEY',
        'key' => 'KEY',
        'spyProductOptionGroup.key' => 'KEY',
        'SpyProductOptionGroupTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_product_option_group.key' => 'KEY',
        'Name' => 'NAME',
        'SpyProductOptionGroup.Name' => 'NAME',
        'name' => 'NAME',
        'spyProductOptionGroup.name' => 'NAME',
        'SpyProductOptionGroupTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_product_option_group.name' => 'NAME',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductOptionGroup.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductOptionGroup.createdAt' => 'CREATED_AT',
        'SpyProductOptionGroupTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_option_group.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductOptionGroup.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductOptionGroup.updatedAt' => 'UPDATED_AT',
        'SpyProductOptionGroupTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_option_group.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_option_group');
        $this->setPhpName('SpyProductOptionGroup');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ProductOption\\Persistence\\SpyProductOptionGroup');
        $this->setPackage('src.Orm.Zed.ProductOption.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_option_group_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_option_group', 'IdProductOptionGroup', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_tax_set', 'FkTaxSet', 'INTEGER', 'spy_tax_set', 'id_tax_set', false, null, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', false, 1, null);
        $this->addColumn('key', 'Key', 'VARCHAR', false, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
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
        $this->addRelation('SpyTaxSet', '\\Orm\\Zed\\Tax\\Persistence\\SpyTaxSet', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_tax_set',
    1 => ':id_tax_set',
  ),
), 'SET NULL', null, null, false);
        $this->addRelation('SpyMerchantProductOptionGroup', '\\Orm\\Zed\\MerchantProductOption\\Persistence\\SpyMerchantProductOptionGroup', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_option_group',
    1 => ':id_product_option_group',
  ),
), 'CASCADE', null, 'SpyMerchantProductOptionGroups', false);
        $this->addRelation('SpyProductAbstractProductOptionGroup', '\\Orm\\Zed\\ProductOption\\Persistence\\SpyProductAbstractProductOptionGroup', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_option_group',
    1 => ':id_product_option_group',
  ),
), null, null, 'SpyProductAbstractProductOptionGroups', false);
        $this->addRelation('SpyProductOptionValue', '\\Orm\\Zed\\ProductOption\\Persistence\\SpyProductOptionValue', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_option_group',
    1 => ':id_product_option_group',
  ),
), null, null, 'SpyProductOptionValues', false);
        $this->addRelation('SpyProductAbstract', '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstract', RelationMap::MANY_TO_MANY, array(), null, null, 'SpyProductAbstracts');
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
            'event' => ['spy_product_option_group_all' => ['column' => '*']],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_product_option_group     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyMerchantProductOptionGroupTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOptionGroup', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOptionGroup', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOptionGroup', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOptionGroup', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOptionGroup', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOptionGroup', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductOptionGroup', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductOptionGroupTableMap::CLASS_DEFAULT : SpyProductOptionGroupTableMap::OM_CLASS;
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
     * @return array (SpyProductOptionGroup object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductOptionGroupTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductOptionGroupTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductOptionGroupTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductOptionGroupTableMap::OM_CLASS;
            /** @var SpyProductOptionGroup $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductOptionGroupTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductOptionGroupTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductOptionGroupTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductOptionGroup $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductOptionGroupTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP);
            $criteria->addSelectColumn(SpyProductOptionGroupTableMap::COL_FK_TAX_SET);
            $criteria->addSelectColumn(SpyProductOptionGroupTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(SpyProductOptionGroupTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyProductOptionGroupTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyProductOptionGroupTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductOptionGroupTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_option_group');
            $criteria->addSelectColumn($alias . '.fk_tax_set');
            $criteria->addSelectColumn($alias . '.active');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.name');
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
            $criteria->removeSelectColumn(SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP);
            $criteria->removeSelectColumn(SpyProductOptionGroupTableMap::COL_FK_TAX_SET);
            $criteria->removeSelectColumn(SpyProductOptionGroupTableMap::COL_ACTIVE);
            $criteria->removeSelectColumn(SpyProductOptionGroupTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyProductOptionGroupTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyProductOptionGroupTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductOptionGroupTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_option_group');
            $criteria->removeSelectColumn($alias . '.fk_tax_set');
            $criteria->removeSelectColumn($alias . '.active');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductOptionGroupTableMap::DATABASE_NAME)->getTable(SpyProductOptionGroupTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductOptionGroup or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductOptionGroup object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOptionGroupTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductOption\Persistence\SpyProductOptionGroup) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductOptionGroupTableMap::DATABASE_NAME);
            $criteria->add(SpyProductOptionGroupTableMap::COL_ID_PRODUCT_OPTION_GROUP, (array) $values, Criteria::IN);
        }

        $query = SpyProductOptionGroupQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductOptionGroupTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductOptionGroupTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_option_group table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductOptionGroupQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductOptionGroup or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductOptionGroup object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOptionGroupTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductOptionGroup object
        }


        // Set the correct dbName
        $query = SpyProductOptionGroupQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
