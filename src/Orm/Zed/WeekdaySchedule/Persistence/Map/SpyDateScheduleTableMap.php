<?php

namespace Orm\Zed\WeekdaySchedule\Persistence\Map;

use Orm\Zed\MerchantOpeningHours\Persistence\Map\SpyMerchantOpeningHoursDateScheduleTableMap;
use Orm\Zed\WeekdaySchedule\Persistence\SpyDateSchedule;
use Orm\Zed\WeekdaySchedule\Persistence\SpyDateScheduleQuery;
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
 * This class defines the structure of the 'spy_date_schedule' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyDateScheduleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.WeekdaySchedule.Persistence.Map.SpyDateScheduleTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_date_schedule';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyDateSchedule';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\WeekdaySchedule\\Persistence\\SpyDateSchedule';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.WeekdaySchedule.Persistence.SpyDateSchedule';

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
     * the column name for the id_date_schedule field
     */
    public const COL_ID_DATE_SCHEDULE = 'spy_date_schedule.id_date_schedule';

    /**
     * the column name for the date field
     */
    public const COL_DATE = 'spy_date_schedule.date';

    /**
     * the column name for the time_from field
     */
    public const COL_TIME_FROM = 'spy_date_schedule.time_from';

    /**
     * the column name for the time_to field
     */
    public const COL_TIME_TO = 'spy_date_schedule.time_to';

    /**
     * the column name for the note_glossary_key field
     */
    public const COL_NOTE_GLOSSARY_KEY = 'spy_date_schedule.note_glossary_key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_date_schedule.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_date_schedule.updated_at';

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
        self::TYPE_PHPNAME       => ['IdDateSchedule', 'Date', 'TimeFrom', 'TimeTo', 'NoteGlossaryKey', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idDateSchedule', 'date', 'timeFrom', 'timeTo', 'noteGlossaryKey', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyDateScheduleTableMap::COL_ID_DATE_SCHEDULE, SpyDateScheduleTableMap::COL_DATE, SpyDateScheduleTableMap::COL_TIME_FROM, SpyDateScheduleTableMap::COL_TIME_TO, SpyDateScheduleTableMap::COL_NOTE_GLOSSARY_KEY, SpyDateScheduleTableMap::COL_CREATED_AT, SpyDateScheduleTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_date_schedule', 'date', 'time_from', 'time_to', 'note_glossary_key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdDateSchedule' => 0, 'Date' => 1, 'TimeFrom' => 2, 'TimeTo' => 3, 'NoteGlossaryKey' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idDateSchedule' => 0, 'date' => 1, 'timeFrom' => 2, 'timeTo' => 3, 'noteGlossaryKey' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyDateScheduleTableMap::COL_ID_DATE_SCHEDULE => 0, SpyDateScheduleTableMap::COL_DATE => 1, SpyDateScheduleTableMap::COL_TIME_FROM => 2, SpyDateScheduleTableMap::COL_TIME_TO => 3, SpyDateScheduleTableMap::COL_NOTE_GLOSSARY_KEY => 4, SpyDateScheduleTableMap::COL_CREATED_AT => 5, SpyDateScheduleTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_date_schedule' => 0, 'date' => 1, 'time_from' => 2, 'time_to' => 3, 'note_glossary_key' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdDateSchedule' => 'ID_DATE_SCHEDULE',
        'SpyDateSchedule.IdDateSchedule' => 'ID_DATE_SCHEDULE',
        'idDateSchedule' => 'ID_DATE_SCHEDULE',
        'spyDateSchedule.idDateSchedule' => 'ID_DATE_SCHEDULE',
        'SpyDateScheduleTableMap::COL_ID_DATE_SCHEDULE' => 'ID_DATE_SCHEDULE',
        'COL_ID_DATE_SCHEDULE' => 'ID_DATE_SCHEDULE',
        'id_date_schedule' => 'ID_DATE_SCHEDULE',
        'spy_date_schedule.id_date_schedule' => 'ID_DATE_SCHEDULE',
        'Date' => 'DATE',
        'SpyDateSchedule.Date' => 'DATE',
        'date' => 'DATE',
        'spyDateSchedule.date' => 'DATE',
        'SpyDateScheduleTableMap::COL_DATE' => 'DATE',
        'COL_DATE' => 'DATE',
        'spy_date_schedule.date' => 'DATE',
        'TimeFrom' => 'TIME_FROM',
        'SpyDateSchedule.TimeFrom' => 'TIME_FROM',
        'timeFrom' => 'TIME_FROM',
        'spyDateSchedule.timeFrom' => 'TIME_FROM',
        'SpyDateScheduleTableMap::COL_TIME_FROM' => 'TIME_FROM',
        'COL_TIME_FROM' => 'TIME_FROM',
        'time_from' => 'TIME_FROM',
        'spy_date_schedule.time_from' => 'TIME_FROM',
        'TimeTo' => 'TIME_TO',
        'SpyDateSchedule.TimeTo' => 'TIME_TO',
        'timeTo' => 'TIME_TO',
        'spyDateSchedule.timeTo' => 'TIME_TO',
        'SpyDateScheduleTableMap::COL_TIME_TO' => 'TIME_TO',
        'COL_TIME_TO' => 'TIME_TO',
        'time_to' => 'TIME_TO',
        'spy_date_schedule.time_to' => 'TIME_TO',
        'NoteGlossaryKey' => 'NOTE_GLOSSARY_KEY',
        'SpyDateSchedule.NoteGlossaryKey' => 'NOTE_GLOSSARY_KEY',
        'noteGlossaryKey' => 'NOTE_GLOSSARY_KEY',
        'spyDateSchedule.noteGlossaryKey' => 'NOTE_GLOSSARY_KEY',
        'SpyDateScheduleTableMap::COL_NOTE_GLOSSARY_KEY' => 'NOTE_GLOSSARY_KEY',
        'COL_NOTE_GLOSSARY_KEY' => 'NOTE_GLOSSARY_KEY',
        'note_glossary_key' => 'NOTE_GLOSSARY_KEY',
        'spy_date_schedule.note_glossary_key' => 'NOTE_GLOSSARY_KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyDateSchedule.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyDateSchedule.createdAt' => 'CREATED_AT',
        'SpyDateScheduleTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_date_schedule.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyDateSchedule.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyDateSchedule.updatedAt' => 'UPDATED_AT',
        'SpyDateScheduleTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_date_schedule.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_date_schedule');
        $this->setPhpName('SpyDateSchedule');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\WeekdaySchedule\\Persistence\\SpyDateSchedule');
        $this->setPackage('src.Orm.Zed.WeekdaySchedule.Persistence');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_date_schedule', 'IdDateSchedule', 'INTEGER', true, null, null);
        $this->addColumn('date', 'Date', 'DATE', true, null, null);
        $this->addColumn('time_from', 'TimeFrom', 'TIME', false, null, null);
        $this->addColumn('time_to', 'TimeTo', 'TIME', false, null, null);
        $this->addColumn('note_glossary_key', 'NoteGlossaryKey', 'VARCHAR', false, 255, null);
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
        $this->addRelation('SpyMerchantOpeningHoursDateSchedule', '\\Orm\\Zed\\MerchantOpeningHours\\Persistence\\SpyMerchantOpeningHoursDateSchedule', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_date_schedule',
    1 => ':id_date_schedule',
  ),
), 'CASCADE', null, 'SpyMerchantOpeningHoursDateSchedules', false);
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
     * Method to invalidate the instance pool of all tables related to spy_date_schedule     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpyMerchantOpeningHoursDateScheduleTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDateSchedule', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDateSchedule', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDateSchedule', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDateSchedule', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDateSchedule', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDateSchedule', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdDateSchedule', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyDateScheduleTableMap::CLASS_DEFAULT : SpyDateScheduleTableMap::OM_CLASS;
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
     * @return array (SpyDateSchedule object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyDateScheduleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyDateScheduleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyDateScheduleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyDateScheduleTableMap::OM_CLASS;
            /** @var SpyDateSchedule $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyDateScheduleTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyDateScheduleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyDateScheduleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyDateSchedule $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyDateScheduleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyDateScheduleTableMap::COL_ID_DATE_SCHEDULE);
            $criteria->addSelectColumn(SpyDateScheduleTableMap::COL_DATE);
            $criteria->addSelectColumn(SpyDateScheduleTableMap::COL_TIME_FROM);
            $criteria->addSelectColumn(SpyDateScheduleTableMap::COL_TIME_TO);
            $criteria->addSelectColumn(SpyDateScheduleTableMap::COL_NOTE_GLOSSARY_KEY);
            $criteria->addSelectColumn(SpyDateScheduleTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyDateScheduleTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_date_schedule');
            $criteria->addSelectColumn($alias . '.date');
            $criteria->addSelectColumn($alias . '.time_from');
            $criteria->addSelectColumn($alias . '.time_to');
            $criteria->addSelectColumn($alias . '.note_glossary_key');
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
            $criteria->removeSelectColumn(SpyDateScheduleTableMap::COL_ID_DATE_SCHEDULE);
            $criteria->removeSelectColumn(SpyDateScheduleTableMap::COL_DATE);
            $criteria->removeSelectColumn(SpyDateScheduleTableMap::COL_TIME_FROM);
            $criteria->removeSelectColumn(SpyDateScheduleTableMap::COL_TIME_TO);
            $criteria->removeSelectColumn(SpyDateScheduleTableMap::COL_NOTE_GLOSSARY_KEY);
            $criteria->removeSelectColumn(SpyDateScheduleTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyDateScheduleTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_date_schedule');
            $criteria->removeSelectColumn($alias . '.date');
            $criteria->removeSelectColumn($alias . '.time_from');
            $criteria->removeSelectColumn($alias . '.time_to');
            $criteria->removeSelectColumn($alias . '.note_glossary_key');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyDateScheduleTableMap::DATABASE_NAME)->getTable(SpyDateScheduleTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyDateSchedule or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyDateSchedule object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDateScheduleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\WeekdaySchedule\Persistence\SpyDateSchedule) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyDateScheduleTableMap::DATABASE_NAME);
            $criteria->add(SpyDateScheduleTableMap::COL_ID_DATE_SCHEDULE, (array) $values, Criteria::IN);
        }

        $query = SpyDateScheduleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyDateScheduleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyDateScheduleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_date_schedule table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyDateScheduleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyDateSchedule or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyDateSchedule object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDateScheduleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyDateSchedule object
        }

        if ($criteria->containsKey(SpyDateScheduleTableMap::COL_ID_DATE_SCHEDULE) && $criteria->keyContainsValue(SpyDateScheduleTableMap::COL_ID_DATE_SCHEDULE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyDateScheduleTableMap::COL_ID_DATE_SCHEDULE.')');
        }


        // Set the correct dbName
        $query = SpyDateScheduleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
