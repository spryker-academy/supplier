<?php

namespace Orm\Zed\ProductOfferValidity\Persistence\Map;

use Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidity;
use Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidityQuery;
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
 * This class defines the structure of the 'spy_product_offer_validity' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductOfferValidityTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductOfferValidity.Persistence.Map.SpyProductOfferValidityTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_offer_validity';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductOfferValidity';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductOfferValidity\\Persistence\\SpyProductOfferValidity';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductOfferValidity.Persistence.SpyProductOfferValidity';

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
     * the column name for the id_product_offer_validity field
     */
    public const COL_ID_PRODUCT_OFFER_VALIDITY = 'spy_product_offer_validity.id_product_offer_validity';

    /**
     * the column name for the fk_product_offer field
     */
    public const COL_FK_PRODUCT_OFFER = 'spy_product_offer_validity.fk_product_offer';

    /**
     * the column name for the valid_from field
     */
    public const COL_VALID_FROM = 'spy_product_offer_validity.valid_from';

    /**
     * the column name for the valid_to field
     */
    public const COL_VALID_TO = 'spy_product_offer_validity.valid_to';

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
        self::TYPE_PHPNAME       => ['IdProductOfferValidity', 'FkProductOffer', 'ValidFrom', 'ValidTo', ],
        self::TYPE_CAMELNAME     => ['idProductOfferValidity', 'fkProductOffer', 'validFrom', 'validTo', ],
        self::TYPE_COLNAME       => [SpyProductOfferValidityTableMap::COL_ID_PRODUCT_OFFER_VALIDITY, SpyProductOfferValidityTableMap::COL_FK_PRODUCT_OFFER, SpyProductOfferValidityTableMap::COL_VALID_FROM, SpyProductOfferValidityTableMap::COL_VALID_TO, ],
        self::TYPE_FIELDNAME     => ['id_product_offer_validity', 'fk_product_offer', 'valid_from', 'valid_to', ],
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
        self::TYPE_PHPNAME       => ['IdProductOfferValidity' => 0, 'FkProductOffer' => 1, 'ValidFrom' => 2, 'ValidTo' => 3, ],
        self::TYPE_CAMELNAME     => ['idProductOfferValidity' => 0, 'fkProductOffer' => 1, 'validFrom' => 2, 'validTo' => 3, ],
        self::TYPE_COLNAME       => [SpyProductOfferValidityTableMap::COL_ID_PRODUCT_OFFER_VALIDITY => 0, SpyProductOfferValidityTableMap::COL_FK_PRODUCT_OFFER => 1, SpyProductOfferValidityTableMap::COL_VALID_FROM => 2, SpyProductOfferValidityTableMap::COL_VALID_TO => 3, ],
        self::TYPE_FIELDNAME     => ['id_product_offer_validity' => 0, 'fk_product_offer' => 1, 'valid_from' => 2, 'valid_to' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductOfferValidity' => 'ID_PRODUCT_OFFER_VALIDITY',
        'SpyProductOfferValidity.IdProductOfferValidity' => 'ID_PRODUCT_OFFER_VALIDITY',
        'idProductOfferValidity' => 'ID_PRODUCT_OFFER_VALIDITY',
        'spyProductOfferValidity.idProductOfferValidity' => 'ID_PRODUCT_OFFER_VALIDITY',
        'SpyProductOfferValidityTableMap::COL_ID_PRODUCT_OFFER_VALIDITY' => 'ID_PRODUCT_OFFER_VALIDITY',
        'COL_ID_PRODUCT_OFFER_VALIDITY' => 'ID_PRODUCT_OFFER_VALIDITY',
        'id_product_offer_validity' => 'ID_PRODUCT_OFFER_VALIDITY',
        'spy_product_offer_validity.id_product_offer_validity' => 'ID_PRODUCT_OFFER_VALIDITY',
        'FkProductOffer' => 'FK_PRODUCT_OFFER',
        'SpyProductOfferValidity.FkProductOffer' => 'FK_PRODUCT_OFFER',
        'fkProductOffer' => 'FK_PRODUCT_OFFER',
        'spyProductOfferValidity.fkProductOffer' => 'FK_PRODUCT_OFFER',
        'SpyProductOfferValidityTableMap::COL_FK_PRODUCT_OFFER' => 'FK_PRODUCT_OFFER',
        'COL_FK_PRODUCT_OFFER' => 'FK_PRODUCT_OFFER',
        'fk_product_offer' => 'FK_PRODUCT_OFFER',
        'spy_product_offer_validity.fk_product_offer' => 'FK_PRODUCT_OFFER',
        'ValidFrom' => 'VALID_FROM',
        'SpyProductOfferValidity.ValidFrom' => 'VALID_FROM',
        'validFrom' => 'VALID_FROM',
        'spyProductOfferValidity.validFrom' => 'VALID_FROM',
        'SpyProductOfferValidityTableMap::COL_VALID_FROM' => 'VALID_FROM',
        'COL_VALID_FROM' => 'VALID_FROM',
        'valid_from' => 'VALID_FROM',
        'spy_product_offer_validity.valid_from' => 'VALID_FROM',
        'ValidTo' => 'VALID_TO',
        'SpyProductOfferValidity.ValidTo' => 'VALID_TO',
        'validTo' => 'VALID_TO',
        'spyProductOfferValidity.validTo' => 'VALID_TO',
        'SpyProductOfferValidityTableMap::COL_VALID_TO' => 'VALID_TO',
        'COL_VALID_TO' => 'VALID_TO',
        'valid_to' => 'VALID_TO',
        'spy_product_offer_validity.valid_to' => 'VALID_TO',
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
        $this->setName('spy_product_offer_validity');
        $this->setPhpName('SpyProductOfferValidity');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ProductOfferValidity\\Persistence\\SpyProductOfferValidity');
        $this->setPackage('src.Orm.Zed.ProductOfferValidity.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_offer_validity_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_offer_validity', 'IdProductOfferValidity', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_product_offer', 'FkProductOffer', 'INTEGER', 'spy_product_offer', 'id_product_offer', true, null, null);
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
        $this->addRelation('SpyProductOffer', '\\Orm\\Zed\\ProductOffer\\Persistence\\SpyProductOffer', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_offer',
    1 => ':id_product_offer',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOfferValidity', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOfferValidity', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOfferValidity', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOfferValidity', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOfferValidity', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductOfferValidity', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductOfferValidity', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductOfferValidityTableMap::CLASS_DEFAULT : SpyProductOfferValidityTableMap::OM_CLASS;
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
     * @return array (SpyProductOfferValidity object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductOfferValidityTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductOfferValidityTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductOfferValidityTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductOfferValidityTableMap::OM_CLASS;
            /** @var SpyProductOfferValidity $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductOfferValidityTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductOfferValidityTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductOfferValidityTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductOfferValidity $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductOfferValidityTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductOfferValidityTableMap::COL_ID_PRODUCT_OFFER_VALIDITY);
            $criteria->addSelectColumn(SpyProductOfferValidityTableMap::COL_FK_PRODUCT_OFFER);
            $criteria->addSelectColumn(SpyProductOfferValidityTableMap::COL_VALID_FROM);
            $criteria->addSelectColumn(SpyProductOfferValidityTableMap::COL_VALID_TO);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_offer_validity');
            $criteria->addSelectColumn($alias . '.fk_product_offer');
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
            $criteria->removeSelectColumn(SpyProductOfferValidityTableMap::COL_ID_PRODUCT_OFFER_VALIDITY);
            $criteria->removeSelectColumn(SpyProductOfferValidityTableMap::COL_FK_PRODUCT_OFFER);
            $criteria->removeSelectColumn(SpyProductOfferValidityTableMap::COL_VALID_FROM);
            $criteria->removeSelectColumn(SpyProductOfferValidityTableMap::COL_VALID_TO);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_offer_validity');
            $criteria->removeSelectColumn($alias . '.fk_product_offer');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductOfferValidityTableMap::DATABASE_NAME)->getTable(SpyProductOfferValidityTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductOfferValidity or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductOfferValidity object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOfferValidityTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductOfferValidity\Persistence\SpyProductOfferValidity) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductOfferValidityTableMap::DATABASE_NAME);
            $criteria->add(SpyProductOfferValidityTableMap::COL_ID_PRODUCT_OFFER_VALIDITY, (array) $values, Criteria::IN);
        }

        $query = SpyProductOfferValidityQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductOfferValidityTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductOfferValidityTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_offer_validity table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductOfferValidityQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductOfferValidity or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductOfferValidity object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductOfferValidityTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductOfferValidity object
        }


        // Set the correct dbName
        $query = SpyProductOfferValidityQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
