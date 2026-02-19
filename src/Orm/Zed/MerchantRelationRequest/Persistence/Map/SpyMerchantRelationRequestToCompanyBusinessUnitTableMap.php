<?php

namespace Orm\Zed\MerchantRelationRequest\Persistence\Map;

use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnit;
use Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnitQuery;
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
 * This class defines the structure of the 'spy_merchant_relation_request_to_company_business_unit' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyMerchantRelationRequestToCompanyBusinessUnitTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.MerchantRelationRequest.Persistence.Map.SpyMerchantRelationRequestToCompanyBusinessUnitTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_merchant_relation_request_to_company_business_unit';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyMerchantRelationRequestToCompanyBusinessUnit';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\MerchantRelationRequest\\Persistence\\SpyMerchantRelationRequestToCompanyBusinessUnit';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.MerchantRelationRequest.Persistence.SpyMerchantRelationRequestToCompanyBusinessUnit';

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
     * the column name for the id_merchant_relation_request_to_company_business_unit field
     */
    public const COL_ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT = 'spy_merchant_relation_request_to_company_business_unit.id_merchant_relation_request_to_company_business_unit';

    /**
     * the column name for the fk_merchant_relation_request field
     */
    public const COL_FK_MERCHANT_RELATION_REQUEST = 'spy_merchant_relation_request_to_company_business_unit.fk_merchant_relation_request';

    /**
     * the column name for the fk_company_business_unit field
     */
    public const COL_FK_COMPANY_BUSINESS_UNIT = 'spy_merchant_relation_request_to_company_business_unit.fk_company_business_unit';

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
        self::TYPE_PHPNAME       => ['IdMerchantRelationRequestToCompanyBusinessUnit', 'FkMerchantRelationRequest', 'FkCompanyBusinessUnit', ],
        self::TYPE_CAMELNAME     => ['idMerchantRelationRequestToCompanyBusinessUnit', 'fkMerchantRelationRequest', 'fkCompanyBusinessUnit', ],
        self::TYPE_COLNAME       => [SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT, SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_FK_MERCHANT_RELATION_REQUEST, SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_FK_COMPANY_BUSINESS_UNIT, ],
        self::TYPE_FIELDNAME     => ['id_merchant_relation_request_to_company_business_unit', 'fk_merchant_relation_request', 'fk_company_business_unit', ],
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
        self::TYPE_PHPNAME       => ['IdMerchantRelationRequestToCompanyBusinessUnit' => 0, 'FkMerchantRelationRequest' => 1, 'FkCompanyBusinessUnit' => 2, ],
        self::TYPE_CAMELNAME     => ['idMerchantRelationRequestToCompanyBusinessUnit' => 0, 'fkMerchantRelationRequest' => 1, 'fkCompanyBusinessUnit' => 2, ],
        self::TYPE_COLNAME       => [SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT => 0, SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_FK_MERCHANT_RELATION_REQUEST => 1, SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_FK_COMPANY_BUSINESS_UNIT => 2, ],
        self::TYPE_FIELDNAME     => ['id_merchant_relation_request_to_company_business_unit' => 0, 'fk_merchant_relation_request' => 1, 'fk_company_business_unit' => 2, ],
        self::TYPE_NUM           => [0, 1, 2, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdMerchantRelationRequestToCompanyBusinessUnit' => 'ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT',
        'SpyMerchantRelationRequestToCompanyBusinessUnit.IdMerchantRelationRequestToCompanyBusinessUnit' => 'ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT',
        'idMerchantRelationRequestToCompanyBusinessUnit' => 'ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT',
        'spyMerchantRelationRequestToCompanyBusinessUnit.idMerchantRelationRequestToCompanyBusinessUnit' => 'ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT',
        'SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT' => 'ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT',
        'COL_ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT' => 'ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT',
        'id_merchant_relation_request_to_company_business_unit' => 'ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT',
        'spy_merchant_relation_request_to_company_business_unit.id_merchant_relation_request_to_company_business_unit' => 'ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT',
        'FkMerchantRelationRequest' => 'FK_MERCHANT_RELATION_REQUEST',
        'SpyMerchantRelationRequestToCompanyBusinessUnit.FkMerchantRelationRequest' => 'FK_MERCHANT_RELATION_REQUEST',
        'fkMerchantRelationRequest' => 'FK_MERCHANT_RELATION_REQUEST',
        'spyMerchantRelationRequestToCompanyBusinessUnit.fkMerchantRelationRequest' => 'FK_MERCHANT_RELATION_REQUEST',
        'SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_FK_MERCHANT_RELATION_REQUEST' => 'FK_MERCHANT_RELATION_REQUEST',
        'COL_FK_MERCHANT_RELATION_REQUEST' => 'FK_MERCHANT_RELATION_REQUEST',
        'fk_merchant_relation_request' => 'FK_MERCHANT_RELATION_REQUEST',
        'spy_merchant_relation_request_to_company_business_unit.fk_merchant_relation_request' => 'FK_MERCHANT_RELATION_REQUEST',
        'FkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'SpyMerchantRelationRequestToCompanyBusinessUnit.FkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'fkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'spyMerchantRelationRequestToCompanyBusinessUnit.fkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_FK_COMPANY_BUSINESS_UNIT' => 'FK_COMPANY_BUSINESS_UNIT',
        'COL_FK_COMPANY_BUSINESS_UNIT' => 'FK_COMPANY_BUSINESS_UNIT',
        'fk_company_business_unit' => 'FK_COMPANY_BUSINESS_UNIT',
        'spy_merchant_relation_request_to_company_business_unit.fk_company_business_unit' => 'FK_COMPANY_BUSINESS_UNIT',
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
        $this->setName('spy_merchant_relation_request_to_company_business_unit');
        $this->setPhpName('SpyMerchantRelationRequestToCompanyBusinessUnit');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\MerchantRelationRequest\\Persistence\\SpyMerchantRelationRequestToCompanyBusinessUnit');
        $this->setPackage('src.Orm.Zed.MerchantRelationRequest.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_m_rel_request_to_company_bu_pk_seq');
        // columns
        $this->addPrimaryKey('id_merchant_relation_request_to_company_business_unit', 'IdMerchantRelationRequestToCompanyBusinessUnit', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_merchant_relation_request', 'FkMerchantRelationRequest', 'INTEGER', 'spy_merchant_relation_request', 'id_merchant_relation_request', true, null, null);
        $this->addForeignKey('fk_company_business_unit', 'FkCompanyBusinessUnit', 'INTEGER', 'spy_company_business_unit', 'id_company_business_unit', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('MerchantRelationshipRequest', '\\Orm\\Zed\\MerchantRelationRequest\\Persistence\\SpyMerchantRelationRequest', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_merchant_relation_request',
    1 => ':id_merchant_relation_request',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('CompanyBusinessUnit', '\\Orm\\Zed\\CompanyBusinessUnit\\Persistence\\SpyCompanyBusinessUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_company_business_unit',
    1 => ':id_company_business_unit',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationRequestToCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationRequestToCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationRequestToCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationRequestToCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationRequestToCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdMerchantRelationRequestToCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdMerchantRelationRequestToCompanyBusinessUnit', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::CLASS_DEFAULT : SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::OM_CLASS;
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
     * @return array (SpyMerchantRelationRequestToCompanyBusinessUnit object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::OM_CLASS;
            /** @var SpyMerchantRelationRequestToCompanyBusinessUnit $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyMerchantRelationRequestToCompanyBusinessUnit $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT);
            $criteria->addSelectColumn(SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_FK_MERCHANT_RELATION_REQUEST);
            $criteria->addSelectColumn(SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_FK_COMPANY_BUSINESS_UNIT);
        } else {
            $criteria->addSelectColumn($alias . '.id_merchant_relation_request_to_company_business_unit');
            $criteria->addSelectColumn($alias . '.fk_merchant_relation_request');
            $criteria->addSelectColumn($alias . '.fk_company_business_unit');
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
            $criteria->removeSelectColumn(SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT);
            $criteria->removeSelectColumn(SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_FK_MERCHANT_RELATION_REQUEST);
            $criteria->removeSelectColumn(SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_FK_COMPANY_BUSINESS_UNIT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_merchant_relation_request_to_company_business_unit');
            $criteria->removeSelectColumn($alias . '.fk_merchant_relation_request');
            $criteria->removeSelectColumn($alias . '.fk_company_business_unit');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::DATABASE_NAME)->getTable(SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyMerchantRelationRequestToCompanyBusinessUnit or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyMerchantRelationRequestToCompanyBusinessUnit object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\MerchantRelationRequest\Persistence\SpyMerchantRelationRequestToCompanyBusinessUnit) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::DATABASE_NAME);
            $criteria->add(SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT, (array) $values, Criteria::IN);
        }

        $query = SpyMerchantRelationRequestToCompanyBusinessUnitQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_merchant_relation_request_to_company_business_unit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyMerchantRelationRequestToCompanyBusinessUnitQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyMerchantRelationRequestToCompanyBusinessUnit or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyMerchantRelationRequestToCompanyBusinessUnit object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyMerchantRelationRequestToCompanyBusinessUnit object
        }

        if ($criteria->containsKey(SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT) && $criteria->keyContainsValue(SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyMerchantRelationRequestToCompanyBusinessUnitTableMap::COL_ID_MERCHANT_RELATION_REQUEST_TO_COMPANY_BUSINESS_UNIT.')');
        }


        // Set the correct dbName
        $query = SpyMerchantRelationRequestToCompanyBusinessUnitQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
