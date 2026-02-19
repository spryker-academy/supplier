<?php

namespace Orm\Zed\ShoppingListNote\Persistence\Map;

use Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNote;
use Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNoteQuery;
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
 * This class defines the structure of the 'spy_shopping_list_item_note' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyShoppingListItemNoteTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ShoppingListNote.Persistence.Map.SpyShoppingListItemNoteTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_shopping_list_item_note';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyShoppingListItemNote';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ShoppingListNote\\Persistence\\SpyShoppingListItemNote';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ShoppingListNote.Persistence.SpyShoppingListItemNote';

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
     * the column name for the id_shopping_list_item_note field
     */
    public const COL_ID_SHOPPING_LIST_ITEM_NOTE = 'spy_shopping_list_item_note.id_shopping_list_item_note';

    /**
     * the column name for the fk_shopping_list_item field
     */
    public const COL_FK_SHOPPING_LIST_ITEM = 'spy_shopping_list_item_note.fk_shopping_list_item';

    /**
     * the column name for the note field
     */
    public const COL_NOTE = 'spy_shopping_list_item_note.note';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_shopping_list_item_note.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_shopping_list_item_note.updated_at';

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
        self::TYPE_PHPNAME       => ['IdShoppingListItemNote', 'FkShoppingListItem', 'Note', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idShoppingListItemNote', 'fkShoppingListItem', 'note', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyShoppingListItemNoteTableMap::COL_ID_SHOPPING_LIST_ITEM_NOTE, SpyShoppingListItemNoteTableMap::COL_FK_SHOPPING_LIST_ITEM, SpyShoppingListItemNoteTableMap::COL_NOTE, SpyShoppingListItemNoteTableMap::COL_CREATED_AT, SpyShoppingListItemNoteTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_shopping_list_item_note', 'fk_shopping_list_item', 'note', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdShoppingListItemNote' => 0, 'FkShoppingListItem' => 1, 'Note' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, ],
        self::TYPE_CAMELNAME     => ['idShoppingListItemNote' => 0, 'fkShoppingListItem' => 1, 'note' => 2, 'createdAt' => 3, 'updatedAt' => 4, ],
        self::TYPE_COLNAME       => [SpyShoppingListItemNoteTableMap::COL_ID_SHOPPING_LIST_ITEM_NOTE => 0, SpyShoppingListItemNoteTableMap::COL_FK_SHOPPING_LIST_ITEM => 1, SpyShoppingListItemNoteTableMap::COL_NOTE => 2, SpyShoppingListItemNoteTableMap::COL_CREATED_AT => 3, SpyShoppingListItemNoteTableMap::COL_UPDATED_AT => 4, ],
        self::TYPE_FIELDNAME     => ['id_shopping_list_item_note' => 0, 'fk_shopping_list_item' => 1, 'note' => 2, 'created_at' => 3, 'updated_at' => 4, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdShoppingListItemNote' => 'ID_SHOPPING_LIST_ITEM_NOTE',
        'SpyShoppingListItemNote.IdShoppingListItemNote' => 'ID_SHOPPING_LIST_ITEM_NOTE',
        'idShoppingListItemNote' => 'ID_SHOPPING_LIST_ITEM_NOTE',
        'spyShoppingListItemNote.idShoppingListItemNote' => 'ID_SHOPPING_LIST_ITEM_NOTE',
        'SpyShoppingListItemNoteTableMap::COL_ID_SHOPPING_LIST_ITEM_NOTE' => 'ID_SHOPPING_LIST_ITEM_NOTE',
        'COL_ID_SHOPPING_LIST_ITEM_NOTE' => 'ID_SHOPPING_LIST_ITEM_NOTE',
        'id_shopping_list_item_note' => 'ID_SHOPPING_LIST_ITEM_NOTE',
        'spy_shopping_list_item_note.id_shopping_list_item_note' => 'ID_SHOPPING_LIST_ITEM_NOTE',
        'FkShoppingListItem' => 'FK_SHOPPING_LIST_ITEM',
        'SpyShoppingListItemNote.FkShoppingListItem' => 'FK_SHOPPING_LIST_ITEM',
        'fkShoppingListItem' => 'FK_SHOPPING_LIST_ITEM',
        'spyShoppingListItemNote.fkShoppingListItem' => 'FK_SHOPPING_LIST_ITEM',
        'SpyShoppingListItemNoteTableMap::COL_FK_SHOPPING_LIST_ITEM' => 'FK_SHOPPING_LIST_ITEM',
        'COL_FK_SHOPPING_LIST_ITEM' => 'FK_SHOPPING_LIST_ITEM',
        'fk_shopping_list_item' => 'FK_SHOPPING_LIST_ITEM',
        'spy_shopping_list_item_note.fk_shopping_list_item' => 'FK_SHOPPING_LIST_ITEM',
        'Note' => 'NOTE',
        'SpyShoppingListItemNote.Note' => 'NOTE',
        'note' => 'NOTE',
        'spyShoppingListItemNote.note' => 'NOTE',
        'SpyShoppingListItemNoteTableMap::COL_NOTE' => 'NOTE',
        'COL_NOTE' => 'NOTE',
        'spy_shopping_list_item_note.note' => 'NOTE',
        'CreatedAt' => 'CREATED_AT',
        'SpyShoppingListItemNote.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyShoppingListItemNote.createdAt' => 'CREATED_AT',
        'SpyShoppingListItemNoteTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_shopping_list_item_note.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyShoppingListItemNote.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyShoppingListItemNote.updatedAt' => 'UPDATED_AT',
        'SpyShoppingListItemNoteTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_shopping_list_item_note.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_shopping_list_item_note');
        $this->setPhpName('SpyShoppingListItemNote');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ShoppingListNote\\Persistence\\SpyShoppingListItemNote');
        $this->setPackage('src.Orm.Zed.ShoppingListNote.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_shopping_list_item_note_pk_seq');
        // columns
        $this->addPrimaryKey('id_shopping_list_item_note', 'IdShoppingListItemNote', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_shopping_list_item', 'FkShoppingListItem', 'INTEGER', 'spy_shopping_list_item', 'id_shopping_list_item', true, null, null);
        $this->addColumn('note', 'Note', 'LONGVARCHAR', true, null, null);
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
        $this->addRelation('SpyShoppingListItem', '\\Orm\\Zed\\ShoppingList\\Persistence\\SpyShoppingListItem', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_shopping_list_item',
    1 => ':id_shopping_list_item',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListItemNote', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListItemNote', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListItemNote', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListItemNote', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListItemNote', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdShoppingListItemNote', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdShoppingListItemNote', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyShoppingListItemNoteTableMap::CLASS_DEFAULT : SpyShoppingListItemNoteTableMap::OM_CLASS;
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
     * @return array (SpyShoppingListItemNote object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyShoppingListItemNoteTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyShoppingListItemNoteTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyShoppingListItemNoteTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyShoppingListItemNoteTableMap::OM_CLASS;
            /** @var SpyShoppingListItemNote $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyShoppingListItemNoteTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyShoppingListItemNoteTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyShoppingListItemNoteTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyShoppingListItemNote $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyShoppingListItemNoteTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyShoppingListItemNoteTableMap::COL_ID_SHOPPING_LIST_ITEM_NOTE);
            $criteria->addSelectColumn(SpyShoppingListItemNoteTableMap::COL_FK_SHOPPING_LIST_ITEM);
            $criteria->addSelectColumn(SpyShoppingListItemNoteTableMap::COL_NOTE);
            $criteria->addSelectColumn(SpyShoppingListItemNoteTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyShoppingListItemNoteTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_shopping_list_item_note');
            $criteria->addSelectColumn($alias . '.fk_shopping_list_item');
            $criteria->addSelectColumn($alias . '.note');
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
            $criteria->removeSelectColumn(SpyShoppingListItemNoteTableMap::COL_ID_SHOPPING_LIST_ITEM_NOTE);
            $criteria->removeSelectColumn(SpyShoppingListItemNoteTableMap::COL_FK_SHOPPING_LIST_ITEM);
            $criteria->removeSelectColumn(SpyShoppingListItemNoteTableMap::COL_NOTE);
            $criteria->removeSelectColumn(SpyShoppingListItemNoteTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyShoppingListItemNoteTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_shopping_list_item_note');
            $criteria->removeSelectColumn($alias . '.fk_shopping_list_item');
            $criteria->removeSelectColumn($alias . '.note');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyShoppingListItemNoteTableMap::DATABASE_NAME)->getTable(SpyShoppingListItemNoteTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyShoppingListItemNote or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyShoppingListItemNote object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListItemNoteTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ShoppingListNote\Persistence\SpyShoppingListItemNote) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyShoppingListItemNoteTableMap::DATABASE_NAME);
            $criteria->add(SpyShoppingListItemNoteTableMap::COL_ID_SHOPPING_LIST_ITEM_NOTE, (array) $values, Criteria::IN);
        }

        $query = SpyShoppingListItemNoteQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyShoppingListItemNoteTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyShoppingListItemNoteTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_shopping_list_item_note table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyShoppingListItemNoteQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyShoppingListItemNote or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyShoppingListItemNote object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyShoppingListItemNoteTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyShoppingListItemNote object
        }

        if ($criteria->containsKey(SpyShoppingListItemNoteTableMap::COL_ID_SHOPPING_LIST_ITEM_NOTE) && $criteria->keyContainsValue(SpyShoppingListItemNoteTableMap::COL_ID_SHOPPING_LIST_ITEM_NOTE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyShoppingListItemNoteTableMap::COL_ID_SHOPPING_LIST_ITEM_NOTE.')');
        }


        // Set the correct dbName
        $query = SpyShoppingListItemNoteQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
