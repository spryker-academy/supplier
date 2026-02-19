<?php

namespace Orm\Zed\DiscountPromotion\Persistence\Map;

use Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotion;
use Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotionQuery;
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
 * This class defines the structure of the 'spy_discount_promotion' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyDiscountPromotionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.DiscountPromotion.Persistence.Map.SpyDiscountPromotionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_discount_promotion';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyDiscountPromotion';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\DiscountPromotion\\Persistence\\SpyDiscountPromotion';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.DiscountPromotion.Persistence.SpyDiscountPromotion';

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
     * the column name for the id_discount_promotion field
     */
    public const COL_ID_DISCOUNT_PROMOTION = 'spy_discount_promotion.id_discount_promotion';

    /**
     * the column name for the fk_discount field
     */
    public const COL_FK_DISCOUNT = 'spy_discount_promotion.fk_discount';

    /**
     * the column name for the abstract_sku field
     */
    public const COL_ABSTRACT_SKU = 'spy_discount_promotion.abstract_sku';

    /**
     * the column name for the abstract_skus field
     */
    public const COL_ABSTRACT_SKUS = 'spy_discount_promotion.abstract_skus';

    /**
     * the column name for the quantity field
     */
    public const COL_QUANTITY = 'spy_discount_promotion.quantity';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_discount_promotion.uuid';

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
        self::TYPE_PHPNAME       => ['IdDiscountPromotion', 'FkDiscount', 'AbstractSku', 'AbstractSkus', 'Quantity', 'Uuid', ],
        self::TYPE_CAMELNAME     => ['idDiscountPromotion', 'fkDiscount', 'abstractSku', 'abstractSkus', 'quantity', 'uuid', ],
        self::TYPE_COLNAME       => [SpyDiscountPromotionTableMap::COL_ID_DISCOUNT_PROMOTION, SpyDiscountPromotionTableMap::COL_FK_DISCOUNT, SpyDiscountPromotionTableMap::COL_ABSTRACT_SKU, SpyDiscountPromotionTableMap::COL_ABSTRACT_SKUS, SpyDiscountPromotionTableMap::COL_QUANTITY, SpyDiscountPromotionTableMap::COL_UUID, ],
        self::TYPE_FIELDNAME     => ['id_discount_promotion', 'fk_discount', 'abstract_sku', 'abstract_skus', 'quantity', 'uuid', ],
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
        self::TYPE_PHPNAME       => ['IdDiscountPromotion' => 0, 'FkDiscount' => 1, 'AbstractSku' => 2, 'AbstractSkus' => 3, 'Quantity' => 4, 'Uuid' => 5, ],
        self::TYPE_CAMELNAME     => ['idDiscountPromotion' => 0, 'fkDiscount' => 1, 'abstractSku' => 2, 'abstractSkus' => 3, 'quantity' => 4, 'uuid' => 5, ],
        self::TYPE_COLNAME       => [SpyDiscountPromotionTableMap::COL_ID_DISCOUNT_PROMOTION => 0, SpyDiscountPromotionTableMap::COL_FK_DISCOUNT => 1, SpyDiscountPromotionTableMap::COL_ABSTRACT_SKU => 2, SpyDiscountPromotionTableMap::COL_ABSTRACT_SKUS => 3, SpyDiscountPromotionTableMap::COL_QUANTITY => 4, SpyDiscountPromotionTableMap::COL_UUID => 5, ],
        self::TYPE_FIELDNAME     => ['id_discount_promotion' => 0, 'fk_discount' => 1, 'abstract_sku' => 2, 'abstract_skus' => 3, 'quantity' => 4, 'uuid' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdDiscountPromotion' => 'ID_DISCOUNT_PROMOTION',
        'SpyDiscountPromotion.IdDiscountPromotion' => 'ID_DISCOUNT_PROMOTION',
        'idDiscountPromotion' => 'ID_DISCOUNT_PROMOTION',
        'spyDiscountPromotion.idDiscountPromotion' => 'ID_DISCOUNT_PROMOTION',
        'SpyDiscountPromotionTableMap::COL_ID_DISCOUNT_PROMOTION' => 'ID_DISCOUNT_PROMOTION',
        'COL_ID_DISCOUNT_PROMOTION' => 'ID_DISCOUNT_PROMOTION',
        'id_discount_promotion' => 'ID_DISCOUNT_PROMOTION',
        'spy_discount_promotion.id_discount_promotion' => 'ID_DISCOUNT_PROMOTION',
        'FkDiscount' => 'FK_DISCOUNT',
        'SpyDiscountPromotion.FkDiscount' => 'FK_DISCOUNT',
        'fkDiscount' => 'FK_DISCOUNT',
        'spyDiscountPromotion.fkDiscount' => 'FK_DISCOUNT',
        'SpyDiscountPromotionTableMap::COL_FK_DISCOUNT' => 'FK_DISCOUNT',
        'COL_FK_DISCOUNT' => 'FK_DISCOUNT',
        'fk_discount' => 'FK_DISCOUNT',
        'spy_discount_promotion.fk_discount' => 'FK_DISCOUNT',
        'AbstractSku' => 'ABSTRACT_SKU',
        'SpyDiscountPromotion.AbstractSku' => 'ABSTRACT_SKU',
        'abstractSku' => 'ABSTRACT_SKU',
        'spyDiscountPromotion.abstractSku' => 'ABSTRACT_SKU',
        'SpyDiscountPromotionTableMap::COL_ABSTRACT_SKU' => 'ABSTRACT_SKU',
        'COL_ABSTRACT_SKU' => 'ABSTRACT_SKU',
        'abstract_sku' => 'ABSTRACT_SKU',
        'spy_discount_promotion.abstract_sku' => 'ABSTRACT_SKU',
        'AbstractSkus' => 'ABSTRACT_SKUS',
        'SpyDiscountPromotion.AbstractSkus' => 'ABSTRACT_SKUS',
        'abstractSkus' => 'ABSTRACT_SKUS',
        'spyDiscountPromotion.abstractSkus' => 'ABSTRACT_SKUS',
        'SpyDiscountPromotionTableMap::COL_ABSTRACT_SKUS' => 'ABSTRACT_SKUS',
        'COL_ABSTRACT_SKUS' => 'ABSTRACT_SKUS',
        'abstract_skus' => 'ABSTRACT_SKUS',
        'spy_discount_promotion.abstract_skus' => 'ABSTRACT_SKUS',
        'Quantity' => 'QUANTITY',
        'SpyDiscountPromotion.Quantity' => 'QUANTITY',
        'quantity' => 'QUANTITY',
        'spyDiscountPromotion.quantity' => 'QUANTITY',
        'SpyDiscountPromotionTableMap::COL_QUANTITY' => 'QUANTITY',
        'COL_QUANTITY' => 'QUANTITY',
        'spy_discount_promotion.quantity' => 'QUANTITY',
        'Uuid' => 'UUID',
        'SpyDiscountPromotion.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyDiscountPromotion.uuid' => 'UUID',
        'SpyDiscountPromotionTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_discount_promotion.uuid' => 'UUID',
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
        $this->setName('spy_discount_promotion');
        $this->setPhpName('SpyDiscountPromotion');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\DiscountPromotion\\Persistence\\SpyDiscountPromotion');
        $this->setPackage('src.Orm.Zed.DiscountPromotion.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_discount_promotion_pk_seq');
        // columns
        $this->addPrimaryKey('id_discount_promotion', 'IdDiscountPromotion', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_discount', 'FkDiscount', 'INTEGER', 'spy_discount', 'id_discount', true, null, null);
        $this->addColumn('abstract_sku', 'AbstractSku', 'VARCHAR', true, 255, null);
        $this->addColumn('abstract_skus', 'AbstractSkus', 'LONGVARCHAR', false, null, null);
        $this->addColumn('quantity', 'Quantity', 'INTEGER', true, null, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Discount', '\\Orm\\Zed\\Discount\\Persistence\\SpyDiscount', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_discount',
    1 => ':id_discount',
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'fk_discount.abstract_sku.quantity'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountPromotion', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountPromotion', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountPromotion', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountPromotion', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountPromotion', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountPromotion', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdDiscountPromotion', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyDiscountPromotionTableMap::CLASS_DEFAULT : SpyDiscountPromotionTableMap::OM_CLASS;
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
     * @return array (SpyDiscountPromotion object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyDiscountPromotionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyDiscountPromotionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyDiscountPromotionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyDiscountPromotionTableMap::OM_CLASS;
            /** @var SpyDiscountPromotion $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyDiscountPromotionTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyDiscountPromotionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyDiscountPromotionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyDiscountPromotion $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyDiscountPromotionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyDiscountPromotionTableMap::COL_ID_DISCOUNT_PROMOTION);
            $criteria->addSelectColumn(SpyDiscountPromotionTableMap::COL_FK_DISCOUNT);
            $criteria->addSelectColumn(SpyDiscountPromotionTableMap::COL_ABSTRACT_SKU);
            $criteria->addSelectColumn(SpyDiscountPromotionTableMap::COL_ABSTRACT_SKUS);
            $criteria->addSelectColumn(SpyDiscountPromotionTableMap::COL_QUANTITY);
            $criteria->addSelectColumn(SpyDiscountPromotionTableMap::COL_UUID);
        } else {
            $criteria->addSelectColumn($alias . '.id_discount_promotion');
            $criteria->addSelectColumn($alias . '.fk_discount');
            $criteria->addSelectColumn($alias . '.abstract_sku');
            $criteria->addSelectColumn($alias . '.abstract_skus');
            $criteria->addSelectColumn($alias . '.quantity');
            $criteria->addSelectColumn($alias . '.uuid');
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
            $criteria->removeSelectColumn(SpyDiscountPromotionTableMap::COL_ID_DISCOUNT_PROMOTION);
            $criteria->removeSelectColumn(SpyDiscountPromotionTableMap::COL_FK_DISCOUNT);
            $criteria->removeSelectColumn(SpyDiscountPromotionTableMap::COL_ABSTRACT_SKU);
            $criteria->removeSelectColumn(SpyDiscountPromotionTableMap::COL_ABSTRACT_SKUS);
            $criteria->removeSelectColumn(SpyDiscountPromotionTableMap::COL_QUANTITY);
            $criteria->removeSelectColumn(SpyDiscountPromotionTableMap::COL_UUID);
        } else {
            $criteria->removeSelectColumn($alias . '.id_discount_promotion');
            $criteria->removeSelectColumn($alias . '.fk_discount');
            $criteria->removeSelectColumn($alias . '.abstract_sku');
            $criteria->removeSelectColumn($alias . '.abstract_skus');
            $criteria->removeSelectColumn($alias . '.quantity');
            $criteria->removeSelectColumn($alias . '.uuid');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyDiscountPromotionTableMap::DATABASE_NAME)->getTable(SpyDiscountPromotionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyDiscountPromotion or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyDiscountPromotion object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDiscountPromotionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\DiscountPromotion\Persistence\SpyDiscountPromotion) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyDiscountPromotionTableMap::DATABASE_NAME);
            $criteria->add(SpyDiscountPromotionTableMap::COL_ID_DISCOUNT_PROMOTION, (array) $values, Criteria::IN);
        }

        $query = SpyDiscountPromotionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyDiscountPromotionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyDiscountPromotionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_discount_promotion table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyDiscountPromotionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyDiscountPromotion or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyDiscountPromotion object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDiscountPromotionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyDiscountPromotion object
        }


        // Set the correct dbName
        $query = SpyDiscountPromotionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
