<?php

namespace Orm\Zed\ResourceShare\Persistence\Map;

use Orm\Zed\ResourceShare\Persistence\SpyResourceShare;
use Orm\Zed\ResourceShare\Persistence\SpyResourceShareQuery;
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
 * This class defines the structure of the 'spy_resource_share' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyResourceShareTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ResourceShare.Persistence.Map.SpyResourceShareTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_resource_share';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyResourceShare';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ResourceShare\\Persistence\\SpyResourceShare';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ResourceShare.Persistence.SpyResourceShare';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id_resource_share field
     */
    public const COL_ID_RESOURCE_SHARE = 'spy_resource_share.id_resource_share';

    /**
     * the column name for the customer_reference field
     */
    public const COL_CUSTOMER_REFERENCE = 'spy_resource_share.customer_reference';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_resource_share.uuid';

    /**
     * the column name for the resource_type field
     */
    public const COL_RESOURCE_TYPE = 'spy_resource_share.resource_type';

    /**
     * the column name for the resource_data field
     */
    public const COL_RESOURCE_DATA = 'spy_resource_share.resource_data';

    /**
     * the column name for the expiry_date field
     */
    public const COL_EXPIRY_DATE = 'spy_resource_share.expiry_date';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_resource_share.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_resource_share.updated_at';

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
        self::TYPE_PHPNAME       => ['IdResourceShare', 'CustomerReference', 'Uuid', 'ResourceType', 'ResourceData', 'ExpiryDate', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idResourceShare', 'customerReference', 'uuid', 'resourceType', 'resourceData', 'expiryDate', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyResourceShareTableMap::COL_ID_RESOURCE_SHARE, SpyResourceShareTableMap::COL_CUSTOMER_REFERENCE, SpyResourceShareTableMap::COL_UUID, SpyResourceShareTableMap::COL_RESOURCE_TYPE, SpyResourceShareTableMap::COL_RESOURCE_DATA, SpyResourceShareTableMap::COL_EXPIRY_DATE, SpyResourceShareTableMap::COL_CREATED_AT, SpyResourceShareTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_resource_share', 'customer_reference', 'uuid', 'resource_type', 'resource_data', 'expiry_date', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['IdResourceShare' => 0, 'CustomerReference' => 1, 'Uuid' => 2, 'ResourceType' => 3, 'ResourceData' => 4, 'ExpiryDate' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idResourceShare' => 0, 'customerReference' => 1, 'uuid' => 2, 'resourceType' => 3, 'resourceData' => 4, 'expiryDate' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyResourceShareTableMap::COL_ID_RESOURCE_SHARE => 0, SpyResourceShareTableMap::COL_CUSTOMER_REFERENCE => 1, SpyResourceShareTableMap::COL_UUID => 2, SpyResourceShareTableMap::COL_RESOURCE_TYPE => 3, SpyResourceShareTableMap::COL_RESOURCE_DATA => 4, SpyResourceShareTableMap::COL_EXPIRY_DATE => 5, SpyResourceShareTableMap::COL_CREATED_AT => 6, SpyResourceShareTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_resource_share' => 0, 'customer_reference' => 1, 'uuid' => 2, 'resource_type' => 3, 'resource_data' => 4, 'expiry_date' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdResourceShare' => 'ID_RESOURCE_SHARE',
        'SpyResourceShare.IdResourceShare' => 'ID_RESOURCE_SHARE',
        'idResourceShare' => 'ID_RESOURCE_SHARE',
        'spyResourceShare.idResourceShare' => 'ID_RESOURCE_SHARE',
        'SpyResourceShareTableMap::COL_ID_RESOURCE_SHARE' => 'ID_RESOURCE_SHARE',
        'COL_ID_RESOURCE_SHARE' => 'ID_RESOURCE_SHARE',
        'id_resource_share' => 'ID_RESOURCE_SHARE',
        'spy_resource_share.id_resource_share' => 'ID_RESOURCE_SHARE',
        'CustomerReference' => 'CUSTOMER_REFERENCE',
        'SpyResourceShare.CustomerReference' => 'CUSTOMER_REFERENCE',
        'customerReference' => 'CUSTOMER_REFERENCE',
        'spyResourceShare.customerReference' => 'CUSTOMER_REFERENCE',
        'SpyResourceShareTableMap::COL_CUSTOMER_REFERENCE' => 'CUSTOMER_REFERENCE',
        'COL_CUSTOMER_REFERENCE' => 'CUSTOMER_REFERENCE',
        'customer_reference' => 'CUSTOMER_REFERENCE',
        'spy_resource_share.customer_reference' => 'CUSTOMER_REFERENCE',
        'Uuid' => 'UUID',
        'SpyResourceShare.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyResourceShare.uuid' => 'UUID',
        'SpyResourceShareTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_resource_share.uuid' => 'UUID',
        'ResourceType' => 'RESOURCE_TYPE',
        'SpyResourceShare.ResourceType' => 'RESOURCE_TYPE',
        'resourceType' => 'RESOURCE_TYPE',
        'spyResourceShare.resourceType' => 'RESOURCE_TYPE',
        'SpyResourceShareTableMap::COL_RESOURCE_TYPE' => 'RESOURCE_TYPE',
        'COL_RESOURCE_TYPE' => 'RESOURCE_TYPE',
        'resource_type' => 'RESOURCE_TYPE',
        'spy_resource_share.resource_type' => 'RESOURCE_TYPE',
        'ResourceData' => 'RESOURCE_DATA',
        'SpyResourceShare.ResourceData' => 'RESOURCE_DATA',
        'resourceData' => 'RESOURCE_DATA',
        'spyResourceShare.resourceData' => 'RESOURCE_DATA',
        'SpyResourceShareTableMap::COL_RESOURCE_DATA' => 'RESOURCE_DATA',
        'COL_RESOURCE_DATA' => 'RESOURCE_DATA',
        'resource_data' => 'RESOURCE_DATA',
        'spy_resource_share.resource_data' => 'RESOURCE_DATA',
        'ExpiryDate' => 'EXPIRY_DATE',
        'SpyResourceShare.ExpiryDate' => 'EXPIRY_DATE',
        'expiryDate' => 'EXPIRY_DATE',
        'spyResourceShare.expiryDate' => 'EXPIRY_DATE',
        'SpyResourceShareTableMap::COL_EXPIRY_DATE' => 'EXPIRY_DATE',
        'COL_EXPIRY_DATE' => 'EXPIRY_DATE',
        'expiry_date' => 'EXPIRY_DATE',
        'spy_resource_share.expiry_date' => 'EXPIRY_DATE',
        'CreatedAt' => 'CREATED_AT',
        'SpyResourceShare.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyResourceShare.createdAt' => 'CREATED_AT',
        'SpyResourceShareTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_resource_share.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyResourceShare.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyResourceShare.updatedAt' => 'UPDATED_AT',
        'SpyResourceShareTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_resource_share.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_resource_share');
        $this->setPhpName('SpyResourceShare');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ResourceShare\\Persistence\\SpyResourceShare');
        $this->setPackage('src.Orm.Zed.ResourceShare.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_resource_share_pk_seq');
        // columns
        $this->addPrimaryKey('id_resource_share', 'IdResourceShare', 'INTEGER', true, null, null);
        $this->addColumn('customer_reference', 'CustomerReference', 'VARCHAR', true, 255, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 255, null);
        $this->addColumn('resource_type', 'ResourceType', 'VARCHAR', true, 255, null);
        $this->addColumn('resource_data', 'ResourceData', 'LONGVARCHAR', false, null, null);
        $this->addColumn('expiry_date', 'ExpiryDate', 'TIMESTAMP', false, null, null);
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'customer_reference.resource_type.resource_data.expiry_date'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdResourceShare', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdResourceShare', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdResourceShare', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdResourceShare', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdResourceShare', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdResourceShare', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdResourceShare', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyResourceShareTableMap::CLASS_DEFAULT : SpyResourceShareTableMap::OM_CLASS;
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
     * @return array (SpyResourceShare object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyResourceShareTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyResourceShareTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyResourceShareTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyResourceShareTableMap::OM_CLASS;
            /** @var SpyResourceShare $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyResourceShareTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyResourceShareTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyResourceShareTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyResourceShare $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyResourceShareTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyResourceShareTableMap::COL_ID_RESOURCE_SHARE);
            $criteria->addSelectColumn(SpyResourceShareTableMap::COL_CUSTOMER_REFERENCE);
            $criteria->addSelectColumn(SpyResourceShareTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyResourceShareTableMap::COL_RESOURCE_TYPE);
            $criteria->addSelectColumn(SpyResourceShareTableMap::COL_RESOURCE_DATA);
            $criteria->addSelectColumn(SpyResourceShareTableMap::COL_EXPIRY_DATE);
            $criteria->addSelectColumn(SpyResourceShareTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyResourceShareTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_resource_share');
            $criteria->addSelectColumn($alias . '.customer_reference');
            $criteria->addSelectColumn($alias . '.uuid');
            $criteria->addSelectColumn($alias . '.resource_type');
            $criteria->addSelectColumn($alias . '.resource_data');
            $criteria->addSelectColumn($alias . '.expiry_date');
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
            $criteria->removeSelectColumn(SpyResourceShareTableMap::COL_ID_RESOURCE_SHARE);
            $criteria->removeSelectColumn(SpyResourceShareTableMap::COL_CUSTOMER_REFERENCE);
            $criteria->removeSelectColumn(SpyResourceShareTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyResourceShareTableMap::COL_RESOURCE_TYPE);
            $criteria->removeSelectColumn(SpyResourceShareTableMap::COL_RESOURCE_DATA);
            $criteria->removeSelectColumn(SpyResourceShareTableMap::COL_EXPIRY_DATE);
            $criteria->removeSelectColumn(SpyResourceShareTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyResourceShareTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_resource_share');
            $criteria->removeSelectColumn($alias . '.customer_reference');
            $criteria->removeSelectColumn($alias . '.uuid');
            $criteria->removeSelectColumn($alias . '.resource_type');
            $criteria->removeSelectColumn($alias . '.resource_data');
            $criteria->removeSelectColumn($alias . '.expiry_date');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyResourceShareTableMap::DATABASE_NAME)->getTable(SpyResourceShareTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyResourceShare or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyResourceShare object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyResourceShareTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ResourceShare\Persistence\SpyResourceShare) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyResourceShareTableMap::DATABASE_NAME);
            $criteria->add(SpyResourceShareTableMap::COL_ID_RESOURCE_SHARE, (array) $values, Criteria::IN);
        }

        $query = SpyResourceShareQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyResourceShareTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyResourceShareTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_resource_share table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyResourceShareQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyResourceShare or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyResourceShare object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyResourceShareTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyResourceShare object
        }

        if ($criteria->containsKey(SpyResourceShareTableMap::COL_ID_RESOURCE_SHARE) && $criteria->keyContainsValue(SpyResourceShareTableMap::COL_ID_RESOURCE_SHARE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyResourceShareTableMap::COL_ID_RESOURCE_SHARE.')');
        }


        // Set the correct dbName
        $query = SpyResourceShareQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
