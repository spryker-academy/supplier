<?php

namespace Orm\Zed\Discount\Persistence\Map;

use Orm\Zed\Discount\Persistence\SpyDiscountVoucher;
use Orm\Zed\Discount\Persistence\SpyDiscountVoucherQuery;
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
 * This class defines the structure of the 'spy_discount_voucher' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyDiscountVoucherTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Discount.Persistence.Map.SpyDiscountVoucherTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_discount_voucher';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyDiscountVoucher';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Discount\\Persistence\\SpyDiscountVoucher';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Discount.Persistence.SpyDiscountVoucher';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id_discount_voucher field
     */
    public const COL_ID_DISCOUNT_VOUCHER = 'spy_discount_voucher.id_discount_voucher';

    /**
     * the column name for the fk_discount_voucher_pool field
     */
    public const COL_FK_DISCOUNT_VOUCHER_POOL = 'spy_discount_voucher.fk_discount_voucher_pool';

    /**
     * the column name for the code field
     */
    public const COL_CODE = 'spy_discount_voucher.code';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_discount_voucher.is_active';

    /**
     * the column name for the max_number_of_uses field
     */
    public const COL_MAX_NUMBER_OF_USES = 'spy_discount_voucher.max_number_of_uses';

    /**
     * the column name for the number_of_uses field
     */
    public const COL_NUMBER_OF_USES = 'spy_discount_voucher.number_of_uses';

    /**
     * the column name for the voucher_batch field
     */
    public const COL_VOUCHER_BATCH = 'spy_discount_voucher.voucher_batch';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_discount_voucher.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_discount_voucher.updated_at';

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
        self::TYPE_PHPNAME       => ['IdDiscountVoucher', 'FkDiscountVoucherPool', 'Code', 'IsActive', 'MaxNumberOfUses', 'NumberOfUses', 'VoucherBatch', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idDiscountVoucher', 'fkDiscountVoucherPool', 'code', 'isActive', 'maxNumberOfUses', 'numberOfUses', 'voucherBatch', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyDiscountVoucherTableMap::COL_ID_DISCOUNT_VOUCHER, SpyDiscountVoucherTableMap::COL_FK_DISCOUNT_VOUCHER_POOL, SpyDiscountVoucherTableMap::COL_CODE, SpyDiscountVoucherTableMap::COL_IS_ACTIVE, SpyDiscountVoucherTableMap::COL_MAX_NUMBER_OF_USES, SpyDiscountVoucherTableMap::COL_NUMBER_OF_USES, SpyDiscountVoucherTableMap::COL_VOUCHER_BATCH, SpyDiscountVoucherTableMap::COL_CREATED_AT, SpyDiscountVoucherTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_discount_voucher', 'fk_discount_voucher_pool', 'code', 'is_active', 'max_number_of_uses', 'number_of_uses', 'voucher_batch', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
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
        self::TYPE_PHPNAME       => ['IdDiscountVoucher' => 0, 'FkDiscountVoucherPool' => 1, 'Code' => 2, 'IsActive' => 3, 'MaxNumberOfUses' => 4, 'NumberOfUses' => 5, 'VoucherBatch' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ],
        self::TYPE_CAMELNAME     => ['idDiscountVoucher' => 0, 'fkDiscountVoucherPool' => 1, 'code' => 2, 'isActive' => 3, 'maxNumberOfUses' => 4, 'numberOfUses' => 5, 'voucherBatch' => 6, 'createdAt' => 7, 'updatedAt' => 8, ],
        self::TYPE_COLNAME       => [SpyDiscountVoucherTableMap::COL_ID_DISCOUNT_VOUCHER => 0, SpyDiscountVoucherTableMap::COL_FK_DISCOUNT_VOUCHER_POOL => 1, SpyDiscountVoucherTableMap::COL_CODE => 2, SpyDiscountVoucherTableMap::COL_IS_ACTIVE => 3, SpyDiscountVoucherTableMap::COL_MAX_NUMBER_OF_USES => 4, SpyDiscountVoucherTableMap::COL_NUMBER_OF_USES => 5, SpyDiscountVoucherTableMap::COL_VOUCHER_BATCH => 6, SpyDiscountVoucherTableMap::COL_CREATED_AT => 7, SpyDiscountVoucherTableMap::COL_UPDATED_AT => 8, ],
        self::TYPE_FIELDNAME     => ['id_discount_voucher' => 0, 'fk_discount_voucher_pool' => 1, 'code' => 2, 'is_active' => 3, 'max_number_of_uses' => 4, 'number_of_uses' => 5, 'voucher_batch' => 6, 'created_at' => 7, 'updated_at' => 8, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdDiscountVoucher' => 'ID_DISCOUNT_VOUCHER',
        'SpyDiscountVoucher.IdDiscountVoucher' => 'ID_DISCOUNT_VOUCHER',
        'idDiscountVoucher' => 'ID_DISCOUNT_VOUCHER',
        'spyDiscountVoucher.idDiscountVoucher' => 'ID_DISCOUNT_VOUCHER',
        'SpyDiscountVoucherTableMap::COL_ID_DISCOUNT_VOUCHER' => 'ID_DISCOUNT_VOUCHER',
        'COL_ID_DISCOUNT_VOUCHER' => 'ID_DISCOUNT_VOUCHER',
        'id_discount_voucher' => 'ID_DISCOUNT_VOUCHER',
        'spy_discount_voucher.id_discount_voucher' => 'ID_DISCOUNT_VOUCHER',
        'FkDiscountVoucherPool' => 'FK_DISCOUNT_VOUCHER_POOL',
        'SpyDiscountVoucher.FkDiscountVoucherPool' => 'FK_DISCOUNT_VOUCHER_POOL',
        'fkDiscountVoucherPool' => 'FK_DISCOUNT_VOUCHER_POOL',
        'spyDiscountVoucher.fkDiscountVoucherPool' => 'FK_DISCOUNT_VOUCHER_POOL',
        'SpyDiscountVoucherTableMap::COL_FK_DISCOUNT_VOUCHER_POOL' => 'FK_DISCOUNT_VOUCHER_POOL',
        'COL_FK_DISCOUNT_VOUCHER_POOL' => 'FK_DISCOUNT_VOUCHER_POOL',
        'fk_discount_voucher_pool' => 'FK_DISCOUNT_VOUCHER_POOL',
        'spy_discount_voucher.fk_discount_voucher_pool' => 'FK_DISCOUNT_VOUCHER_POOL',
        'Code' => 'CODE',
        'SpyDiscountVoucher.Code' => 'CODE',
        'code' => 'CODE',
        'spyDiscountVoucher.code' => 'CODE',
        'SpyDiscountVoucherTableMap::COL_CODE' => 'CODE',
        'COL_CODE' => 'CODE',
        'spy_discount_voucher.code' => 'CODE',
        'IsActive' => 'IS_ACTIVE',
        'SpyDiscountVoucher.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyDiscountVoucher.isActive' => 'IS_ACTIVE',
        'SpyDiscountVoucherTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_discount_voucher.is_active' => 'IS_ACTIVE',
        'MaxNumberOfUses' => 'MAX_NUMBER_OF_USES',
        'SpyDiscountVoucher.MaxNumberOfUses' => 'MAX_NUMBER_OF_USES',
        'maxNumberOfUses' => 'MAX_NUMBER_OF_USES',
        'spyDiscountVoucher.maxNumberOfUses' => 'MAX_NUMBER_OF_USES',
        'SpyDiscountVoucherTableMap::COL_MAX_NUMBER_OF_USES' => 'MAX_NUMBER_OF_USES',
        'COL_MAX_NUMBER_OF_USES' => 'MAX_NUMBER_OF_USES',
        'max_number_of_uses' => 'MAX_NUMBER_OF_USES',
        'spy_discount_voucher.max_number_of_uses' => 'MAX_NUMBER_OF_USES',
        'NumberOfUses' => 'NUMBER_OF_USES',
        'SpyDiscountVoucher.NumberOfUses' => 'NUMBER_OF_USES',
        'numberOfUses' => 'NUMBER_OF_USES',
        'spyDiscountVoucher.numberOfUses' => 'NUMBER_OF_USES',
        'SpyDiscountVoucherTableMap::COL_NUMBER_OF_USES' => 'NUMBER_OF_USES',
        'COL_NUMBER_OF_USES' => 'NUMBER_OF_USES',
        'number_of_uses' => 'NUMBER_OF_USES',
        'spy_discount_voucher.number_of_uses' => 'NUMBER_OF_USES',
        'VoucherBatch' => 'VOUCHER_BATCH',
        'SpyDiscountVoucher.VoucherBatch' => 'VOUCHER_BATCH',
        'voucherBatch' => 'VOUCHER_BATCH',
        'spyDiscountVoucher.voucherBatch' => 'VOUCHER_BATCH',
        'SpyDiscountVoucherTableMap::COL_VOUCHER_BATCH' => 'VOUCHER_BATCH',
        'COL_VOUCHER_BATCH' => 'VOUCHER_BATCH',
        'voucher_batch' => 'VOUCHER_BATCH',
        'spy_discount_voucher.voucher_batch' => 'VOUCHER_BATCH',
        'CreatedAt' => 'CREATED_AT',
        'SpyDiscountVoucher.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyDiscountVoucher.createdAt' => 'CREATED_AT',
        'SpyDiscountVoucherTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_discount_voucher.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyDiscountVoucher.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyDiscountVoucher.updatedAt' => 'UPDATED_AT',
        'SpyDiscountVoucherTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_discount_voucher.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_discount_voucher');
        $this->setPhpName('SpyDiscountVoucher');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\Discount\\Persistence\\SpyDiscountVoucher');
        $this->setPackage('src.Orm.Zed.Discount.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_discount_voucher_pk_seq');
        // columns
        $this->addPrimaryKey('id_discount_voucher', 'IdDiscountVoucher', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_discount_voucher_pool', 'FkDiscountVoucherPool', 'INTEGER', 'spy_discount_voucher_pool', 'id_discount_voucher_pool', false, null, null);
        $this->addColumn('code', 'Code', 'VARCHAR', true, 255, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', false, 1, false);
        $this->addColumn('max_number_of_uses', 'MaxNumberOfUses', 'INTEGER', false, null, null);
        $this->addColumn('number_of_uses', 'NumberOfUses', 'INTEGER', false, null, null);
        $this->addColumn('voucher_batch', 'VoucherBatch', 'INTEGER', false, null, 0);
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
        $this->addRelation('VoucherPool', '\\Orm\\Zed\\Discount\\Persistence\\SpyDiscountVoucherPool', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_discount_voucher_pool',
    1 => ':id_discount_voucher_pool',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountVoucher', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountVoucher', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountVoucher', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountVoucher', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountVoucher', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDiscountVoucher', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdDiscountVoucher', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyDiscountVoucherTableMap::CLASS_DEFAULT : SpyDiscountVoucherTableMap::OM_CLASS;
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
     * @return array (SpyDiscountVoucher object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyDiscountVoucherTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyDiscountVoucherTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyDiscountVoucherTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyDiscountVoucherTableMap::OM_CLASS;
            /** @var SpyDiscountVoucher $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyDiscountVoucherTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyDiscountVoucherTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyDiscountVoucherTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyDiscountVoucher $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyDiscountVoucherTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyDiscountVoucherTableMap::COL_ID_DISCOUNT_VOUCHER);
            $criteria->addSelectColumn(SpyDiscountVoucherTableMap::COL_FK_DISCOUNT_VOUCHER_POOL);
            $criteria->addSelectColumn(SpyDiscountVoucherTableMap::COL_CODE);
            $criteria->addSelectColumn(SpyDiscountVoucherTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyDiscountVoucherTableMap::COL_MAX_NUMBER_OF_USES);
            $criteria->addSelectColumn(SpyDiscountVoucherTableMap::COL_NUMBER_OF_USES);
            $criteria->addSelectColumn(SpyDiscountVoucherTableMap::COL_VOUCHER_BATCH);
            $criteria->addSelectColumn(SpyDiscountVoucherTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyDiscountVoucherTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_discount_voucher');
            $criteria->addSelectColumn($alias . '.fk_discount_voucher_pool');
            $criteria->addSelectColumn($alias . '.code');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.max_number_of_uses');
            $criteria->addSelectColumn($alias . '.number_of_uses');
            $criteria->addSelectColumn($alias . '.voucher_batch');
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
            $criteria->removeSelectColumn(SpyDiscountVoucherTableMap::COL_ID_DISCOUNT_VOUCHER);
            $criteria->removeSelectColumn(SpyDiscountVoucherTableMap::COL_FK_DISCOUNT_VOUCHER_POOL);
            $criteria->removeSelectColumn(SpyDiscountVoucherTableMap::COL_CODE);
            $criteria->removeSelectColumn(SpyDiscountVoucherTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyDiscountVoucherTableMap::COL_MAX_NUMBER_OF_USES);
            $criteria->removeSelectColumn(SpyDiscountVoucherTableMap::COL_NUMBER_OF_USES);
            $criteria->removeSelectColumn(SpyDiscountVoucherTableMap::COL_VOUCHER_BATCH);
            $criteria->removeSelectColumn(SpyDiscountVoucherTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyDiscountVoucherTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_discount_voucher');
            $criteria->removeSelectColumn($alias . '.fk_discount_voucher_pool');
            $criteria->removeSelectColumn($alias . '.code');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.max_number_of_uses');
            $criteria->removeSelectColumn($alias . '.number_of_uses');
            $criteria->removeSelectColumn($alias . '.voucher_batch');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyDiscountVoucherTableMap::DATABASE_NAME)->getTable(SpyDiscountVoucherTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyDiscountVoucher or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyDiscountVoucher object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDiscountVoucherTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Discount\Persistence\SpyDiscountVoucher) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyDiscountVoucherTableMap::DATABASE_NAME);
            $criteria->add(SpyDiscountVoucherTableMap::COL_ID_DISCOUNT_VOUCHER, (array) $values, Criteria::IN);
        }

        $query = SpyDiscountVoucherQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyDiscountVoucherTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyDiscountVoucherTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_discount_voucher table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyDiscountVoucherQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyDiscountVoucher or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyDiscountVoucher object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDiscountVoucherTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyDiscountVoucher object
        }

        if ($criteria->containsKey(SpyDiscountVoucherTableMap::COL_ID_DISCOUNT_VOUCHER) && $criteria->keyContainsValue(SpyDiscountVoucherTableMap::COL_ID_DISCOUNT_VOUCHER) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyDiscountVoucherTableMap::COL_ID_DISCOUNT_VOUCHER.')');
        }


        // Set the correct dbName
        $query = SpyDiscountVoucherQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
