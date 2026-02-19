<?php

namespace Orm\Zed\Quote\Persistence\Map;

use Orm\Zed\Quote\Persistence\SpyQuote;
use Orm\Zed\Quote\Persistence\SpyQuoteQuery;
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
 * This class defines the structure of the 'spy_quote' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyQuoteTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Quote.Persistence.Map.SpyQuoteTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_quote';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyQuote';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Quote\\Persistence\\SpyQuote';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Quote.Persistence.SpyQuote';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id_quote field
     */
    public const COL_ID_QUOTE = 'spy_quote.id_quote';

    /**
     * the column name for the fk_store field
     */
    public const COL_FK_STORE = 'spy_quote.fk_store';

    /**
     * the column name for the customer_reference field
     */
    public const COL_CUSTOMER_REFERENCE = 'spy_quote.customer_reference';

    /**
     * the column name for the is_default field
     */
    public const COL_IS_DEFAULT = 'spy_quote.is_default';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_quote.key';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_quote.name';

    /**
     * the column name for the quote_data field
     */
    public const COL_QUOTE_DATA = 'spy_quote.quote_data';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_quote.uuid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_quote.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_quote.updated_at';

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
        self::TYPE_PHPNAME       => ['IdQuote', 'FkStore', 'CustomerReference', 'IsDefault', 'Key', 'Name', 'QuoteData', 'Uuid', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idQuote', 'fkStore', 'customerReference', 'isDefault', 'key', 'name', 'quoteData', 'uuid', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyQuoteTableMap::COL_ID_QUOTE, SpyQuoteTableMap::COL_FK_STORE, SpyQuoteTableMap::COL_CUSTOMER_REFERENCE, SpyQuoteTableMap::COL_IS_DEFAULT, SpyQuoteTableMap::COL_KEY, SpyQuoteTableMap::COL_NAME, SpyQuoteTableMap::COL_QUOTE_DATA, SpyQuoteTableMap::COL_UUID, SpyQuoteTableMap::COL_CREATED_AT, SpyQuoteTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_quote', 'fk_store', 'customer_reference', 'is_default', 'key', 'name', 'quote_data', 'uuid', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
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
        self::TYPE_PHPNAME       => ['IdQuote' => 0, 'FkStore' => 1, 'CustomerReference' => 2, 'IsDefault' => 3, 'Key' => 4, 'Name' => 5, 'QuoteData' => 6, 'Uuid' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ],
        self::TYPE_CAMELNAME     => ['idQuote' => 0, 'fkStore' => 1, 'customerReference' => 2, 'isDefault' => 3, 'key' => 4, 'name' => 5, 'quoteData' => 6, 'uuid' => 7, 'createdAt' => 8, 'updatedAt' => 9, ],
        self::TYPE_COLNAME       => [SpyQuoteTableMap::COL_ID_QUOTE => 0, SpyQuoteTableMap::COL_FK_STORE => 1, SpyQuoteTableMap::COL_CUSTOMER_REFERENCE => 2, SpyQuoteTableMap::COL_IS_DEFAULT => 3, SpyQuoteTableMap::COL_KEY => 4, SpyQuoteTableMap::COL_NAME => 5, SpyQuoteTableMap::COL_QUOTE_DATA => 6, SpyQuoteTableMap::COL_UUID => 7, SpyQuoteTableMap::COL_CREATED_AT => 8, SpyQuoteTableMap::COL_UPDATED_AT => 9, ],
        self::TYPE_FIELDNAME     => ['id_quote' => 0, 'fk_store' => 1, 'customer_reference' => 2, 'is_default' => 3, 'key' => 4, 'name' => 5, 'quote_data' => 6, 'uuid' => 7, 'created_at' => 8, 'updated_at' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdQuote' => 'ID_QUOTE',
        'SpyQuote.IdQuote' => 'ID_QUOTE',
        'idQuote' => 'ID_QUOTE',
        'spyQuote.idQuote' => 'ID_QUOTE',
        'SpyQuoteTableMap::COL_ID_QUOTE' => 'ID_QUOTE',
        'COL_ID_QUOTE' => 'ID_QUOTE',
        'id_quote' => 'ID_QUOTE',
        'spy_quote.id_quote' => 'ID_QUOTE',
        'FkStore' => 'FK_STORE',
        'SpyQuote.FkStore' => 'FK_STORE',
        'fkStore' => 'FK_STORE',
        'spyQuote.fkStore' => 'FK_STORE',
        'SpyQuoteTableMap::COL_FK_STORE' => 'FK_STORE',
        'COL_FK_STORE' => 'FK_STORE',
        'fk_store' => 'FK_STORE',
        'spy_quote.fk_store' => 'FK_STORE',
        'CustomerReference' => 'CUSTOMER_REFERENCE',
        'SpyQuote.CustomerReference' => 'CUSTOMER_REFERENCE',
        'customerReference' => 'CUSTOMER_REFERENCE',
        'spyQuote.customerReference' => 'CUSTOMER_REFERENCE',
        'SpyQuoteTableMap::COL_CUSTOMER_REFERENCE' => 'CUSTOMER_REFERENCE',
        'COL_CUSTOMER_REFERENCE' => 'CUSTOMER_REFERENCE',
        'customer_reference' => 'CUSTOMER_REFERENCE',
        'spy_quote.customer_reference' => 'CUSTOMER_REFERENCE',
        'IsDefault' => 'IS_DEFAULT',
        'SpyQuote.IsDefault' => 'IS_DEFAULT',
        'isDefault' => 'IS_DEFAULT',
        'spyQuote.isDefault' => 'IS_DEFAULT',
        'SpyQuoteTableMap::COL_IS_DEFAULT' => 'IS_DEFAULT',
        'COL_IS_DEFAULT' => 'IS_DEFAULT',
        'is_default' => 'IS_DEFAULT',
        'spy_quote.is_default' => 'IS_DEFAULT',
        'Key' => 'KEY',
        'SpyQuote.Key' => 'KEY',
        'key' => 'KEY',
        'spyQuote.key' => 'KEY',
        'SpyQuoteTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_quote.key' => 'KEY',
        'Name' => 'NAME',
        'SpyQuote.Name' => 'NAME',
        'name' => 'NAME',
        'spyQuote.name' => 'NAME',
        'SpyQuoteTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_quote.name' => 'NAME',
        'QuoteData' => 'QUOTE_DATA',
        'SpyQuote.QuoteData' => 'QUOTE_DATA',
        'quoteData' => 'QUOTE_DATA',
        'spyQuote.quoteData' => 'QUOTE_DATA',
        'SpyQuoteTableMap::COL_QUOTE_DATA' => 'QUOTE_DATA',
        'COL_QUOTE_DATA' => 'QUOTE_DATA',
        'quote_data' => 'QUOTE_DATA',
        'spy_quote.quote_data' => 'QUOTE_DATA',
        'Uuid' => 'UUID',
        'SpyQuote.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyQuote.uuid' => 'UUID',
        'SpyQuoteTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_quote.uuid' => 'UUID',
        'CreatedAt' => 'CREATED_AT',
        'SpyQuote.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyQuote.createdAt' => 'CREATED_AT',
        'SpyQuoteTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_quote.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyQuote.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyQuote.updatedAt' => 'UPDATED_AT',
        'SpyQuoteTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_quote.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_quote');
        $this->setPhpName('SpyQuote');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Quote\\Persistence\\SpyQuote');
        $this->setPackage('src.Orm.Zed.Quote.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_quote_pk_seq');
        // columns
        $this->addPrimaryKey('id_quote', 'IdQuote', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_store', 'FkStore', 'INTEGER', 'spy_store', 'id_store', true, null, null);
        $this->addColumn('customer_reference', 'CustomerReference', 'VARCHAR', true, 255, null);
        $this->addColumn('is_default', 'IsDefault', 'BOOLEAN', false, 1, false);
        $this->addColumn('key', 'Key', 'VARCHAR', false, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('quote_data', 'QuoteData', 'CLOB', true, null, null);
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
        $this->addRelation('SpyStore', '\\Orm\\Zed\\Store\\Persistence\\SpyStore', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_store',
    1 => ':id_store',
  ),
), null, null, null, false);
        $this->addRelation('SpyQuoteCompanyUser', '\\Orm\\Zed\\SharedCart\\Persistence\\SpyQuoteCompanyUser', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_quote',
    1 => ':id_quote',
  ),
), null, null, 'SpyQuoteCompanyUsers', false);
        $this->addRelation('SpyQuoteApproval', '\\Orm\\Zed\\QuoteApproval\\Persistence\\SpyQuoteApproval', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_quote',
    1 => ':id_quote',
  ),
), null, null, 'SpyQuoteApprovals', false);
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'customer_reference.id_quote'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuote', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuote', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuote', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuote', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuote', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdQuote', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdQuote', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyQuoteTableMap::CLASS_DEFAULT : SpyQuoteTableMap::OM_CLASS;
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
     * @return array (SpyQuote object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyQuoteTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyQuoteTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyQuoteTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyQuoteTableMap::OM_CLASS;
            /** @var SpyQuote $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyQuoteTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyQuoteTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyQuoteTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyQuote $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyQuoteTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyQuoteTableMap::COL_ID_QUOTE);
            $criteria->addSelectColumn(SpyQuoteTableMap::COL_FK_STORE);
            $criteria->addSelectColumn(SpyQuoteTableMap::COL_CUSTOMER_REFERENCE);
            $criteria->addSelectColumn(SpyQuoteTableMap::COL_IS_DEFAULT);
            $criteria->addSelectColumn(SpyQuoteTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyQuoteTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyQuoteTableMap::COL_QUOTE_DATA);
            $criteria->addSelectColumn(SpyQuoteTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyQuoteTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyQuoteTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_quote');
            $criteria->addSelectColumn($alias . '.fk_store');
            $criteria->addSelectColumn($alias . '.customer_reference');
            $criteria->addSelectColumn($alias . '.is_default');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.quote_data');
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
            $criteria->removeSelectColumn(SpyQuoteTableMap::COL_ID_QUOTE);
            $criteria->removeSelectColumn(SpyQuoteTableMap::COL_FK_STORE);
            $criteria->removeSelectColumn(SpyQuoteTableMap::COL_CUSTOMER_REFERENCE);
            $criteria->removeSelectColumn(SpyQuoteTableMap::COL_IS_DEFAULT);
            $criteria->removeSelectColumn(SpyQuoteTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyQuoteTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyQuoteTableMap::COL_QUOTE_DATA);
            $criteria->removeSelectColumn(SpyQuoteTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyQuoteTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyQuoteTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_quote');
            $criteria->removeSelectColumn($alias . '.fk_store');
            $criteria->removeSelectColumn($alias . '.customer_reference');
            $criteria->removeSelectColumn($alias . '.is_default');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.quote_data');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyQuoteTableMap::DATABASE_NAME)->getTable(SpyQuoteTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyQuote or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyQuote object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Quote\Persistence\SpyQuote) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyQuoteTableMap::DATABASE_NAME);
            $criteria->add(SpyQuoteTableMap::COL_ID_QUOTE, (array) $values, Criteria::IN);
        }

        $query = SpyQuoteQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyQuoteTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyQuoteTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_quote table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyQuoteQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyQuote or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyQuote object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyQuoteTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyQuote object
        }


        // Set the correct dbName
        $query = SpyQuoteQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
