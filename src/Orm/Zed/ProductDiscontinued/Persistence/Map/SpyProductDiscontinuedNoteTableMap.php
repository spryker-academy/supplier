<?php

namespace Orm\Zed\ProductDiscontinued\Persistence\Map;

use Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNote;
use Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNoteQuery;
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
 * This class defines the structure of the 'spy_product_discontinued_note' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductDiscontinuedNoteTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductDiscontinued.Persistence.Map.SpyProductDiscontinuedNoteTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_discontinued_note';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductDiscontinuedNote';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductDiscontinued\\Persistence\\SpyProductDiscontinuedNote';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductDiscontinued.Persistence.SpyProductDiscontinuedNote';

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
     * the column name for the id_product_discontinued_note field
     */
    public const COL_ID_PRODUCT_DISCONTINUED_NOTE = 'spy_product_discontinued_note.id_product_discontinued_note';

    /**
     * the column name for the fk_locale field
     */
    public const COL_FK_LOCALE = 'spy_product_discontinued_note.fk_locale';

    /**
     * the column name for the fk_product_discontinued field
     */
    public const COL_FK_PRODUCT_DISCONTINUED = 'spy_product_discontinued_note.fk_product_discontinued';

    /**
     * the column name for the note field
     */
    public const COL_NOTE = 'spy_product_discontinued_note.note';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_discontinued_note.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_discontinued_note.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductDiscontinuedNote', 'FkLocale', 'FkProductDiscontinued', 'Note', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductDiscontinuedNote', 'fkLocale', 'fkProductDiscontinued', 'note', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductDiscontinuedNoteTableMap::COL_ID_PRODUCT_DISCONTINUED_NOTE, SpyProductDiscontinuedNoteTableMap::COL_FK_LOCALE, SpyProductDiscontinuedNoteTableMap::COL_FK_PRODUCT_DISCONTINUED, SpyProductDiscontinuedNoteTableMap::COL_NOTE, SpyProductDiscontinuedNoteTableMap::COL_CREATED_AT, SpyProductDiscontinuedNoteTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_discontinued_note', 'fk_locale', 'fk_product_discontinued', 'note', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProductDiscontinuedNote' => 0, 'FkLocale' => 1, 'FkProductDiscontinued' => 2, 'Note' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ],
        self::TYPE_CAMELNAME     => ['idProductDiscontinuedNote' => 0, 'fkLocale' => 1, 'fkProductDiscontinued' => 2, 'note' => 3, 'createdAt' => 4, 'updatedAt' => 5, ],
        self::TYPE_COLNAME       => [SpyProductDiscontinuedNoteTableMap::COL_ID_PRODUCT_DISCONTINUED_NOTE => 0, SpyProductDiscontinuedNoteTableMap::COL_FK_LOCALE => 1, SpyProductDiscontinuedNoteTableMap::COL_FK_PRODUCT_DISCONTINUED => 2, SpyProductDiscontinuedNoteTableMap::COL_NOTE => 3, SpyProductDiscontinuedNoteTableMap::COL_CREATED_AT => 4, SpyProductDiscontinuedNoteTableMap::COL_UPDATED_AT => 5, ],
        self::TYPE_FIELDNAME     => ['id_product_discontinued_note' => 0, 'fk_locale' => 1, 'fk_product_discontinued' => 2, 'note' => 3, 'created_at' => 4, 'updated_at' => 5, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductDiscontinuedNote' => 'ID_PRODUCT_DISCONTINUED_NOTE',
        'SpyProductDiscontinuedNote.IdProductDiscontinuedNote' => 'ID_PRODUCT_DISCONTINUED_NOTE',
        'idProductDiscontinuedNote' => 'ID_PRODUCT_DISCONTINUED_NOTE',
        'spyProductDiscontinuedNote.idProductDiscontinuedNote' => 'ID_PRODUCT_DISCONTINUED_NOTE',
        'SpyProductDiscontinuedNoteTableMap::COL_ID_PRODUCT_DISCONTINUED_NOTE' => 'ID_PRODUCT_DISCONTINUED_NOTE',
        'COL_ID_PRODUCT_DISCONTINUED_NOTE' => 'ID_PRODUCT_DISCONTINUED_NOTE',
        'id_product_discontinued_note' => 'ID_PRODUCT_DISCONTINUED_NOTE',
        'spy_product_discontinued_note.id_product_discontinued_note' => 'ID_PRODUCT_DISCONTINUED_NOTE',
        'FkLocale' => 'FK_LOCALE',
        'SpyProductDiscontinuedNote.FkLocale' => 'FK_LOCALE',
        'fkLocale' => 'FK_LOCALE',
        'spyProductDiscontinuedNote.fkLocale' => 'FK_LOCALE',
        'SpyProductDiscontinuedNoteTableMap::COL_FK_LOCALE' => 'FK_LOCALE',
        'COL_FK_LOCALE' => 'FK_LOCALE',
        'fk_locale' => 'FK_LOCALE',
        'spy_product_discontinued_note.fk_locale' => 'FK_LOCALE',
        'FkProductDiscontinued' => 'FK_PRODUCT_DISCONTINUED',
        'SpyProductDiscontinuedNote.FkProductDiscontinued' => 'FK_PRODUCT_DISCONTINUED',
        'fkProductDiscontinued' => 'FK_PRODUCT_DISCONTINUED',
        'spyProductDiscontinuedNote.fkProductDiscontinued' => 'FK_PRODUCT_DISCONTINUED',
        'SpyProductDiscontinuedNoteTableMap::COL_FK_PRODUCT_DISCONTINUED' => 'FK_PRODUCT_DISCONTINUED',
        'COL_FK_PRODUCT_DISCONTINUED' => 'FK_PRODUCT_DISCONTINUED',
        'fk_product_discontinued' => 'FK_PRODUCT_DISCONTINUED',
        'spy_product_discontinued_note.fk_product_discontinued' => 'FK_PRODUCT_DISCONTINUED',
        'Note' => 'NOTE',
        'SpyProductDiscontinuedNote.Note' => 'NOTE',
        'note' => 'NOTE',
        'spyProductDiscontinuedNote.note' => 'NOTE',
        'SpyProductDiscontinuedNoteTableMap::COL_NOTE' => 'NOTE',
        'COL_NOTE' => 'NOTE',
        'spy_product_discontinued_note.note' => 'NOTE',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductDiscontinuedNote.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductDiscontinuedNote.createdAt' => 'CREATED_AT',
        'SpyProductDiscontinuedNoteTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_discontinued_note.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductDiscontinuedNote.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductDiscontinuedNote.updatedAt' => 'UPDATED_AT',
        'SpyProductDiscontinuedNoteTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_discontinued_note.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_discontinued_note');
        $this->setPhpName('SpyProductDiscontinuedNote');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ProductDiscontinued\\Persistence\\SpyProductDiscontinuedNote');
        $this->setPackage('src.Orm.Zed.ProductDiscontinued.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_product_discontinued_note_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_discontinued_note', 'IdProductDiscontinuedNote', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_locale', 'FkLocale', 'INTEGER', 'spy_locale', 'id_locale', true, null, null);
        $this->addForeignKey('fk_product_discontinued', 'FkProductDiscontinued', 'INTEGER', 'spy_product_discontinued', 'id_product_discontinued', true, null, null);
        $this->addColumn('note', 'Note', 'LONGVARCHAR', false, null, null);
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
        $this->addRelation('ProductDiscontinued', '\\Orm\\Zed\\ProductDiscontinued\\Persistence\\SpyProductDiscontinued', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_discontinued',
    1 => ':id_product_discontinued',
  ),
), null, null, null, false);
        $this->addRelation('Locale', '\\Orm\\Zed\\Locale\\Persistence\\SpyLocale', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_locale',
    1 => ':id_locale',
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
            'event' => ['spy_product_discontinued_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinuedNote', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinuedNote', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinuedNote', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinuedNote', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinuedNote', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductDiscontinuedNote', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductDiscontinuedNote', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductDiscontinuedNoteTableMap::CLASS_DEFAULT : SpyProductDiscontinuedNoteTableMap::OM_CLASS;
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
     * @return array (SpyProductDiscontinuedNote object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductDiscontinuedNoteTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductDiscontinuedNoteTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductDiscontinuedNoteTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductDiscontinuedNoteTableMap::OM_CLASS;
            /** @var SpyProductDiscontinuedNote $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductDiscontinuedNoteTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductDiscontinuedNoteTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductDiscontinuedNoteTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductDiscontinuedNote $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductDiscontinuedNoteTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductDiscontinuedNoteTableMap::COL_ID_PRODUCT_DISCONTINUED_NOTE);
            $criteria->addSelectColumn(SpyProductDiscontinuedNoteTableMap::COL_FK_LOCALE);
            $criteria->addSelectColumn(SpyProductDiscontinuedNoteTableMap::COL_FK_PRODUCT_DISCONTINUED);
            $criteria->addSelectColumn(SpyProductDiscontinuedNoteTableMap::COL_NOTE);
            $criteria->addSelectColumn(SpyProductDiscontinuedNoteTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductDiscontinuedNoteTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_discontinued_note');
            $criteria->addSelectColumn($alias . '.fk_locale');
            $criteria->addSelectColumn($alias . '.fk_product_discontinued');
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
            $criteria->removeSelectColumn(SpyProductDiscontinuedNoteTableMap::COL_ID_PRODUCT_DISCONTINUED_NOTE);
            $criteria->removeSelectColumn(SpyProductDiscontinuedNoteTableMap::COL_FK_LOCALE);
            $criteria->removeSelectColumn(SpyProductDiscontinuedNoteTableMap::COL_FK_PRODUCT_DISCONTINUED);
            $criteria->removeSelectColumn(SpyProductDiscontinuedNoteTableMap::COL_NOTE);
            $criteria->removeSelectColumn(SpyProductDiscontinuedNoteTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductDiscontinuedNoteTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_discontinued_note');
            $criteria->removeSelectColumn($alias . '.fk_locale');
            $criteria->removeSelectColumn($alias . '.fk_product_discontinued');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductDiscontinuedNoteTableMap::DATABASE_NAME)->getTable(SpyProductDiscontinuedNoteTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductDiscontinuedNote or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductDiscontinuedNote object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductDiscontinuedNoteTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductDiscontinued\Persistence\SpyProductDiscontinuedNote) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductDiscontinuedNoteTableMap::DATABASE_NAME);
            $criteria->add(SpyProductDiscontinuedNoteTableMap::COL_ID_PRODUCT_DISCONTINUED_NOTE, (array) $values, Criteria::IN);
        }

        $query = SpyProductDiscontinuedNoteQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductDiscontinuedNoteTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductDiscontinuedNoteTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_discontinued_note table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductDiscontinuedNoteQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductDiscontinuedNote or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductDiscontinuedNote object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductDiscontinuedNoteTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductDiscontinuedNote object
        }


        // Set the correct dbName
        $query = SpyProductDiscontinuedNoteQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
