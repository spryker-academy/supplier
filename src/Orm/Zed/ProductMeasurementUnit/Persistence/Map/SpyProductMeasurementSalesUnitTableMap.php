<?php

namespace Orm\Zed\ProductMeasurementUnit\Persistence\Map;

use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnit;
use Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnitQuery;
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
 * This class defines the structure of the 'spy_product_measurement_sales_unit' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductMeasurementSalesUnitTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductMeasurementUnit.Persistence.Map.SpyProductMeasurementSalesUnitTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_measurement_sales_unit';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductMeasurementSalesUnit';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductMeasurementUnit\\Persistence\\SpyProductMeasurementSalesUnit';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductMeasurementUnit.Persistence.SpyProductMeasurementSalesUnit';

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
     * the column name for the id_product_measurement_sales_unit field
     */
    public const COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT = 'spy_product_measurement_sales_unit.id_product_measurement_sales_unit';

    /**
     * the column name for the fk_product field
     */
    public const COL_FK_PRODUCT = 'spy_product_measurement_sales_unit.fk_product';

    /**
     * the column name for the fk_product_measurement_base_unit field
     */
    public const COL_FK_PRODUCT_MEASUREMENT_BASE_UNIT = 'spy_product_measurement_sales_unit.fk_product_measurement_base_unit';

    /**
     * the column name for the fk_product_measurement_unit field
     */
    public const COL_FK_PRODUCT_MEASUREMENT_UNIT = 'spy_product_measurement_sales_unit.fk_product_measurement_unit';

    /**
     * the column name for the conversion field
     */
    public const COL_CONVERSION = 'spy_product_measurement_sales_unit.conversion';

    /**
     * the column name for the is_default field
     */
    public const COL_IS_DEFAULT = 'spy_product_measurement_sales_unit.is_default';

    /**
     * the column name for the is_displayed field
     */
    public const COL_IS_DISPLAYED = 'spy_product_measurement_sales_unit.is_displayed';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_product_measurement_sales_unit.key';

    /**
     * the column name for the precision field
     */
    public const COL_PRECISION = 'spy_product_measurement_sales_unit.precision';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_measurement_sales_unit.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_measurement_sales_unit.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductMeasurementSalesUnit', 'FkProduct', 'FkProductMeasurementBaseUnit', 'FkProductMeasurementUnit', 'Conversion', 'IsDefault', 'IsDisplayed', 'Key', 'Precision', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductMeasurementSalesUnit', 'fkProduct', 'fkProductMeasurementBaseUnit', 'fkProductMeasurementUnit', 'conversion', 'isDefault', 'isDisplayed', 'key', 'precision', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT, SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT, SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_BASE_UNIT, SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT, SpyProductMeasurementSalesUnitTableMap::COL_CONVERSION, SpyProductMeasurementSalesUnitTableMap::COL_IS_DEFAULT, SpyProductMeasurementSalesUnitTableMap::COL_IS_DISPLAYED, SpyProductMeasurementSalesUnitTableMap::COL_KEY, SpyProductMeasurementSalesUnitTableMap::COL_PRECISION, SpyProductMeasurementSalesUnitTableMap::COL_CREATED_AT, SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_measurement_sales_unit', 'fk_product', 'fk_product_measurement_base_unit', 'fk_product_measurement_unit', 'conversion', 'is_default', 'is_displayed', 'key', 'precision', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProductMeasurementSalesUnit' => 0, 'FkProduct' => 1, 'FkProductMeasurementBaseUnit' => 2, 'FkProductMeasurementUnit' => 3, 'Conversion' => 4, 'IsDefault' => 5, 'IsDisplayed' => 6, 'Key' => 7, 'Precision' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ],
        self::TYPE_CAMELNAME     => ['idProductMeasurementSalesUnit' => 0, 'fkProduct' => 1, 'fkProductMeasurementBaseUnit' => 2, 'fkProductMeasurementUnit' => 3, 'conversion' => 4, 'isDefault' => 5, 'isDisplayed' => 6, 'key' => 7, 'precision' => 8, 'createdAt' => 9, 'updatedAt' => 10, ],
        self::TYPE_COLNAME       => [SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT => 0, SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT => 1, SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_BASE_UNIT => 2, SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT => 3, SpyProductMeasurementSalesUnitTableMap::COL_CONVERSION => 4, SpyProductMeasurementSalesUnitTableMap::COL_IS_DEFAULT => 5, SpyProductMeasurementSalesUnitTableMap::COL_IS_DISPLAYED => 6, SpyProductMeasurementSalesUnitTableMap::COL_KEY => 7, SpyProductMeasurementSalesUnitTableMap::COL_PRECISION => 8, SpyProductMeasurementSalesUnitTableMap::COL_CREATED_AT => 9, SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT => 10, ],
        self::TYPE_FIELDNAME     => ['id_product_measurement_sales_unit' => 0, 'fk_product' => 1, 'fk_product_measurement_base_unit' => 2, 'fk_product_measurement_unit' => 3, 'conversion' => 4, 'is_default' => 5, 'is_displayed' => 6, 'key' => 7, 'precision' => 8, 'created_at' => 9, 'updated_at' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductMeasurementSalesUnit' => 'ID_PRODUCT_MEASUREMENT_SALES_UNIT',
        'SpyProductMeasurementSalesUnit.IdProductMeasurementSalesUnit' => 'ID_PRODUCT_MEASUREMENT_SALES_UNIT',
        'idProductMeasurementSalesUnit' => 'ID_PRODUCT_MEASUREMENT_SALES_UNIT',
        'spyProductMeasurementSalesUnit.idProductMeasurementSalesUnit' => 'ID_PRODUCT_MEASUREMENT_SALES_UNIT',
        'SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT' => 'ID_PRODUCT_MEASUREMENT_SALES_UNIT',
        'COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT' => 'ID_PRODUCT_MEASUREMENT_SALES_UNIT',
        'id_product_measurement_sales_unit' => 'ID_PRODUCT_MEASUREMENT_SALES_UNIT',
        'spy_product_measurement_sales_unit.id_product_measurement_sales_unit' => 'ID_PRODUCT_MEASUREMENT_SALES_UNIT',
        'FkProduct' => 'FK_PRODUCT',
        'SpyProductMeasurementSalesUnit.FkProduct' => 'FK_PRODUCT',
        'fkProduct' => 'FK_PRODUCT',
        'spyProductMeasurementSalesUnit.fkProduct' => 'FK_PRODUCT',
        'SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT' => 'FK_PRODUCT',
        'COL_FK_PRODUCT' => 'FK_PRODUCT',
        'fk_product' => 'FK_PRODUCT',
        'spy_product_measurement_sales_unit.fk_product' => 'FK_PRODUCT',
        'FkProductMeasurementBaseUnit' => 'FK_PRODUCT_MEASUREMENT_BASE_UNIT',
        'SpyProductMeasurementSalesUnit.FkProductMeasurementBaseUnit' => 'FK_PRODUCT_MEASUREMENT_BASE_UNIT',
        'fkProductMeasurementBaseUnit' => 'FK_PRODUCT_MEASUREMENT_BASE_UNIT',
        'spyProductMeasurementSalesUnit.fkProductMeasurementBaseUnit' => 'FK_PRODUCT_MEASUREMENT_BASE_UNIT',
        'SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_BASE_UNIT' => 'FK_PRODUCT_MEASUREMENT_BASE_UNIT',
        'COL_FK_PRODUCT_MEASUREMENT_BASE_UNIT' => 'FK_PRODUCT_MEASUREMENT_BASE_UNIT',
        'fk_product_measurement_base_unit' => 'FK_PRODUCT_MEASUREMENT_BASE_UNIT',
        'spy_product_measurement_sales_unit.fk_product_measurement_base_unit' => 'FK_PRODUCT_MEASUREMENT_BASE_UNIT',
        'FkProductMeasurementUnit' => 'FK_PRODUCT_MEASUREMENT_UNIT',
        'SpyProductMeasurementSalesUnit.FkProductMeasurementUnit' => 'FK_PRODUCT_MEASUREMENT_UNIT',
        'fkProductMeasurementUnit' => 'FK_PRODUCT_MEASUREMENT_UNIT',
        'spyProductMeasurementSalesUnit.fkProductMeasurementUnit' => 'FK_PRODUCT_MEASUREMENT_UNIT',
        'SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT' => 'FK_PRODUCT_MEASUREMENT_UNIT',
        'COL_FK_PRODUCT_MEASUREMENT_UNIT' => 'FK_PRODUCT_MEASUREMENT_UNIT',
        'fk_product_measurement_unit' => 'FK_PRODUCT_MEASUREMENT_UNIT',
        'spy_product_measurement_sales_unit.fk_product_measurement_unit' => 'FK_PRODUCT_MEASUREMENT_UNIT',
        'Conversion' => 'CONVERSION',
        'SpyProductMeasurementSalesUnit.Conversion' => 'CONVERSION',
        'conversion' => 'CONVERSION',
        'spyProductMeasurementSalesUnit.conversion' => 'CONVERSION',
        'SpyProductMeasurementSalesUnitTableMap::COL_CONVERSION' => 'CONVERSION',
        'COL_CONVERSION' => 'CONVERSION',
        'spy_product_measurement_sales_unit.conversion' => 'CONVERSION',
        'IsDefault' => 'IS_DEFAULT',
        'SpyProductMeasurementSalesUnit.IsDefault' => 'IS_DEFAULT',
        'isDefault' => 'IS_DEFAULT',
        'spyProductMeasurementSalesUnit.isDefault' => 'IS_DEFAULT',
        'SpyProductMeasurementSalesUnitTableMap::COL_IS_DEFAULT' => 'IS_DEFAULT',
        'COL_IS_DEFAULT' => 'IS_DEFAULT',
        'is_default' => 'IS_DEFAULT',
        'spy_product_measurement_sales_unit.is_default' => 'IS_DEFAULT',
        'IsDisplayed' => 'IS_DISPLAYED',
        'SpyProductMeasurementSalesUnit.IsDisplayed' => 'IS_DISPLAYED',
        'isDisplayed' => 'IS_DISPLAYED',
        'spyProductMeasurementSalesUnit.isDisplayed' => 'IS_DISPLAYED',
        'SpyProductMeasurementSalesUnitTableMap::COL_IS_DISPLAYED' => 'IS_DISPLAYED',
        'COL_IS_DISPLAYED' => 'IS_DISPLAYED',
        'is_displayed' => 'IS_DISPLAYED',
        'spy_product_measurement_sales_unit.is_displayed' => 'IS_DISPLAYED',
        'Key' => 'KEY',
        'SpyProductMeasurementSalesUnit.Key' => 'KEY',
        'key' => 'KEY',
        'spyProductMeasurementSalesUnit.key' => 'KEY',
        'SpyProductMeasurementSalesUnitTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_product_measurement_sales_unit.key' => 'KEY',
        'Precision' => 'PRECISION',
        'SpyProductMeasurementSalesUnit.Precision' => 'PRECISION',
        'precision' => 'PRECISION',
        'spyProductMeasurementSalesUnit.precision' => 'PRECISION',
        'SpyProductMeasurementSalesUnitTableMap::COL_PRECISION' => 'PRECISION',
        'COL_PRECISION' => 'PRECISION',
        'spy_product_measurement_sales_unit.precision' => 'PRECISION',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductMeasurementSalesUnit.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductMeasurementSalesUnit.createdAt' => 'CREATED_AT',
        'SpyProductMeasurementSalesUnitTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_measurement_sales_unit.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductMeasurementSalesUnit.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductMeasurementSalesUnit.updatedAt' => 'UPDATED_AT',
        'SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_measurement_sales_unit.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_measurement_sales_unit');
        $this->setPhpName('SpyProductMeasurementSalesUnit');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ProductMeasurementUnit\\Persistence\\SpyProductMeasurementSalesUnit');
        $this->setPackage('src.Orm.Zed.ProductMeasurementUnit.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_product_measurement_sales_unit_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_measurement_sales_unit', 'IdProductMeasurementSalesUnit', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_product', 'FkProduct', 'INTEGER', 'spy_product', 'id_product', true, null, null);
        $this->addForeignKey('fk_product_measurement_base_unit', 'FkProductMeasurementBaseUnit', 'INTEGER', 'spy_product_measurement_base_unit', 'id_product_measurement_base_unit', true, null, null);
        $this->addForeignKey('fk_product_measurement_unit', 'FkProductMeasurementUnit', 'INTEGER', 'spy_product_measurement_unit', 'id_product_measurement_unit', true, null, null);
        $this->addColumn('conversion', 'Conversion', 'FLOAT', false, null, null);
        $this->addColumn('is_default', 'IsDefault', 'BOOLEAN', true, 1, null);
        $this->addColumn('is_displayed', 'IsDisplayed', 'BOOLEAN', true, 1, null);
        $this->addColumn('key', 'Key', 'VARCHAR', false, 255, null);
        $this->addColumn('precision', 'Precision', 'INTEGER', false, null, null);
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
        $this->addRelation('ProductMeasurementUnit', '\\Orm\\Zed\\ProductMeasurementUnit\\Persistence\\SpyProductMeasurementUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_measurement_unit',
    1 => ':id_product_measurement_unit',
  ),
), null, null, null, false);
        $this->addRelation('ProductMeasurementBaseUnit', '\\Orm\\Zed\\ProductMeasurementUnit\\Persistence\\SpyProductMeasurementBaseUnit', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_measurement_base_unit',
    1 => ':id_product_measurement_base_unit',
  ),
), null, null, null, false);
        $this->addRelation('SpyProductMeasurementSalesUnitStore', '\\Orm\\Zed\\ProductMeasurementUnit\\Persistence\\SpyProductMeasurementSalesUnitStore', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_measurement_sales_unit',
    1 => ':id_product_measurement_sales_unit',
  ),
), null, null, 'SpyProductMeasurementSalesUnitStores', false);
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
            'event' => ['spy_product_measurement_sales_unit_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductMeasurementSalesUnit', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductMeasurementSalesUnit', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductMeasurementSalesUnit', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductMeasurementSalesUnit', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductMeasurementSalesUnit', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductMeasurementSalesUnit', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductMeasurementSalesUnit', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductMeasurementSalesUnitTableMap::CLASS_DEFAULT : SpyProductMeasurementSalesUnitTableMap::OM_CLASS;
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
     * @return array (SpyProductMeasurementSalesUnit object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductMeasurementSalesUnitTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductMeasurementSalesUnitTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductMeasurementSalesUnitTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductMeasurementSalesUnitTableMap::OM_CLASS;
            /** @var SpyProductMeasurementSalesUnit $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductMeasurementSalesUnitTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductMeasurementSalesUnitTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductMeasurementSalesUnitTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductMeasurementSalesUnit $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductMeasurementSalesUnitTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT);
            $criteria->addSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT);
            $criteria->addSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_BASE_UNIT);
            $criteria->addSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT);
            $criteria->addSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_CONVERSION);
            $criteria->addSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_IS_DEFAULT);
            $criteria->addSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_IS_DISPLAYED);
            $criteria->addSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_PRECISION);
            $criteria->addSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_measurement_sales_unit');
            $criteria->addSelectColumn($alias . '.fk_product');
            $criteria->addSelectColumn($alias . '.fk_product_measurement_base_unit');
            $criteria->addSelectColumn($alias . '.fk_product_measurement_unit');
            $criteria->addSelectColumn($alias . '.conversion');
            $criteria->addSelectColumn($alias . '.is_default');
            $criteria->addSelectColumn($alias . '.is_displayed');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.precision');
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
            $criteria->removeSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT);
            $criteria->removeSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT);
            $criteria->removeSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_BASE_UNIT);
            $criteria->removeSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_FK_PRODUCT_MEASUREMENT_UNIT);
            $criteria->removeSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_CONVERSION);
            $criteria->removeSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_IS_DEFAULT);
            $criteria->removeSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_IS_DISPLAYED);
            $criteria->removeSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_PRECISION);
            $criteria->removeSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductMeasurementSalesUnitTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_measurement_sales_unit');
            $criteria->removeSelectColumn($alias . '.fk_product');
            $criteria->removeSelectColumn($alias . '.fk_product_measurement_base_unit');
            $criteria->removeSelectColumn($alias . '.fk_product_measurement_unit');
            $criteria->removeSelectColumn($alias . '.conversion');
            $criteria->removeSelectColumn($alias . '.is_default');
            $criteria->removeSelectColumn($alias . '.is_displayed');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.precision');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductMeasurementSalesUnitTableMap::DATABASE_NAME)->getTable(SpyProductMeasurementSalesUnitTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductMeasurementSalesUnit or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductMeasurementSalesUnit object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductMeasurementSalesUnitTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductMeasurementUnit\Persistence\SpyProductMeasurementSalesUnit) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductMeasurementSalesUnitTableMap::DATABASE_NAME);
            $criteria->add(SpyProductMeasurementSalesUnitTableMap::COL_ID_PRODUCT_MEASUREMENT_SALES_UNIT, (array) $values, Criteria::IN);
        }

        $query = SpyProductMeasurementSalesUnitQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductMeasurementSalesUnitTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductMeasurementSalesUnitTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_measurement_sales_unit table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductMeasurementSalesUnitQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductMeasurementSalesUnit or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductMeasurementSalesUnit object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductMeasurementSalesUnitTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductMeasurementSalesUnit object
        }


        // Set the correct dbName
        $query = SpyProductMeasurementSalesUnitQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
