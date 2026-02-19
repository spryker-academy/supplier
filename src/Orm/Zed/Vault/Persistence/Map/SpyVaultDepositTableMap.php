<?php

namespace Orm\Zed\Vault\Persistence\Map;

use Orm\Zed\Vault\Persistence\SpyVaultDeposit;
use Orm\Zed\Vault\Persistence\SpyVaultDepositQuery;
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
 * This class defines the structure of the 'spy_vault_deposit' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyVaultDepositTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Vault.Persistence.Map.SpyVaultDepositTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_vault_deposit';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyVaultDeposit';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Vault\\Persistence\\SpyVaultDeposit';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Vault.Persistence.SpyVaultDeposit';

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
     * the column name for the id_vault_deposit field
     */
    public const COL_ID_VAULT_DEPOSIT = 'spy_vault_deposit.id_vault_deposit';

    /**
     * the column name for the data_type field
     */
    public const COL_DATA_TYPE = 'spy_vault_deposit.data_type';

    /**
     * the column name for the data_key field
     */
    public const COL_DATA_KEY = 'spy_vault_deposit.data_key';

    /**
     * the column name for the initial_vector field
     */
    public const COL_INITIAL_VECTOR = 'spy_vault_deposit.initial_vector';

    /**
     * the column name for the cipher_text field
     */
    public const COL_CIPHER_TEXT = 'spy_vault_deposit.cipher_text';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_vault_deposit.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_vault_deposit.updated_at';

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
        self::TYPE_PHPNAME       => ['IdVaultDeposit', 'DataType', 'DataKey', 'InitialVector', 'CipherText', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idVaultDeposit', 'dataType', 'dataKey', 'initialVector', 'cipherText', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyVaultDepositTableMap::COL_ID_VAULT_DEPOSIT, SpyVaultDepositTableMap::COL_DATA_TYPE, SpyVaultDepositTableMap::COL_DATA_KEY, SpyVaultDepositTableMap::COL_INITIAL_VECTOR, SpyVaultDepositTableMap::COL_CIPHER_TEXT, SpyVaultDepositTableMap::COL_CREATED_AT, SpyVaultDepositTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_vault_deposit', 'data_type', 'data_key', 'initial_vector', 'cipher_text', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdVaultDeposit' => 0, 'DataType' => 1, 'DataKey' => 2, 'InitialVector' => 3, 'CipherText' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ],
        self::TYPE_CAMELNAME     => ['idVaultDeposit' => 0, 'dataType' => 1, 'dataKey' => 2, 'initialVector' => 3, 'cipherText' => 4, 'createdAt' => 5, 'updatedAt' => 6, ],
        self::TYPE_COLNAME       => [SpyVaultDepositTableMap::COL_ID_VAULT_DEPOSIT => 0, SpyVaultDepositTableMap::COL_DATA_TYPE => 1, SpyVaultDepositTableMap::COL_DATA_KEY => 2, SpyVaultDepositTableMap::COL_INITIAL_VECTOR => 3, SpyVaultDepositTableMap::COL_CIPHER_TEXT => 4, SpyVaultDepositTableMap::COL_CREATED_AT => 5, SpyVaultDepositTableMap::COL_UPDATED_AT => 6, ],
        self::TYPE_FIELDNAME     => ['id_vault_deposit' => 0, 'data_type' => 1, 'data_key' => 2, 'initial_vector' => 3, 'cipher_text' => 4, 'created_at' => 5, 'updated_at' => 6, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdVaultDeposit' => 'ID_VAULT_DEPOSIT',
        'SpyVaultDeposit.IdVaultDeposit' => 'ID_VAULT_DEPOSIT',
        'idVaultDeposit' => 'ID_VAULT_DEPOSIT',
        'spyVaultDeposit.idVaultDeposit' => 'ID_VAULT_DEPOSIT',
        'SpyVaultDepositTableMap::COL_ID_VAULT_DEPOSIT' => 'ID_VAULT_DEPOSIT',
        'COL_ID_VAULT_DEPOSIT' => 'ID_VAULT_DEPOSIT',
        'id_vault_deposit' => 'ID_VAULT_DEPOSIT',
        'spy_vault_deposit.id_vault_deposit' => 'ID_VAULT_DEPOSIT',
        'DataType' => 'DATA_TYPE',
        'SpyVaultDeposit.DataType' => 'DATA_TYPE',
        'dataType' => 'DATA_TYPE',
        'spyVaultDeposit.dataType' => 'DATA_TYPE',
        'SpyVaultDepositTableMap::COL_DATA_TYPE' => 'DATA_TYPE',
        'COL_DATA_TYPE' => 'DATA_TYPE',
        'data_type' => 'DATA_TYPE',
        'spy_vault_deposit.data_type' => 'DATA_TYPE',
        'DataKey' => 'DATA_KEY',
        'SpyVaultDeposit.DataKey' => 'DATA_KEY',
        'dataKey' => 'DATA_KEY',
        'spyVaultDeposit.dataKey' => 'DATA_KEY',
        'SpyVaultDepositTableMap::COL_DATA_KEY' => 'DATA_KEY',
        'COL_DATA_KEY' => 'DATA_KEY',
        'data_key' => 'DATA_KEY',
        'spy_vault_deposit.data_key' => 'DATA_KEY',
        'InitialVector' => 'INITIAL_VECTOR',
        'SpyVaultDeposit.InitialVector' => 'INITIAL_VECTOR',
        'initialVector' => 'INITIAL_VECTOR',
        'spyVaultDeposit.initialVector' => 'INITIAL_VECTOR',
        'SpyVaultDepositTableMap::COL_INITIAL_VECTOR' => 'INITIAL_VECTOR',
        'COL_INITIAL_VECTOR' => 'INITIAL_VECTOR',
        'initial_vector' => 'INITIAL_VECTOR',
        'spy_vault_deposit.initial_vector' => 'INITIAL_VECTOR',
        'CipherText' => 'CIPHER_TEXT',
        'SpyVaultDeposit.CipherText' => 'CIPHER_TEXT',
        'cipherText' => 'CIPHER_TEXT',
        'spyVaultDeposit.cipherText' => 'CIPHER_TEXT',
        'SpyVaultDepositTableMap::COL_CIPHER_TEXT' => 'CIPHER_TEXT',
        'COL_CIPHER_TEXT' => 'CIPHER_TEXT',
        'cipher_text' => 'CIPHER_TEXT',
        'spy_vault_deposit.cipher_text' => 'CIPHER_TEXT',
        'CreatedAt' => 'CREATED_AT',
        'SpyVaultDeposit.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyVaultDeposit.createdAt' => 'CREATED_AT',
        'SpyVaultDepositTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_vault_deposit.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyVaultDeposit.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyVaultDeposit.updatedAt' => 'UPDATED_AT',
        'SpyVaultDepositTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_vault_deposit.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_vault_deposit');
        $this->setPhpName('SpyVaultDeposit');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Vault\\Persistence\\SpyVaultDeposit');
        $this->setPackage('src.Orm.Zed.Vault.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_vault_deposit_pk_seq');
        // columns
        $this->addPrimaryKey('id_vault_deposit', 'IdVaultDeposit', 'INTEGER', true, null, null);
        $this->addColumn('data_type', 'DataType', 'VARCHAR', true, 255, null);
        $this->addColumn('data_key', 'DataKey', 'VARCHAR', true, 255, null);
        $this->addColumn('initial_vector', 'InitialVector', 'VARCHAR', true, 255, null);
        $this->addColumn('cipher_text', 'CipherText', 'LONGVARCHAR', true, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdVaultDeposit', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdVaultDeposit', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdVaultDeposit', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdVaultDeposit', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdVaultDeposit', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdVaultDeposit', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdVaultDeposit', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyVaultDepositTableMap::CLASS_DEFAULT : SpyVaultDepositTableMap::OM_CLASS;
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
     * @return array (SpyVaultDeposit object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyVaultDepositTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyVaultDepositTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyVaultDepositTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyVaultDepositTableMap::OM_CLASS;
            /** @var SpyVaultDeposit $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyVaultDepositTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyVaultDepositTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyVaultDepositTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyVaultDeposit $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyVaultDepositTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyVaultDepositTableMap::COL_ID_VAULT_DEPOSIT);
            $criteria->addSelectColumn(SpyVaultDepositTableMap::COL_DATA_TYPE);
            $criteria->addSelectColumn(SpyVaultDepositTableMap::COL_DATA_KEY);
            $criteria->addSelectColumn(SpyVaultDepositTableMap::COL_INITIAL_VECTOR);
            $criteria->addSelectColumn(SpyVaultDepositTableMap::COL_CIPHER_TEXT);
            $criteria->addSelectColumn(SpyVaultDepositTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyVaultDepositTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_vault_deposit');
            $criteria->addSelectColumn($alias . '.data_type');
            $criteria->addSelectColumn($alias . '.data_key');
            $criteria->addSelectColumn($alias . '.initial_vector');
            $criteria->addSelectColumn($alias . '.cipher_text');
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
            $criteria->removeSelectColumn(SpyVaultDepositTableMap::COL_ID_VAULT_DEPOSIT);
            $criteria->removeSelectColumn(SpyVaultDepositTableMap::COL_DATA_TYPE);
            $criteria->removeSelectColumn(SpyVaultDepositTableMap::COL_DATA_KEY);
            $criteria->removeSelectColumn(SpyVaultDepositTableMap::COL_INITIAL_VECTOR);
            $criteria->removeSelectColumn(SpyVaultDepositTableMap::COL_CIPHER_TEXT);
            $criteria->removeSelectColumn(SpyVaultDepositTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyVaultDepositTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_vault_deposit');
            $criteria->removeSelectColumn($alias . '.data_type');
            $criteria->removeSelectColumn($alias . '.data_key');
            $criteria->removeSelectColumn($alias . '.initial_vector');
            $criteria->removeSelectColumn($alias . '.cipher_text');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyVaultDepositTableMap::DATABASE_NAME)->getTable(SpyVaultDepositTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyVaultDeposit or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyVaultDeposit object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyVaultDepositTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Vault\Persistence\SpyVaultDeposit) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyVaultDepositTableMap::DATABASE_NAME);
            $criteria->add(SpyVaultDepositTableMap::COL_ID_VAULT_DEPOSIT, (array) $values, Criteria::IN);
        }

        $query = SpyVaultDepositQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyVaultDepositTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyVaultDepositTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_vault_deposit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyVaultDepositQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyVaultDeposit or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyVaultDeposit object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyVaultDepositTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyVaultDeposit object
        }


        // Set the correct dbName
        $query = SpyVaultDepositQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
