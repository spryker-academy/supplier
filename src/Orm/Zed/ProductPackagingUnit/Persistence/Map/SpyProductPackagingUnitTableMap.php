<?php

namespace Orm\Zed\ProductPackagingUnit\Persistence\Map;

use Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnit;
use Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnitQuery;
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
 * This class defines the structure of the 'spy_product_packaging_unit' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductPackagingUnitTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductPackagingUnit.Persistence.Map.SpyProductPackagingUnitTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_packaging_unit';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductPackagingUnit';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductPackagingUnit\\Persistence\\SpyProductPackagingUnit';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductPackagingUnit.Persistence.SpyProductPackagingUnit';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the id_product_packaging_unit field
     */
    public const COL_ID_PRODUCT_PACKAGING_UNIT = 'spy_product_packaging_unit.id_product_packaging_unit';

    /**
     * the column name for the fk_lead_product field
     */
    public const COL_FK_LEAD_PRODUCT = 'spy_product_packaging_unit.fk_lead_product';

    /**
     * the column name for the fk_product field
     */
    public const COL_FK_PRODUCT = 'spy_product_packaging_unit.fk_product';

    /**
     * the column name for the fk_product_packaging_unit_type field
     */
    public const COL_FK_PRODUCT_PACKAGING_UNIT_TYPE = 'spy_product_packaging_unit.fk_product_packaging_unit_type';

    /**
     * the column name for the amount_interval field
     */
    public const COL_AMOUNT_INTERVAL = 'spy_product_packaging_unit.amount_interval';

    /**
     * the column name for the amount_max field
     */
    public const COL_AMOUNT_MAX = 'spy_product_packaging_unit.amount_max';

    /**
     * the column name for the amount_min field
     */
    public const COL_AMOUNT_MIN = 'spy_product_packaging_unit.amount_min';

    /**
     * the column name for the default_amount field
     */
    public const COL_DEFAULT_AMOUNT = 'spy_product_packaging_unit.default_amount';

    /**
     * the column name for the is_amount_variable field
     */
    public const COL_IS_AMOUNT_VARIABLE = 'spy_product_packaging_unit.is_amount_variable';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_packaging_unit.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_packaging_unit.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductPackagingUnit', 'FkLeadProduct', 'FkProduct', 'FkProductPackagingUnitType', 'AmountInterval', 'AmountMax', 'AmountMin', 'DefaultAmount', 'IsAmountVariable', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductPackagingUnit', 'fkLeadProduct', 'fkProduct', 'fkProductPackagingUnitType', 'amountInterval', 'amountMax', 'amountMin', 'defaultAmount', 'isAmountVariable', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT, SpyProductPackagingUnitTableMap::COL_FK_LEAD_PRODUCT, SpyProductPackagingUnitTableMap::COL_FK_PRODUCT, SpyProductPackagingUnitTableMap::COL_FK_PRODUCT_PACKAGING_UNIT_TYPE, SpyProductPackagingUnitTableMap::COL_AMOUNT_INTERVAL, SpyProductPackagingUnitTableMap::COL_AMOUNT_MAX, SpyProductPackagingUnitTableMap::COL_AMOUNT_MIN, SpyProductPackagingUnitTableMap::COL_DEFAULT_AMOUNT, SpyProductPackagingUnitTableMap::COL_IS_AMOUNT_VARIABLE, SpyProductPackagingUnitTableMap::COL_CREATED_AT, SpyProductPackagingUnitTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_packaging_unit', 'fk_lead_product', 'fk_product', 'fk_product_packaging_unit_type', 'amount_interval', 'amount_max', 'amount_min', 'default_amount', 'is_amount_variable', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
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
        self::TYPE_PHPNAME       => ['IdProductPackagingUnit' => 0, 'FkLeadProduct' => 1, 'FkProduct' => 2, 'FkProductPackagingUnitType' => 3, 'AmountInterval' => 4, 'AmountMax' => 5, 'AmountMin' => 6, 'DefaultAmount' => 7, 'IsAmountVariable' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ],
        self::TYPE_CAMELNAME     => ['idProductPackagingUnit' => 0, 'fkLeadProduct' => 1, 'fkProduct' => 2, 'fkProductPackagingUnitType' => 3, 'amountInterval' => 4, 'amountMax' => 5, 'amountMin' => 6, 'defaultAmount' => 7, 'isAmountVariable' => 8, 'createdAt' => 9, 'updatedAt' => 10, ],
        self::TYPE_COLNAME       => [SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT => 0, SpyProductPackagingUnitTableMap::COL_FK_LEAD_PRODUCT => 1, SpyProductPackagingUnitTableMap::COL_FK_PRODUCT => 2, SpyProductPackagingUnitTableMap::COL_FK_PRODUCT_PACKAGING_UNIT_TYPE => 3, SpyProductPackagingUnitTableMap::COL_AMOUNT_INTERVAL => 4, SpyProductPackagingUnitTableMap::COL_AMOUNT_MAX => 5, SpyProductPackagingUnitTableMap::COL_AMOUNT_MIN => 6, SpyProductPackagingUnitTableMap::COL_DEFAULT_AMOUNT => 7, SpyProductPackagingUnitTableMap::COL_IS_AMOUNT_VARIABLE => 8, SpyProductPackagingUnitTableMap::COL_CREATED_AT => 9, SpyProductPackagingUnitTableMap::COL_UPDATED_AT => 10, ],
        self::TYPE_FIELDNAME     => ['id_product_packaging_unit' => 0, 'fk_lead_product' => 1, 'fk_product' => 2, 'fk_product_packaging_unit_type' => 3, 'amount_interval' => 4, 'amount_max' => 5, 'amount_min' => 6, 'default_amount' => 7, 'is_amount_variable' => 8, 'created_at' => 9, 'updated_at' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductPackagingUnit' => 'ID_PRODUCT_PACKAGING_UNIT',
        'SpyProductPackagingUnit.IdProductPackagingUnit' => 'ID_PRODUCT_PACKAGING_UNIT',
        'idProductPackagingUnit' => 'ID_PRODUCT_PACKAGING_UNIT',
        'spyProductPackagingUnit.idProductPackagingUnit' => 'ID_PRODUCT_PACKAGING_UNIT',
        'SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT' => 'ID_PRODUCT_PACKAGING_UNIT',
        'COL_ID_PRODUCT_PACKAGING_UNIT' => 'ID_PRODUCT_PACKAGING_UNIT',
        'id_product_packaging_unit' => 'ID_PRODUCT_PACKAGING_UNIT',
        'spy_product_packaging_unit.id_product_packaging_unit' => 'ID_PRODUCT_PACKAGING_UNIT',
        'FkLeadProduct' => 'FK_LEAD_PRODUCT',
        'SpyProductPackagingUnit.FkLeadProduct' => 'FK_LEAD_PRODUCT',
        'fkLeadProduct' => 'FK_LEAD_PRODUCT',
        'spyProductPackagingUnit.fkLeadProduct' => 'FK_LEAD_PRODUCT',
        'SpyProductPackagingUnitTableMap::COL_FK_LEAD_PRODUCT' => 'FK_LEAD_PRODUCT',
        'COL_FK_LEAD_PRODUCT' => 'FK_LEAD_PRODUCT',
        'fk_lead_product' => 'FK_LEAD_PRODUCT',
        'spy_product_packaging_unit.fk_lead_product' => 'FK_LEAD_PRODUCT',
        'FkProduct' => 'FK_PRODUCT',
        'SpyProductPackagingUnit.FkProduct' => 'FK_PRODUCT',
        'fkProduct' => 'FK_PRODUCT',
        'spyProductPackagingUnit.fkProduct' => 'FK_PRODUCT',
        'SpyProductPackagingUnitTableMap::COL_FK_PRODUCT' => 'FK_PRODUCT',
        'COL_FK_PRODUCT' => 'FK_PRODUCT',
        'fk_product' => 'FK_PRODUCT',
        'spy_product_packaging_unit.fk_product' => 'FK_PRODUCT',
        'FkProductPackagingUnitType' => 'FK_PRODUCT_PACKAGING_UNIT_TYPE',
        'SpyProductPackagingUnit.FkProductPackagingUnitType' => 'FK_PRODUCT_PACKAGING_UNIT_TYPE',
        'fkProductPackagingUnitType' => 'FK_PRODUCT_PACKAGING_UNIT_TYPE',
        'spyProductPackagingUnit.fkProductPackagingUnitType' => 'FK_PRODUCT_PACKAGING_UNIT_TYPE',
        'SpyProductPackagingUnitTableMap::COL_FK_PRODUCT_PACKAGING_UNIT_TYPE' => 'FK_PRODUCT_PACKAGING_UNIT_TYPE',
        'COL_FK_PRODUCT_PACKAGING_UNIT_TYPE' => 'FK_PRODUCT_PACKAGING_UNIT_TYPE',
        'fk_product_packaging_unit_type' => 'FK_PRODUCT_PACKAGING_UNIT_TYPE',
        'spy_product_packaging_unit.fk_product_packaging_unit_type' => 'FK_PRODUCT_PACKAGING_UNIT_TYPE',
        'AmountInterval' => 'AMOUNT_INTERVAL',
        'SpyProductPackagingUnit.AmountInterval' => 'AMOUNT_INTERVAL',
        'amountInterval' => 'AMOUNT_INTERVAL',
        'spyProductPackagingUnit.amountInterval' => 'AMOUNT_INTERVAL',
        'SpyProductPackagingUnitTableMap::COL_AMOUNT_INTERVAL' => 'AMOUNT_INTERVAL',
        'COL_AMOUNT_INTERVAL' => 'AMOUNT_INTERVAL',
        'amount_interval' => 'AMOUNT_INTERVAL',
        'spy_product_packaging_unit.amount_interval' => 'AMOUNT_INTERVAL',
        'AmountMax' => 'AMOUNT_MAX',
        'SpyProductPackagingUnit.AmountMax' => 'AMOUNT_MAX',
        'amountMax' => 'AMOUNT_MAX',
        'spyProductPackagingUnit.amountMax' => 'AMOUNT_MAX',
        'SpyProductPackagingUnitTableMap::COL_AMOUNT_MAX' => 'AMOUNT_MAX',
        'COL_AMOUNT_MAX' => 'AMOUNT_MAX',
        'amount_max' => 'AMOUNT_MAX',
        'spy_product_packaging_unit.amount_max' => 'AMOUNT_MAX',
        'AmountMin' => 'AMOUNT_MIN',
        'SpyProductPackagingUnit.AmountMin' => 'AMOUNT_MIN',
        'amountMin' => 'AMOUNT_MIN',
        'spyProductPackagingUnit.amountMin' => 'AMOUNT_MIN',
        'SpyProductPackagingUnitTableMap::COL_AMOUNT_MIN' => 'AMOUNT_MIN',
        'COL_AMOUNT_MIN' => 'AMOUNT_MIN',
        'amount_min' => 'AMOUNT_MIN',
        'spy_product_packaging_unit.amount_min' => 'AMOUNT_MIN',
        'DefaultAmount' => 'DEFAULT_AMOUNT',
        'SpyProductPackagingUnit.DefaultAmount' => 'DEFAULT_AMOUNT',
        'defaultAmount' => 'DEFAULT_AMOUNT',
        'spyProductPackagingUnit.defaultAmount' => 'DEFAULT_AMOUNT',
        'SpyProductPackagingUnitTableMap::COL_DEFAULT_AMOUNT' => 'DEFAULT_AMOUNT',
        'COL_DEFAULT_AMOUNT' => 'DEFAULT_AMOUNT',
        'default_amount' => 'DEFAULT_AMOUNT',
        'spy_product_packaging_unit.default_amount' => 'DEFAULT_AMOUNT',
        'IsAmountVariable' => 'IS_AMOUNT_VARIABLE',
        'SpyProductPackagingUnit.IsAmountVariable' => 'IS_AMOUNT_VARIABLE',
        'isAmountVariable' => 'IS_AMOUNT_VARIABLE',
        'spyProductPackagingUnit.isAmountVariable' => 'IS_AMOUNT_VARIABLE',
        'SpyProductPackagingUnitTableMap::COL_IS_AMOUNT_VARIABLE' => 'IS_AMOUNT_VARIABLE',
        'COL_IS_AMOUNT_VARIABLE' => 'IS_AMOUNT_VARIABLE',
        'is_amount_variable' => 'IS_AMOUNT_VARIABLE',
        'spy_product_packaging_unit.is_amount_variable' => 'IS_AMOUNT_VARIABLE',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductPackagingUnit.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductPackagingUnit.createdAt' => 'CREATED_AT',
        'SpyProductPackagingUnitTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_packaging_unit.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductPackagingUnit.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductPackagingUnit.updatedAt' => 'UPDATED_AT',
        'SpyProductPackagingUnitTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_packaging_unit.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_packaging_unit');
        $this->setPhpName('SpyProductPackagingUnit');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ProductPackagingUnit\\Persistence\\SpyProductPackagingUnit');
        $this->setPackage('src.Orm.Zed.ProductPackagingUnit.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_packaging_unit_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_packaging_unit', 'IdProductPackagingUnit', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_lead_product', 'FkLeadProduct', 'INTEGER', 'spy_product', 'id_product', true, null, null);
        $this->addForeignKey('fk_product', 'FkProduct', 'INTEGER', 'spy_product', 'id_product', true, null, null);
        $this->addForeignKey('fk_product_packaging_unit_type', 'FkProductPackagingUnitType', 'INTEGER', 'spy_product_packaging_unit_type', 'id_product_packaging_unit_type', true, null, null);
        $this->addColumn('amount_interval', 'AmountInterval', 'DECIMAL', false, 20, null);
        $this->addColumn('amount_max', 'AmountMax', 'DECIMAL', false, 20, null);
        $this->addColumn('amount_min', 'AmountMin', 'DECIMAL', false, 20, null);
        $this->addColumn('default_amount', 'DefaultAmount', 'DECIMAL', true, 20, null);
        $this->addColumn('is_amount_variable', 'IsAmountVariable', 'BOOLEAN', true, 1, null);
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
        $this->addRelation('Product', '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, null, false);
        $this->addRelation('LeadProduct', '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_lead_product',
    1 => ':id_product',
  ),
), null, null, null, false);
        $this->addRelation('ProductPackagingUnitType', '\\Orm\\Zed\\ProductPackagingUnit\\Persistence\\SpyProductPackagingUnitType', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_packaging_unit_type',
    1 => ':id_product_packaging_unit_type',
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
            'event' => ['spy_product_packaging_unit_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductPackagingUnit', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductPackagingUnit', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductPackagingUnit', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductPackagingUnit', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductPackagingUnit', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductPackagingUnit', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductPackagingUnit', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductPackagingUnitTableMap::CLASS_DEFAULT : SpyProductPackagingUnitTableMap::OM_CLASS;
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
     * @return array (SpyProductPackagingUnit object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductPackagingUnitTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductPackagingUnitTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductPackagingUnitTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductPackagingUnitTableMap::OM_CLASS;
            /** @var SpyProductPackagingUnit $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductPackagingUnitTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductPackagingUnitTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductPackagingUnitTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductPackagingUnit $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductPackagingUnitTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT);
            $criteria->addSelectColumn(SpyProductPackagingUnitTableMap::COL_FK_LEAD_PRODUCT);
            $criteria->addSelectColumn(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT);
            $criteria->addSelectColumn(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT_PACKAGING_UNIT_TYPE);
            $criteria->addSelectColumn(SpyProductPackagingUnitTableMap::COL_AMOUNT_INTERVAL);
            $criteria->addSelectColumn(SpyProductPackagingUnitTableMap::COL_AMOUNT_MAX);
            $criteria->addSelectColumn(SpyProductPackagingUnitTableMap::COL_AMOUNT_MIN);
            $criteria->addSelectColumn(SpyProductPackagingUnitTableMap::COL_DEFAULT_AMOUNT);
            $criteria->addSelectColumn(SpyProductPackagingUnitTableMap::COL_IS_AMOUNT_VARIABLE);
            $criteria->addSelectColumn(SpyProductPackagingUnitTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductPackagingUnitTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_packaging_unit');
            $criteria->addSelectColumn($alias . '.fk_lead_product');
            $criteria->addSelectColumn($alias . '.fk_product');
            $criteria->addSelectColumn($alias . '.fk_product_packaging_unit_type');
            $criteria->addSelectColumn($alias . '.amount_interval');
            $criteria->addSelectColumn($alias . '.amount_max');
            $criteria->addSelectColumn($alias . '.amount_min');
            $criteria->addSelectColumn($alias . '.default_amount');
            $criteria->addSelectColumn($alias . '.is_amount_variable');
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
            $criteria->removeSelectColumn(SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT);
            $criteria->removeSelectColumn(SpyProductPackagingUnitTableMap::COL_FK_LEAD_PRODUCT);
            $criteria->removeSelectColumn(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT);
            $criteria->removeSelectColumn(SpyProductPackagingUnitTableMap::COL_FK_PRODUCT_PACKAGING_UNIT_TYPE);
            $criteria->removeSelectColumn(SpyProductPackagingUnitTableMap::COL_AMOUNT_INTERVAL);
            $criteria->removeSelectColumn(SpyProductPackagingUnitTableMap::COL_AMOUNT_MAX);
            $criteria->removeSelectColumn(SpyProductPackagingUnitTableMap::COL_AMOUNT_MIN);
            $criteria->removeSelectColumn(SpyProductPackagingUnitTableMap::COL_DEFAULT_AMOUNT);
            $criteria->removeSelectColumn(SpyProductPackagingUnitTableMap::COL_IS_AMOUNT_VARIABLE);
            $criteria->removeSelectColumn(SpyProductPackagingUnitTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductPackagingUnitTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_packaging_unit');
            $criteria->removeSelectColumn($alias . '.fk_lead_product');
            $criteria->removeSelectColumn($alias . '.fk_product');
            $criteria->removeSelectColumn($alias . '.fk_product_packaging_unit_type');
            $criteria->removeSelectColumn($alias . '.amount_interval');
            $criteria->removeSelectColumn($alias . '.amount_max');
            $criteria->removeSelectColumn($alias . '.amount_min');
            $criteria->removeSelectColumn($alias . '.default_amount');
            $criteria->removeSelectColumn($alias . '.is_amount_variable');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductPackagingUnitTableMap::DATABASE_NAME)->getTable(SpyProductPackagingUnitTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductPackagingUnit or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductPackagingUnit object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductPackagingUnitTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductPackagingUnit\Persistence\SpyProductPackagingUnit) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductPackagingUnitTableMap::DATABASE_NAME);
            $criteria->add(SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT, (array) $values, Criteria::IN);
        }

        $query = SpyProductPackagingUnitQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductPackagingUnitTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductPackagingUnitTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_packaging_unit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductPackagingUnitQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductPackagingUnit or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductPackagingUnit object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductPackagingUnitTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductPackagingUnit object
        }

        if ($criteria->containsKey(SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT) && $criteria->keyContainsValue(SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyProductPackagingUnitTableMap::COL_ID_PRODUCT_PACKAGING_UNIT.')');
        }


        // Set the correct dbName
        $query = SpyProductPackagingUnitQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
