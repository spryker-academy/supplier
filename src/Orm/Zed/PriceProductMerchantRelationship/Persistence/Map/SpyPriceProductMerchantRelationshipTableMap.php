<?php

namespace Orm\Zed\PriceProductMerchantRelationship\Persistence\Map;

use Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationship;
use Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationshipQuery;
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
 * This class defines the structure of the 'spy_price_product_merchant_relationship' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyPriceProductMerchantRelationshipTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.PriceProductMerchantRelationship.Persistence.Map.SpyPriceProductMerchantRelationshipTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_price_product_merchant_relationship';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyPriceProductMerchantRelationship';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\PriceProductMerchantRelationship\\Persistence\\SpyPriceProductMerchantRelationship';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.PriceProductMerchantRelationship.Persistence.SpyPriceProductMerchantRelationship';

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
     * the column name for the id_price_product_merchant_relationship field
     */
    public const COL_ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP = 'spy_price_product_merchant_relationship.id_price_product_merchant_relationship';

    /**
     * the column name for the fk_merchant_relationship field
     */
    public const COL_FK_MERCHANT_RELATIONSHIP = 'spy_price_product_merchant_relationship.fk_merchant_relationship';

    /**
     * the column name for the fk_price_product_store field
     */
    public const COL_FK_PRICE_PRODUCT_STORE = 'spy_price_product_merchant_relationship.fk_price_product_store';

    /**
     * the column name for the fk_product field
     */
    public const COL_FK_PRODUCT = 'spy_price_product_merchant_relationship.fk_product';

    /**
     * the column name for the fk_product_abstract field
     */
    public const COL_FK_PRODUCT_ABSTRACT = 'spy_price_product_merchant_relationship.fk_product_abstract';

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
        self::TYPE_PHPNAME       => ['IdPriceProductMerchantRelationship', 'FkMerchantRelationship', 'FkPriceProductStore', 'FkProduct', 'FkProductAbstract', ],
        self::TYPE_CAMELNAME     => ['idPriceProductMerchantRelationship', 'fkMerchantRelationship', 'fkPriceProductStore', 'fkProduct', 'fkProductAbstract', ],
        self::TYPE_COLNAME       => [SpyPriceProductMerchantRelationshipTableMap::COL_ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP, SpyPriceProductMerchantRelationshipTableMap::COL_FK_MERCHANT_RELATIONSHIP, SpyPriceProductMerchantRelationshipTableMap::COL_FK_PRICE_PRODUCT_STORE, SpyPriceProductMerchantRelationshipTableMap::COL_FK_PRODUCT, SpyPriceProductMerchantRelationshipTableMap::COL_FK_PRODUCT_ABSTRACT, ],
        self::TYPE_FIELDNAME     => ['id_price_product_merchant_relationship', 'fk_merchant_relationship', 'fk_price_product_store', 'fk_product', 'fk_product_abstract', ],
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
        self::TYPE_PHPNAME       => ['IdPriceProductMerchantRelationship' => 0, 'FkMerchantRelationship' => 1, 'FkPriceProductStore' => 2, 'FkProduct' => 3, 'FkProductAbstract' => 4, ],
        self::TYPE_CAMELNAME     => ['idPriceProductMerchantRelationship' => 0, 'fkMerchantRelationship' => 1, 'fkPriceProductStore' => 2, 'fkProduct' => 3, 'fkProductAbstract' => 4, ],
        self::TYPE_COLNAME       => [SpyPriceProductMerchantRelationshipTableMap::COL_ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP => 0, SpyPriceProductMerchantRelationshipTableMap::COL_FK_MERCHANT_RELATIONSHIP => 1, SpyPriceProductMerchantRelationshipTableMap::COL_FK_PRICE_PRODUCT_STORE => 2, SpyPriceProductMerchantRelationshipTableMap::COL_FK_PRODUCT => 3, SpyPriceProductMerchantRelationshipTableMap::COL_FK_PRODUCT_ABSTRACT => 4, ],
        self::TYPE_FIELDNAME     => ['id_price_product_merchant_relationship' => 0, 'fk_merchant_relationship' => 1, 'fk_price_product_store' => 2, 'fk_product' => 3, 'fk_product_abstract' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdPriceProductMerchantRelationship' => 'ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP',
        'SpyPriceProductMerchantRelationship.IdPriceProductMerchantRelationship' => 'ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP',
        'idPriceProductMerchantRelationship' => 'ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP',
        'spyPriceProductMerchantRelationship.idPriceProductMerchantRelationship' => 'ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP',
        'SpyPriceProductMerchantRelationshipTableMap::COL_ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP' => 'ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP',
        'COL_ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP' => 'ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP',
        'id_price_product_merchant_relationship' => 'ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP',
        'spy_price_product_merchant_relationship.id_price_product_merchant_relationship' => 'ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP',
        'FkMerchantRelationship' => 'FK_MERCHANT_RELATIONSHIP',
        'SpyPriceProductMerchantRelationship.FkMerchantRelationship' => 'FK_MERCHANT_RELATIONSHIP',
        'fkMerchantRelationship' => 'FK_MERCHANT_RELATIONSHIP',
        'spyPriceProductMerchantRelationship.fkMerchantRelationship' => 'FK_MERCHANT_RELATIONSHIP',
        'SpyPriceProductMerchantRelationshipTableMap::COL_FK_MERCHANT_RELATIONSHIP' => 'FK_MERCHANT_RELATIONSHIP',
        'COL_FK_MERCHANT_RELATIONSHIP' => 'FK_MERCHANT_RELATIONSHIP',
        'fk_merchant_relationship' => 'FK_MERCHANT_RELATIONSHIP',
        'spy_price_product_merchant_relationship.fk_merchant_relationship' => 'FK_MERCHANT_RELATIONSHIP',
        'FkPriceProductStore' => 'FK_PRICE_PRODUCT_STORE',
        'SpyPriceProductMerchantRelationship.FkPriceProductStore' => 'FK_PRICE_PRODUCT_STORE',
        'fkPriceProductStore' => 'FK_PRICE_PRODUCT_STORE',
        'spyPriceProductMerchantRelationship.fkPriceProductStore' => 'FK_PRICE_PRODUCT_STORE',
        'SpyPriceProductMerchantRelationshipTableMap::COL_FK_PRICE_PRODUCT_STORE' => 'FK_PRICE_PRODUCT_STORE',
        'COL_FK_PRICE_PRODUCT_STORE' => 'FK_PRICE_PRODUCT_STORE',
        'fk_price_product_store' => 'FK_PRICE_PRODUCT_STORE',
        'spy_price_product_merchant_relationship.fk_price_product_store' => 'FK_PRICE_PRODUCT_STORE',
        'FkProduct' => 'FK_PRODUCT',
        'SpyPriceProductMerchantRelationship.FkProduct' => 'FK_PRODUCT',
        'fkProduct' => 'FK_PRODUCT',
        'spyPriceProductMerchantRelationship.fkProduct' => 'FK_PRODUCT',
        'SpyPriceProductMerchantRelationshipTableMap::COL_FK_PRODUCT' => 'FK_PRODUCT',
        'COL_FK_PRODUCT' => 'FK_PRODUCT',
        'fk_product' => 'FK_PRODUCT',
        'spy_price_product_merchant_relationship.fk_product' => 'FK_PRODUCT',
        'FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyPriceProductMerchantRelationship.FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'spyPriceProductMerchantRelationship.fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyPriceProductMerchantRelationshipTableMap::COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'spy_price_product_merchant_relationship.fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
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
        $this->setName('spy_price_product_merchant_relationship');
        $this->setPhpName('SpyPriceProductMerchantRelationship');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\PriceProductMerchantRelationship\\Persistence\\SpyPriceProductMerchantRelationship');
        $this->setPackage('src.Orm.Zed.PriceProductMerchantRelationship.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_price_product_merchant_relationship_pk_seq');
        // columns
        $this->addPrimaryKey('id_price_product_merchant_relationship', 'IdPriceProductMerchantRelationship', 'BIGINT', true, null, null);
        $this->addForeignKey('fk_merchant_relationship', 'FkMerchantRelationship', 'INTEGER', 'spy_merchant_relationship', 'id_merchant_relationship', true, null, null);
        $this->addForeignKey('fk_price_product_store', 'FkPriceProductStore', 'BIGINT', 'spy_price_product_store', 'id_price_product_store', true, null, null);
        $this->addForeignKey('fk_product', 'FkProduct', 'INTEGER', 'spy_product', 'id_product', false, null, null);
        $this->addForeignKey('fk_product_abstract', 'FkProductAbstract', 'INTEGER', 'spy_product_abstract', 'id_product_abstract', false, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('PriceProductStore', '\\Orm\\Zed\\PriceProduct\\Persistence\\SpyPriceProductStore', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_price_product_store',
    1 => ':id_price_product_store',
  ),
), null, null, null, false);
        $this->addRelation('MerchantRelationship', '\\Orm\\Zed\\MerchantRelationship\\Persistence\\SpyMerchantRelationship', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_merchant_relationship',
    1 => ':id_merchant_relationship',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('Product', '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
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
            'event' => ['spy_price_product_merchant_relationship_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductMerchantRelationship', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductMerchantRelationship', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductMerchantRelationship', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductMerchantRelationship', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductMerchantRelationship', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdPriceProductMerchantRelationship', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdPriceProductMerchantRelationship', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyPriceProductMerchantRelationshipTableMap::CLASS_DEFAULT : SpyPriceProductMerchantRelationshipTableMap::OM_CLASS;
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
     * @return array (SpyPriceProductMerchantRelationship object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyPriceProductMerchantRelationshipTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyPriceProductMerchantRelationshipTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyPriceProductMerchantRelationshipTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyPriceProductMerchantRelationshipTableMap::OM_CLASS;
            /** @var SpyPriceProductMerchantRelationship $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyPriceProductMerchantRelationshipTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyPriceProductMerchantRelationshipTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyPriceProductMerchantRelationshipTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyPriceProductMerchantRelationship $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyPriceProductMerchantRelationshipTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyPriceProductMerchantRelationshipTableMap::COL_ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP);
            $criteria->addSelectColumn(SpyPriceProductMerchantRelationshipTableMap::COL_FK_MERCHANT_RELATIONSHIP);
            $criteria->addSelectColumn(SpyPriceProductMerchantRelationshipTableMap::COL_FK_PRICE_PRODUCT_STORE);
            $criteria->addSelectColumn(SpyPriceProductMerchantRelationshipTableMap::COL_FK_PRODUCT);
            $criteria->addSelectColumn(SpyPriceProductMerchantRelationshipTableMap::COL_FK_PRODUCT_ABSTRACT);
        } else {
            $criteria->addSelectColumn($alias . '.id_price_product_merchant_relationship');
            $criteria->addSelectColumn($alias . '.fk_merchant_relationship');
            $criteria->addSelectColumn($alias . '.fk_price_product_store');
            $criteria->addSelectColumn($alias . '.fk_product');
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
            $criteria->removeSelectColumn(SpyPriceProductMerchantRelationshipTableMap::COL_ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP);
            $criteria->removeSelectColumn(SpyPriceProductMerchantRelationshipTableMap::COL_FK_MERCHANT_RELATIONSHIP);
            $criteria->removeSelectColumn(SpyPriceProductMerchantRelationshipTableMap::COL_FK_PRICE_PRODUCT_STORE);
            $criteria->removeSelectColumn(SpyPriceProductMerchantRelationshipTableMap::COL_FK_PRODUCT);
            $criteria->removeSelectColumn(SpyPriceProductMerchantRelationshipTableMap::COL_FK_PRODUCT_ABSTRACT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_price_product_merchant_relationship');
            $criteria->removeSelectColumn($alias . '.fk_merchant_relationship');
            $criteria->removeSelectColumn($alias . '.fk_price_product_store');
            $criteria->removeSelectColumn($alias . '.fk_product');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyPriceProductMerchantRelationshipTableMap::DATABASE_NAME)->getTable(SpyPriceProductMerchantRelationshipTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyPriceProductMerchantRelationship or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyPriceProductMerchantRelationship object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductMerchantRelationshipTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\PriceProductMerchantRelationship\Persistence\SpyPriceProductMerchantRelationship) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyPriceProductMerchantRelationshipTableMap::DATABASE_NAME);
            $criteria->add(SpyPriceProductMerchantRelationshipTableMap::COL_ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP, (array) $values, Criteria::IN);
        }

        $query = SpyPriceProductMerchantRelationshipQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyPriceProductMerchantRelationshipTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyPriceProductMerchantRelationshipTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_price_product_merchant_relationship table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyPriceProductMerchantRelationshipQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyPriceProductMerchantRelationship or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyPriceProductMerchantRelationship object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyPriceProductMerchantRelationshipTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyPriceProductMerchantRelationship object
        }

        if ($criteria->containsKey(SpyPriceProductMerchantRelationshipTableMap::COL_ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP) && $criteria->keyContainsValue(SpyPriceProductMerchantRelationshipTableMap::COL_ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyPriceProductMerchantRelationshipTableMap::COL_ID_PRICE_PRODUCT_MERCHANT_RELATIONSHIP.')');
        }


        // Set the correct dbName
        $query = SpyPriceProductMerchantRelationshipQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
