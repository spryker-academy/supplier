<?php

namespace Orm\Zed\CustomerNote\Persistence\Map;

use Orm\Zed\CustomerNote\Persistence\SpyCustomerNote;
use Orm\Zed\CustomerNote\Persistence\SpyCustomerNoteQuery;
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
 * This class defines the structure of the 'spy_customer_note' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCustomerNoteTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CustomerNote.Persistence.Map.SpyCustomerNoteTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_customer_note';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCustomerNote';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CustomerNote\\Persistence\\SpyCustomerNote';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CustomerNote.Persistence.SpyCustomerNote';

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
     * the column name for the id_customer_note field
     */
    public const COL_ID_CUSTOMER_NOTE = 'spy_customer_note.id_customer_note';

    /**
     * the column name for the fk_customer field
     */
    public const COL_FK_CUSTOMER = 'spy_customer_note.fk_customer';

    /**
     * the column name for the fk_user field
     */
    public const COL_FK_USER = 'spy_customer_note.fk_user';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_customer_note.created_at';

    /**
     * the column name for the message field
     */
    public const COL_MESSAGE = 'spy_customer_note.message';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_customer_note.updated_at';

    /**
     * the column name for the username field
     */
    public const COL_USERNAME = 'spy_customer_note.username';

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
        self::TYPE_PHPNAME       => ['IdCustomerNote', 'FkCustomer', 'FkUser', 'CreatedAt', 'Message', 'UpdatedAt', 'Username', ],
        self::TYPE_CAMELNAME     => ['idCustomerNote', 'fkCustomer', 'fkUser', 'createdAt', 'message', 'updatedAt', 'username', ],
        self::TYPE_COLNAME       => [SpyCustomerNoteTableMap::COL_ID_CUSTOMER_NOTE, SpyCustomerNoteTableMap::COL_FK_CUSTOMER, SpyCustomerNoteTableMap::COL_FK_USER, SpyCustomerNoteTableMap::COL_CREATED_AT, SpyCustomerNoteTableMap::COL_MESSAGE, SpyCustomerNoteTableMap::COL_UPDATED_AT, SpyCustomerNoteTableMap::COL_USERNAME, ],
        self::TYPE_FIELDNAME     => ['id_customer_note', 'fk_customer', 'fk_user', 'created_at', 'message', 'updated_at', 'username', ],
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
        self::TYPE_PHPNAME       => ['IdCustomerNote' => 0, 'FkCustomer' => 1, 'FkUser' => 2, 'CreatedAt' => 3, 'Message' => 4, 'UpdatedAt' => 5, 'Username' => 6, ],
        self::TYPE_CAMELNAME     => ['idCustomerNote' => 0, 'fkCustomer' => 1, 'fkUser' => 2, 'createdAt' => 3, 'message' => 4, 'updatedAt' => 5, 'username' => 6, ],
        self::TYPE_COLNAME       => [SpyCustomerNoteTableMap::COL_ID_CUSTOMER_NOTE => 0, SpyCustomerNoteTableMap::COL_FK_CUSTOMER => 1, SpyCustomerNoteTableMap::COL_FK_USER => 2, SpyCustomerNoteTableMap::COL_CREATED_AT => 3, SpyCustomerNoteTableMap::COL_MESSAGE => 4, SpyCustomerNoteTableMap::COL_UPDATED_AT => 5, SpyCustomerNoteTableMap::COL_USERNAME => 6, ],
        self::TYPE_FIELDNAME     => ['id_customer_note' => 0, 'fk_customer' => 1, 'fk_user' => 2, 'created_at' => 3, 'message' => 4, 'updated_at' => 5, 'username' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCustomerNote' => 'ID_CUSTOMER_NOTE',
        'SpyCustomerNote.IdCustomerNote' => 'ID_CUSTOMER_NOTE',
        'idCustomerNote' => 'ID_CUSTOMER_NOTE',
        'spyCustomerNote.idCustomerNote' => 'ID_CUSTOMER_NOTE',
        'SpyCustomerNoteTableMap::COL_ID_CUSTOMER_NOTE' => 'ID_CUSTOMER_NOTE',
        'COL_ID_CUSTOMER_NOTE' => 'ID_CUSTOMER_NOTE',
        'id_customer_note' => 'ID_CUSTOMER_NOTE',
        'spy_customer_note.id_customer_note' => 'ID_CUSTOMER_NOTE',
        'FkCustomer' => 'FK_CUSTOMER',
        'SpyCustomerNote.FkCustomer' => 'FK_CUSTOMER',
        'fkCustomer' => 'FK_CUSTOMER',
        'spyCustomerNote.fkCustomer' => 'FK_CUSTOMER',
        'SpyCustomerNoteTableMap::COL_FK_CUSTOMER' => 'FK_CUSTOMER',
        'COL_FK_CUSTOMER' => 'FK_CUSTOMER',
        'fk_customer' => 'FK_CUSTOMER',
        'spy_customer_note.fk_customer' => 'FK_CUSTOMER',
        'FkUser' => 'FK_USER',
        'SpyCustomerNote.FkUser' => 'FK_USER',
        'fkUser' => 'FK_USER',
        'spyCustomerNote.fkUser' => 'FK_USER',
        'SpyCustomerNoteTableMap::COL_FK_USER' => 'FK_USER',
        'COL_FK_USER' => 'FK_USER',
        'fk_user' => 'FK_USER',
        'spy_customer_note.fk_user' => 'FK_USER',
        'CreatedAt' => 'CREATED_AT',
        'SpyCustomerNote.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyCustomerNote.createdAt' => 'CREATED_AT',
        'SpyCustomerNoteTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_customer_note.created_at' => 'CREATED_AT',
        'Message' => 'MESSAGE',
        'SpyCustomerNote.Message' => 'MESSAGE',
        'message' => 'MESSAGE',
        'spyCustomerNote.message' => 'MESSAGE',
        'SpyCustomerNoteTableMap::COL_MESSAGE' => 'MESSAGE',
        'COL_MESSAGE' => 'MESSAGE',
        'spy_customer_note.message' => 'MESSAGE',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyCustomerNote.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyCustomerNote.updatedAt' => 'UPDATED_AT',
        'SpyCustomerNoteTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_customer_note.updated_at' => 'UPDATED_AT',
        'Username' => 'USERNAME',
        'SpyCustomerNote.Username' => 'USERNAME',
        'username' => 'USERNAME',
        'spyCustomerNote.username' => 'USERNAME',
        'SpyCustomerNoteTableMap::COL_USERNAME' => 'USERNAME',
        'COL_USERNAME' => 'USERNAME',
        'spy_customer_note.username' => 'USERNAME',
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
        $this->setName('spy_customer_note');
        $this->setPhpName('SpyCustomerNote');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\CustomerNote\\Persistence\\SpyCustomerNote');
        $this->setPackage('src.Orm.Zed.CustomerNote.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_customer_note_pk_seq');
        // columns
        $this->addPrimaryKey('id_customer_note', 'IdCustomerNote', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_customer', 'FkCustomer', 'INTEGER', 'spy_customer', 'id_customer', true, null, null);
        $this->addForeignKey('fk_user', 'FkUser', 'INTEGER', 'spy_user', 'id_user', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('message', 'Message', 'LONGVARCHAR', true, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('username', 'Username', 'VARCHAR', false, 255, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Customer', '\\Orm\\Zed\\Customer\\Persistence\\SpyCustomer', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_customer',
    1 => ':id_customer',
  ),
), null, null, null, false);
        $this->addRelation('User', '\\Orm\\Zed\\User\\Persistence\\SpyUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_user',
    1 => ':id_user',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerNote', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerNote', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerNote', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerNote', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerNote', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCustomerNote', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdCustomerNote', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCustomerNoteTableMap::CLASS_DEFAULT : SpyCustomerNoteTableMap::OM_CLASS;
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
     * @return array (SpyCustomerNote object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCustomerNoteTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCustomerNoteTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCustomerNoteTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCustomerNoteTableMap::OM_CLASS;
            /** @var SpyCustomerNote $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCustomerNoteTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCustomerNoteTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCustomerNoteTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCustomerNote $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCustomerNoteTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCustomerNoteTableMap::COL_ID_CUSTOMER_NOTE);
            $criteria->addSelectColumn(SpyCustomerNoteTableMap::COL_FK_CUSTOMER);
            $criteria->addSelectColumn(SpyCustomerNoteTableMap::COL_FK_USER);
            $criteria->addSelectColumn(SpyCustomerNoteTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyCustomerNoteTableMap::COL_MESSAGE);
            $criteria->addSelectColumn(SpyCustomerNoteTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(SpyCustomerNoteTableMap::COL_USERNAME);
        } else {
            $criteria->addSelectColumn($alias . '.id_customer_note');
            $criteria->addSelectColumn($alias . '.fk_customer');
            $criteria->addSelectColumn($alias . '.fk_user');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.message');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.username');
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
            $criteria->removeSelectColumn(SpyCustomerNoteTableMap::COL_ID_CUSTOMER_NOTE);
            $criteria->removeSelectColumn(SpyCustomerNoteTableMap::COL_FK_CUSTOMER);
            $criteria->removeSelectColumn(SpyCustomerNoteTableMap::COL_FK_USER);
            $criteria->removeSelectColumn(SpyCustomerNoteTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyCustomerNoteTableMap::COL_MESSAGE);
            $criteria->removeSelectColumn(SpyCustomerNoteTableMap::COL_UPDATED_AT);
            $criteria->removeSelectColumn(SpyCustomerNoteTableMap::COL_USERNAME);
        } else {
            $criteria->removeSelectColumn($alias . '.id_customer_note');
            $criteria->removeSelectColumn($alias . '.fk_customer');
            $criteria->removeSelectColumn($alias . '.fk_user');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.message');
            $criteria->removeSelectColumn($alias . '.updated_at');
            $criteria->removeSelectColumn($alias . '.username');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCustomerNoteTableMap::DATABASE_NAME)->getTable(SpyCustomerNoteTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCustomerNote or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCustomerNote object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerNoteTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CustomerNote\Persistence\SpyCustomerNote) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCustomerNoteTableMap::DATABASE_NAME);
            $criteria->add(SpyCustomerNoteTableMap::COL_ID_CUSTOMER_NOTE, (array) $values, Criteria::IN);
        }

        $query = SpyCustomerNoteQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCustomerNoteTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCustomerNoteTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_customer_note table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCustomerNoteQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCustomerNote or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCustomerNote object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCustomerNoteTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCustomerNote object
        }

        if ($criteria->containsKey(SpyCustomerNoteTableMap::COL_ID_CUSTOMER_NOTE) && $criteria->keyContainsValue(SpyCustomerNoteTableMap::COL_ID_CUSTOMER_NOTE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyCustomerNoteTableMap::COL_ID_CUSTOMER_NOTE.')');
        }


        // Set the correct dbName
        $query = SpyCustomerNoteQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
