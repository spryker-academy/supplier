<?php

namespace Orm\Zed\WeekdaySchedule\Persistence\Map;

use Orm\Zed\MerchantOpeningHours\Persistence\Map\SpyMerchantOpeningHoursWeekdayScheduleTableMap;
use Orm\Zed\WeekdaySchedule\Persistence\SpyWeekdaySchedule;
use Orm\Zed\WeekdaySchedule\Persistence\SpyWeekdayScheduleQuery;
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
 * This class defines the structure of the 'spy_weekday_schedule' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyWeekdayScheduleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.WeekdaySchedule.Persistence.Map.SpyWeekdayScheduleTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_weekday_schedule';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyWeekdaySchedule';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\WeekdaySchedule\\Persistence\\SpyWeekdaySchedule';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.WeekdaySchedule.Persistence.SpyWeekdaySchedule';

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
     * the column name for the id_weekday_schedule field
     */
    public const COL_ID_WEEKDAY_SCHEDULE = 'spy_weekday_schedule.id_weekday_schedule';

    /**
     * the column name for the day field
     */
    public const COL_DAY = 'spy_weekday_schedule.day';

    /**
     * the column name for the time_from field
     */
    public const COL_TIME_FROM = 'spy_weekday_schedule.time_from';

    /**
     * the column name for the time_to field
     */
    public const COL_TIME_TO = 'spy_weekday_schedule.time_to';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_weekday_schedule.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_weekday_schedule.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the day field */
    public const COL_DAY_MONDAY = 'MONDAY';
    public const COL_DAY_TUESDAY = 'TUESDAY';
    public const COL_DAY_WEDNESDAY = 'WEDNESDAY';
    public const COL_DAY_THURSDAY = 'THURSDAY';
    public const COL_DAY_FRIDAY = 'FRIDAY';
    public const COL_DAY_SATURDAY = 'SATURDAY';
    public const COL_DAY_SUNDAY = 'SUNDAY';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdWeekdaySchedule', 'Day', 'TimeFrom', 'TimeTo', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idWeekdaySchedule', 'day', 'timeFrom', 'timeTo', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyWeekdayScheduleTableMap::COL_ID_WEEKDAY_SCHEDULE, SpyWeekdayScheduleTableMap::COL_DAY, SpyWeekdayScheduleTableMap::COL_TIME_FROM, SpyWeekdayScheduleTableMap::COL_TIME_TO, SpyWeekdayScheduleTableMap::COL_CREATED_AT, SpyWeekdayScheduleTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_weekday_schedule', 'day', 'time_from', 'time_to', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdWeekdaySchedule' => 0, 'Day' => 1, 'TimeFrom' => 2, 'TimeTo' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idWeekdaySchedule' => 0, 'day' => 1, 'timeFrom' => 2, 'timeTo' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [SpyWeekdayScheduleTableMap::COL_ID_WEEKDAY_SCHEDULE => 0, SpyWeekdayScheduleTableMap::COL_DAY => 1, SpyWeekdayScheduleTableMap::COL_TIME_FROM => 2, SpyWeekdayScheduleTableMap::COL_TIME_TO => 3, SpyWeekdayScheduleTableMap::COL_CREATED_AT => 4, SpyWeekdayScheduleTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['id_weekday_schedule' => 0, 'day' => 1, 'time_from' => 2, 'time_to' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdWeekdaySchedule' => 'ID_WEEKDAY_SCHEDULE',
        'SpyWeekdaySchedule.IdWeekdaySchedule' => 'ID_WEEKDAY_SCHEDULE',
        'idWeekdaySchedule' => 'ID_WEEKDAY_SCHEDULE',
        'spyWeekdaySchedule.idWeekdaySchedule' => 'ID_WEEKDAY_SCHEDULE',
        'SpyWeekdayScheduleTableMap::COL_ID_WEEKDAY_SCHEDULE' => 'ID_WEEKDAY_SCHEDULE',
        'COL_ID_WEEKDAY_SCHEDULE' => 'ID_WEEKDAY_SCHEDULE',
        'id_weekday_schedule' => 'ID_WEEKDAY_SCHEDULE',
        'spy_weekday_schedule.id_weekday_schedule' => 'ID_WEEKDAY_SCHEDULE',
        'Day' => 'DAY',
        'SpyWeekdaySchedule.Day' => 'DAY',
        'day' => 'DAY',
        'spyWeekdaySchedule.day' => 'DAY',
        'SpyWeekdayScheduleTableMap::COL_DAY' => 'DAY',
        'COL_DAY' => 'DAY',
        'spy_weekday_schedule.day' => 'DAY',
        'TimeFrom' => 'TIME_FROM',
        'SpyWeekdaySchedule.TimeFrom' => 'TIME_FROM',
        'timeFrom' => 'TIME_FROM',
        'spyWeekdaySchedule.timeFrom' => 'TIME_FROM',
        'SpyWeekdayScheduleTableMap::COL_TIME_FROM' => 'TIME_FROM',
        'COL_TIME_FROM' => 'TIME_FROM',
        'time_from' => 'TIME_FROM',
        'spy_weekday_schedule.time_from' => 'TIME_FROM',
        'TimeTo' => 'TIME_TO',
        'SpyWeekdaySchedule.TimeTo' => 'TIME_TO',
        'timeTo' => 'TIME_TO',
        'spyWeekdaySchedule.timeTo' => 'TIME_TO',
        'SpyWeekdayScheduleTableMap::COL_TIME_TO' => 'TIME_TO',
        'COL_TIME_TO' => 'TIME_TO',
        'time_to' => 'TIME_TO',
        'spy_weekday_schedule.time_to' => 'TIME_TO',
        'CreatedAt' => 'CREATED_AT',
        'SpyWeekdaySchedule.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyWeekdaySchedule.createdAt' => 'CREATED_AT',
        'SpyWeekdayScheduleTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_weekday_schedule.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyWeekdaySchedule.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyWeekdaySchedule.updatedAt' => 'UPDATED_AT',
        'SpyWeekdayScheduleTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_weekday_schedule.updated_at' => 'UPDATED_AT',
    ];

    /**
     * The enumerated values for this table
     *
     * @var array<string, array<string>>
     */
    protected static $enumValueSets = [
                SpyWeekdayScheduleTableMap::COL_DAY => [
                            self::COL_DAY_MONDAY,
            self::COL_DAY_TUESDAY,
            self::COL_DAY_WEDNESDAY,
            self::COL_DAY_THURSDAY,
            self::COL_DAY_FRIDAY,
            self::COL_DAY_SATURDAY,
            self::COL_DAY_SUNDAY,
        ],
    ];

    /**
     * Gets the list of values for all ENUM and SET columns
     * @return array
     */
    public static function getValueSets(): array
    {
      return static::$enumValueSets;
    }

    /**
     * Gets the list of values for an ENUM or SET column
     * @param string $colname
     * @return array list of possible values for the column
     */
    public static function getValueSet(string $colname): array
    {
        $valueSets = self::getValueSets();

        return $valueSets[$colname];
    }

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
        $this->setName('spy_weekday_schedule');
        $this->setPhpName('SpyWeekdaySchedule');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\WeekdaySchedule\\Persistence\\SpyWeekdaySchedule');
        $this->setPackage('src.Orm.Zed.WeekdaySchedule.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_weekday_schedule_pk_seq');
        // columns
        $this->addPrimaryKey('id_weekday_schedule', 'IdWeekdaySchedule', 'INTEGER', true, null, null);
        $this->addColumn('day', 'Day', 'ENUM', true, null, null);
        $this->getColumn('day')->setValueSet(array (
  0 => 'MONDAY',
  1 => 'TUESDAY',
  2 => 'WEDNESDAY',
  3 => 'THURSDAY',
  4 => 'FRIDAY',
  5 => 'SATURDAY',
  6 => 'SUNDAY',
));
        $this->addColumn('time_from', 'TimeFrom', 'TIME', false, null, null);
        $this->addColumn('time_to', 'TimeTo', 'TIME', false, null, null);
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
        $this->addRelation('SpyMerchantOpeningHoursWeekdaySchedule', '\\Orm\\Zed\\MerchantOpeningHours\\Persistence\\SpyMerchantOpeningHoursWeekdaySchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_weekday_schedule',
    1 => ':id_weekday_schedule',
  ),
), 'CASCADE', null, 'SpyMerchantOpeningHoursWeekdaySchedules', false);
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
     * Method to invalidate the instance pool of all tables related to spy_weekday_schedule     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyMerchantOpeningHoursWeekdayScheduleTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdWeekdaySchedule', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdWeekdaySchedule', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdWeekdaySchedule', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdWeekdaySchedule', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdWeekdaySchedule', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdWeekdaySchedule', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdWeekdaySchedule', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyWeekdayScheduleTableMap::CLASS_DEFAULT : SpyWeekdayScheduleTableMap::OM_CLASS;
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
     * @return array (SpyWeekdaySchedule object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyWeekdayScheduleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyWeekdayScheduleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyWeekdayScheduleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyWeekdayScheduleTableMap::OM_CLASS;
            /** @var SpyWeekdaySchedule $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyWeekdayScheduleTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyWeekdayScheduleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyWeekdayScheduleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyWeekdaySchedule $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyWeekdayScheduleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyWeekdayScheduleTableMap::COL_ID_WEEKDAY_SCHEDULE);
            $criteria->addSelectColumn(SpyWeekdayScheduleTableMap::COL_DAY);
            $criteria->addSelectColumn(SpyWeekdayScheduleTableMap::COL_TIME_FROM);
            $criteria->addSelectColumn(SpyWeekdayScheduleTableMap::COL_TIME_TO);
            $criteria->addSelectColumn(SpyWeekdayScheduleTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyWeekdayScheduleTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_weekday_schedule');
            $criteria->addSelectColumn($alias . '.day');
            $criteria->addSelectColumn($alias . '.time_from');
            $criteria->addSelectColumn($alias . '.time_to');
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
            $criteria->removeSelectColumn(SpyWeekdayScheduleTableMap::COL_ID_WEEKDAY_SCHEDULE);
            $criteria->removeSelectColumn(SpyWeekdayScheduleTableMap::COL_DAY);
            $criteria->removeSelectColumn(SpyWeekdayScheduleTableMap::COL_TIME_FROM);
            $criteria->removeSelectColumn(SpyWeekdayScheduleTableMap::COL_TIME_TO);
            $criteria->removeSelectColumn(SpyWeekdayScheduleTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyWeekdayScheduleTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_weekday_schedule');
            $criteria->removeSelectColumn($alias . '.day');
            $criteria->removeSelectColumn($alias . '.time_from');
            $criteria->removeSelectColumn($alias . '.time_to');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyWeekdayScheduleTableMap::DATABASE_NAME)->getTable(SpyWeekdayScheduleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyWeekdaySchedule or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyWeekdaySchedule object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyWeekdayScheduleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\WeekdaySchedule\Persistence\SpyWeekdaySchedule) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyWeekdayScheduleTableMap::DATABASE_NAME);
            $criteria->add(SpyWeekdayScheduleTableMap::COL_ID_WEEKDAY_SCHEDULE, (array) $values, Criteria::IN);
        }

        $query = SpyWeekdayScheduleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyWeekdayScheduleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyWeekdayScheduleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_weekday_schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyWeekdayScheduleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyWeekdaySchedule or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyWeekdaySchedule object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyWeekdayScheduleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyWeekdaySchedule object
        }

        if ($criteria->containsKey(SpyWeekdayScheduleTableMap::COL_ID_WEEKDAY_SCHEDULE) && $criteria->keyContainsValue(SpyWeekdayScheduleTableMap::COL_ID_WEEKDAY_SCHEDULE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyWeekdayScheduleTableMap::COL_ID_WEEKDAY_SCHEDULE.')');
        }


        // Set the correct dbName
        $query = SpyWeekdayScheduleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
