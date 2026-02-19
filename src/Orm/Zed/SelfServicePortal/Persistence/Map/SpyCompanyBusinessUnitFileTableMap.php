<?php

namespace Orm\Zed\SelfServicePortal\Persistence\Map;

use Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile;
use Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFileQuery;
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
 * This class defines the structure of the 'spy_company_business_unit_file' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCompanyBusinessUnitFileTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SelfServicePortal.Persistence.Map.SpyCompanyBusinessUnitFileTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_company_business_unit_file';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCompanyBusinessUnitFile';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpyCompanyBusinessUnitFile';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SelfServicePortal.Persistence.SpyCompanyBusinessUnitFile';

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
     * the column name for the id_company_business_unit_file field
     */
    public const COL_ID_COMPANY_BUSINESS_UNIT_FILE = 'spy_company_business_unit_file.id_company_business_unit_file';

    /**
     * the column name for the fk_company_business_unit field
     */
    public const COL_FK_COMPANY_BUSINESS_UNIT = 'spy_company_business_unit_file.fk_company_business_unit';

    /**
     * the column name for the fk_file field
     */
    public const COL_FK_FILE = 'spy_company_business_unit_file.fk_file';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_company_business_unit_file.uuid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_company_business_unit_file.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_company_business_unit_file.updated_at';

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
        self::TYPE_PHPNAME       => ['IdCompanyBusinessUnitFile', 'FkCompanyBusinessUnit', 'FkFile', 'Uuid', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idCompanyBusinessUnitFile', 'fkCompanyBusinessUnit', 'fkFile', 'uuid', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyCompanyBusinessUnitFileTableMap::COL_ID_COMPANY_BUSINESS_UNIT_FILE, SpyCompanyBusinessUnitFileTableMap::COL_FK_COMPANY_BUSINESS_UNIT, SpyCompanyBusinessUnitFileTableMap::COL_FK_FILE, SpyCompanyBusinessUnitFileTableMap::COL_UUID, SpyCompanyBusinessUnitFileTableMap::COL_CREATED_AT, SpyCompanyBusinessUnitFileTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_company_business_unit_file', 'fk_company_business_unit', 'fk_file', 'uuid', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdCompanyBusinessUnitFile' => 0, 'FkCompanyBusinessUnit' => 1, 'FkFile' => 2, 'Uuid' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idCompanyBusinessUnitFile' => 0, 'fkCompanyBusinessUnit' => 1, 'fkFile' => 2, 'uuid' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [SpyCompanyBusinessUnitFileTableMap::COL_ID_COMPANY_BUSINESS_UNIT_FILE => 0, SpyCompanyBusinessUnitFileTableMap::COL_FK_COMPANY_BUSINESS_UNIT => 1, SpyCompanyBusinessUnitFileTableMap::COL_FK_FILE => 2, SpyCompanyBusinessUnitFileTableMap::COL_UUID => 3, SpyCompanyBusinessUnitFileTableMap::COL_CREATED_AT => 4, SpyCompanyBusinessUnitFileTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['id_company_business_unit_file' => 0, 'fk_company_business_unit' => 1, 'fk_file' => 2, 'uuid' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCompanyBusinessUnitFile' => 'ID_COMPANY_BUSINESS_UNIT_FILE',
        'SpyCompanyBusinessUnitFile.IdCompanyBusinessUnitFile' => 'ID_COMPANY_BUSINESS_UNIT_FILE',
        'idCompanyBusinessUnitFile' => 'ID_COMPANY_BUSINESS_UNIT_FILE',
        'spyCompanyBusinessUnitFile.idCompanyBusinessUnitFile' => 'ID_COMPANY_BUSINESS_UNIT_FILE',
        'SpyCompanyBusinessUnitFileTableMap::COL_ID_COMPANY_BUSINESS_UNIT_FILE' => 'ID_COMPANY_BUSINESS_UNIT_FILE',
        'COL_ID_COMPANY_BUSINESS_UNIT_FILE' => 'ID_COMPANY_BUSINESS_UNIT_FILE',
        'id_company_business_unit_file' => 'ID_COMPANY_BUSINESS_UNIT_FILE',
        'spy_company_business_unit_file.id_company_business_unit_file' => 'ID_COMPANY_BUSINESS_UNIT_FILE',
        'FkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'SpyCompanyBusinessUnitFile.FkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'fkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'spyCompanyBusinessUnitFile.fkCompanyBusinessUnit' => 'FK_COMPANY_BUSINESS_UNIT',
        'SpyCompanyBusinessUnitFileTableMap::COL_FK_COMPANY_BUSINESS_UNIT' => 'FK_COMPANY_BUSINESS_UNIT',
        'COL_FK_COMPANY_BUSINESS_UNIT' => 'FK_COMPANY_BUSINESS_UNIT',
        'fk_company_business_unit' => 'FK_COMPANY_BUSINESS_UNIT',
        'spy_company_business_unit_file.fk_company_business_unit' => 'FK_COMPANY_BUSINESS_UNIT',
        'FkFile' => 'FK_FILE',
        'SpyCompanyBusinessUnitFile.FkFile' => 'FK_FILE',
        'fkFile' => 'FK_FILE',
        'spyCompanyBusinessUnitFile.fkFile' => 'FK_FILE',
        'SpyCompanyBusinessUnitFileTableMap::COL_FK_FILE' => 'FK_FILE',
        'COL_FK_FILE' => 'FK_FILE',
        'fk_file' => 'FK_FILE',
        'spy_company_business_unit_file.fk_file' => 'FK_FILE',
        'Uuid' => 'UUID',
        'SpyCompanyBusinessUnitFile.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyCompanyBusinessUnitFile.uuid' => 'UUID',
        'SpyCompanyBusinessUnitFileTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_company_business_unit_file.uuid' => 'UUID',
        'CreatedAt' => 'CREATED_AT',
        'SpyCompanyBusinessUnitFile.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyCompanyBusinessUnitFile.createdAt' => 'CREATED_AT',
        'SpyCompanyBusinessUnitFileTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_company_business_unit_file.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyCompanyBusinessUnitFile.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyCompanyBusinessUnitFile.updatedAt' => 'UPDATED_AT',
        'SpyCompanyBusinessUnitFileTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_company_business_unit_file.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_company_business_unit_file');
        $this->setPhpName('SpyCompanyBusinessUnitFile');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpyCompanyBusinessUnitFile');
        $this->setPackage('src.Orm.Zed.SelfServicePortal.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_company_business_unit_file_pk_seq');
        // columns
        $this->addPrimaryKey('id_company_business_unit_file', 'IdCompanyBusinessUnitFile', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_company_business_unit', 'FkCompanyBusinessUnit', 'INTEGER', 'spy_company_business_unit', 'id_company_business_unit', true, null, null);
        $this->addForeignKey('fk_file', 'FkFile', 'INTEGER', 'spy_file', 'id_file', true, null, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 255, null);
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
        $this->addRelation('CompanyBusinessUnit', '\\Orm\\Zed\\CompanyBusinessUnit\\Persistence\\SpyCompanyBusinessUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_company_business_unit',
    1 => ':id_company_business_unit',
  ),
), null, null, null, false);
        $this->addRelation('File', '\\Orm\\Zed\\FileManager\\Persistence\\SpyFile', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_file',
    1 => ':id_file',
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_company_business_unit_file'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyBusinessUnitFile', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyBusinessUnitFile', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyBusinessUnitFile', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyBusinessUnitFile', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyBusinessUnitFile', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyBusinessUnitFile', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCompanyBusinessUnitFile', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCompanyBusinessUnitFileTableMap::CLASS_DEFAULT : SpyCompanyBusinessUnitFileTableMap::OM_CLASS;
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
     * @return array (SpyCompanyBusinessUnitFile object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCompanyBusinessUnitFileTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCompanyBusinessUnitFileTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCompanyBusinessUnitFileTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCompanyBusinessUnitFileTableMap::OM_CLASS;
            /** @var SpyCompanyBusinessUnitFile $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCompanyBusinessUnitFileTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCompanyBusinessUnitFileTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCompanyBusinessUnitFileTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCompanyBusinessUnitFile $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCompanyBusinessUnitFileTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCompanyBusinessUnitFileTableMap::COL_ID_COMPANY_BUSINESS_UNIT_FILE);
            $criteria->addSelectColumn(SpyCompanyBusinessUnitFileTableMap::COL_FK_COMPANY_BUSINESS_UNIT);
            $criteria->addSelectColumn(SpyCompanyBusinessUnitFileTableMap::COL_FK_FILE);
            $criteria->addSelectColumn(SpyCompanyBusinessUnitFileTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyCompanyBusinessUnitFileTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyCompanyBusinessUnitFileTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_company_business_unit_file');
            $criteria->addSelectColumn($alias . '.fk_company_business_unit');
            $criteria->addSelectColumn($alias . '.fk_file');
            $criteria->addSelectColumn($alias . '.uuid');
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
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitFileTableMap::COL_ID_COMPANY_BUSINESS_UNIT_FILE);
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitFileTableMap::COL_FK_COMPANY_BUSINESS_UNIT);
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitFileTableMap::COL_FK_FILE);
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitFileTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitFileTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyCompanyBusinessUnitFileTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_company_business_unit_file');
            $criteria->removeSelectColumn($alias . '.fk_company_business_unit');
            $criteria->removeSelectColumn($alias . '.fk_file');
            $criteria->removeSelectColumn($alias . '.uuid');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCompanyBusinessUnitFileTableMap::DATABASE_NAME)->getTable(SpyCompanyBusinessUnitFileTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCompanyBusinessUnitFile or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCompanyBusinessUnitFile object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyBusinessUnitFileTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SelfServicePortal\Persistence\SpyCompanyBusinessUnitFile) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCompanyBusinessUnitFileTableMap::DATABASE_NAME);
            $criteria->add(SpyCompanyBusinessUnitFileTableMap::COL_ID_COMPANY_BUSINESS_UNIT_FILE, (array) $values, Criteria::IN);
        }

        $query = SpyCompanyBusinessUnitFileQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCompanyBusinessUnitFileTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCompanyBusinessUnitFileTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_company_business_unit_file table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCompanyBusinessUnitFileQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCompanyBusinessUnitFile or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCompanyBusinessUnitFile object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyBusinessUnitFileTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCompanyBusinessUnitFile object
        }

        if ($criteria->containsKey(SpyCompanyBusinessUnitFileTableMap::COL_ID_COMPANY_BUSINESS_UNIT_FILE) && $criteria->keyContainsValue(SpyCompanyBusinessUnitFileTableMap::COL_ID_COMPANY_BUSINESS_UNIT_FILE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCompanyBusinessUnitFileTableMap::COL_ID_COMPANY_BUSINESS_UNIT_FILE.')');
        }


        // Set the correct dbName
        $query = SpyCompanyBusinessUnitFileQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
