<?php

namespace Orm\Zed\ProductImage\Persistence\Map;

use Orm\Zed\ProductImage\Persistence\SpyProductImageSet;
use Orm\Zed\ProductImage\Persistence\SpyProductImageSetQuery;
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
 * This class defines the structure of the 'spy_product_image_set' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductImageSetTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductImage.Persistence.Map.SpyProductImageSetTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_image_set';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductImageSet';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductImage\\Persistence\\SpyProductImageSet';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductImage.Persistence.SpyProductImageSet';

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
     * the column name for the id_product_image_set field
     */
    public const COL_ID_PRODUCT_IMAGE_SET = 'spy_product_image_set.id_product_image_set';

    /**
     * the column name for the fk_locale field
     */
    public const COL_FK_LOCALE = 'spy_product_image_set.fk_locale';

    /**
     * the column name for the fk_product field
     */
    public const COL_FK_PRODUCT = 'spy_product_image_set.fk_product';

    /**
     * the column name for the fk_product_abstract field
     */
    public const COL_FK_PRODUCT_ABSTRACT = 'spy_product_image_set.fk_product_abstract';

    /**
     * the column name for the fk_resource_configurable_bundle_template field
     */
    public const COL_FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE = 'spy_product_image_set.fk_resource_configurable_bundle_template';

    /**
     * the column name for the fk_resource_product_set field
     */
    public const COL_FK_RESOURCE_PRODUCT_SET = 'spy_product_image_set.fk_resource_product_set';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_product_image_set.name';

    /**
     * the column name for the product_image_set_key field
     */
    public const COL_PRODUCT_IMAGE_SET_KEY = 'spy_product_image_set.product_image_set_key';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_image_set.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_image_set.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductImageSet', 'FkLocale', 'FkProduct', 'FkProductAbstract', 'FkResourceConfigurableBundleTemplate', 'FkResourceProductSet', 'Name', 'ProductImageSetKey', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductImageSet', 'fkLocale', 'fkProduct', 'fkProductAbstract', 'fkResourceConfigurableBundleTemplate', 'fkResourceProductSet', 'name', 'productImageSetKey', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductImageSetTableMap::COL_ID_PRODUCT_IMAGE_SET, SpyProductImageSetTableMap::COL_FK_LOCALE, SpyProductImageSetTableMap::COL_FK_PRODUCT, SpyProductImageSetTableMap::COL_FK_PRODUCT_ABSTRACT, SpyProductImageSetTableMap::COL_FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE, SpyProductImageSetTableMap::COL_FK_RESOURCE_PRODUCT_SET, SpyProductImageSetTableMap::COL_NAME, SpyProductImageSetTableMap::COL_PRODUCT_IMAGE_SET_KEY, SpyProductImageSetTableMap::COL_CREATED_AT, SpyProductImageSetTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_image_set', 'fk_locale', 'fk_product', 'fk_product_abstract', 'fk_resource_configurable_bundle_template', 'fk_resource_product_set', 'name', 'product_image_set_key', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProductImageSet' => 0, 'FkLocale' => 1, 'FkProduct' => 2, 'FkProductAbstract' => 3, 'FkResourceConfigurableBundleTemplate' => 4, 'FkResourceProductSet' => 5, 'Name' => 6, 'ProductImageSetKey' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ],
        self::TYPE_CAMELNAME     => ['idProductImageSet' => 0, 'fkLocale' => 1, 'fkProduct' => 2, 'fkProductAbstract' => 3, 'fkResourceConfigurableBundleTemplate' => 4, 'fkResourceProductSet' => 5, 'name' => 6, 'productImageSetKey' => 7, 'createdAt' => 8, 'updatedAt' => 9, ],
        self::TYPE_COLNAME       => [SpyProductImageSetTableMap::COL_ID_PRODUCT_IMAGE_SET => 0, SpyProductImageSetTableMap::COL_FK_LOCALE => 1, SpyProductImageSetTableMap::COL_FK_PRODUCT => 2, SpyProductImageSetTableMap::COL_FK_PRODUCT_ABSTRACT => 3, SpyProductImageSetTableMap::COL_FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE => 4, SpyProductImageSetTableMap::COL_FK_RESOURCE_PRODUCT_SET => 5, SpyProductImageSetTableMap::COL_NAME => 6, SpyProductImageSetTableMap::COL_PRODUCT_IMAGE_SET_KEY => 7, SpyProductImageSetTableMap::COL_CREATED_AT => 8, SpyProductImageSetTableMap::COL_UPDATED_AT => 9, ],
        self::TYPE_FIELDNAME     => ['id_product_image_set' => 0, 'fk_locale' => 1, 'fk_product' => 2, 'fk_product_abstract' => 3, 'fk_resource_configurable_bundle_template' => 4, 'fk_resource_product_set' => 5, 'name' => 6, 'product_image_set_key' => 7, 'created_at' => 8, 'updated_at' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductImageSet' => 'ID_PRODUCT_IMAGE_SET',
        'SpyProductImageSet.IdProductImageSet' => 'ID_PRODUCT_IMAGE_SET',
        'idProductImageSet' => 'ID_PRODUCT_IMAGE_SET',
        'spyProductImageSet.idProductImageSet' => 'ID_PRODUCT_IMAGE_SET',
        'SpyProductImageSetTableMap::COL_ID_PRODUCT_IMAGE_SET' => 'ID_PRODUCT_IMAGE_SET',
        'COL_ID_PRODUCT_IMAGE_SET' => 'ID_PRODUCT_IMAGE_SET',
        'id_product_image_set' => 'ID_PRODUCT_IMAGE_SET',
        'spy_product_image_set.id_product_image_set' => 'ID_PRODUCT_IMAGE_SET',
        'FkLocale' => 'FK_LOCALE',
        'SpyProductImageSet.FkLocale' => 'FK_LOCALE',
        'fkLocale' => 'FK_LOCALE',
        'spyProductImageSet.fkLocale' => 'FK_LOCALE',
        'SpyProductImageSetTableMap::COL_FK_LOCALE' => 'FK_LOCALE',
        'COL_FK_LOCALE' => 'FK_LOCALE',
        'fk_locale' => 'FK_LOCALE',
        'spy_product_image_set.fk_locale' => 'FK_LOCALE',
        'FkProduct' => 'FK_PRODUCT',
        'SpyProductImageSet.FkProduct' => 'FK_PRODUCT',
        'fkProduct' => 'FK_PRODUCT',
        'spyProductImageSet.fkProduct' => 'FK_PRODUCT',
        'SpyProductImageSetTableMap::COL_FK_PRODUCT' => 'FK_PRODUCT',
        'COL_FK_PRODUCT' => 'FK_PRODUCT',
        'fk_product' => 'FK_PRODUCT',
        'spy_product_image_set.fk_product' => 'FK_PRODUCT',
        'FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyProductImageSet.FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'spyProductImageSet.fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyProductImageSetTableMap::COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'spy_product_image_set.fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'FkResourceConfigurableBundleTemplate' => 'FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE',
        'SpyProductImageSet.FkResourceConfigurableBundleTemplate' => 'FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE',
        'fkResourceConfigurableBundleTemplate' => 'FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE',
        'spyProductImageSet.fkResourceConfigurableBundleTemplate' => 'FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE',
        'SpyProductImageSetTableMap::COL_FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE' => 'FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE',
        'COL_FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE' => 'FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE',
        'fk_resource_configurable_bundle_template' => 'FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE',
        'spy_product_image_set.fk_resource_configurable_bundle_template' => 'FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE',
        'FkResourceProductSet' => 'FK_RESOURCE_PRODUCT_SET',
        'SpyProductImageSet.FkResourceProductSet' => 'FK_RESOURCE_PRODUCT_SET',
        'fkResourceProductSet' => 'FK_RESOURCE_PRODUCT_SET',
        'spyProductImageSet.fkResourceProductSet' => 'FK_RESOURCE_PRODUCT_SET',
        'SpyProductImageSetTableMap::COL_FK_RESOURCE_PRODUCT_SET' => 'FK_RESOURCE_PRODUCT_SET',
        'COL_FK_RESOURCE_PRODUCT_SET' => 'FK_RESOURCE_PRODUCT_SET',
        'fk_resource_product_set' => 'FK_RESOURCE_PRODUCT_SET',
        'spy_product_image_set.fk_resource_product_set' => 'FK_RESOURCE_PRODUCT_SET',
        'Name' => 'NAME',
        'SpyProductImageSet.Name' => 'NAME',
        'name' => 'NAME',
        'spyProductImageSet.name' => 'NAME',
        'SpyProductImageSetTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_product_image_set.name' => 'NAME',
        'ProductImageSetKey' => 'PRODUCT_IMAGE_SET_KEY',
        'SpyProductImageSet.ProductImageSetKey' => 'PRODUCT_IMAGE_SET_KEY',
        'productImageSetKey' => 'PRODUCT_IMAGE_SET_KEY',
        'spyProductImageSet.productImageSetKey' => 'PRODUCT_IMAGE_SET_KEY',
        'SpyProductImageSetTableMap::COL_PRODUCT_IMAGE_SET_KEY' => 'PRODUCT_IMAGE_SET_KEY',
        'COL_PRODUCT_IMAGE_SET_KEY' => 'PRODUCT_IMAGE_SET_KEY',
        'product_image_set_key' => 'PRODUCT_IMAGE_SET_KEY',
        'spy_product_image_set.product_image_set_key' => 'PRODUCT_IMAGE_SET_KEY',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductImageSet.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductImageSet.createdAt' => 'CREATED_AT',
        'SpyProductImageSetTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_image_set.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductImageSet.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductImageSet.updatedAt' => 'UPDATED_AT',
        'SpyProductImageSetTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_image_set.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_image_set');
        $this->setPhpName('SpyProductImageSet');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ProductImage\\Persistence\\SpyProductImageSet');
        $this->setPackage('src.Orm.Zed.ProductImage.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_image_set_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_image_set', 'IdProductImageSet', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_locale', 'FkLocale', 'INTEGER', 'spy_locale', 'id_locale', false, null, null);
        $this->addForeignKey('fk_product', 'FkProduct', 'INTEGER', 'spy_product', 'id_product', false, null, null);
        $this->addForeignKey('fk_product_abstract', 'FkProductAbstract', 'INTEGER', 'spy_product_abstract', 'id_product_abstract', false, null, null);
        $this->addForeignKey('fk_resource_configurable_bundle_template', 'FkResourceConfigurableBundleTemplate', 'INTEGER', 'spy_configurable_bundle_template', 'id_configurable_bundle_template', false, null, null);
        $this->addForeignKey('fk_resource_product_set', 'FkResourceProductSet', 'INTEGER', 'spy_product_set', 'id_product_set', false, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('product_image_set_key', 'ProductImageSetKey', 'VARCHAR', false, 32, null);
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
        $this->addRelation('SpyConfigurableBundleTemplate', '\\Orm\\Zed\\ConfigurableBundle\\Persistence\\SpyConfigurableBundleTemplate', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_resource_configurable_bundle_template',
    1 => ':id_configurable_bundle_template',
  ),
), null, null, null, false);
        $this->addRelation('SpyLocale', '\\Orm\\Zed\\Locale\\Persistence\\SpyLocale', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_locale',
    1 => ':id_locale',
  ),
), null, null, null, false);
        $this->addRelation('SpyProduct', '\\Orm\\Zed\\Product\\Persistence\\SpyProduct', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product',
    1 => ':id_product',
  ),
), null, null, null, false);
        $this->addRelation('SpyProductAbstract', '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstract', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), null, null, null, false);
        $this->addRelation('SpyProductSet', '\\Orm\\Zed\\ProductSet\\Persistence\\SpyProductSet', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_resource_product_set',
    1 => ':id_product_set',
  ),
), null, null, null, false);
        $this->addRelation('SpyProductImageSetToProductImage', '\\Orm\\Zed\\ProductImage\\Persistence\\SpyProductImageSetToProductImage', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_image_set',
    1 => ':id_product_image_set',
  ),
), null, null, 'SpyProductImageSetToProductImages', false);
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
            'event' => ['spy_product_image_set_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductImageSet', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductImageSet', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductImageSet', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductImageSet', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductImageSet', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductImageSet', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductImageSet', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductImageSetTableMap::CLASS_DEFAULT : SpyProductImageSetTableMap::OM_CLASS;
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
     * @return array (SpyProductImageSet object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductImageSetTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductImageSetTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductImageSetTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductImageSetTableMap::OM_CLASS;
            /** @var SpyProductImageSet $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductImageSetTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductImageSetTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductImageSetTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductImageSet $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductImageSetTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductImageSetTableMap::COL_ID_PRODUCT_IMAGE_SET);
            $criteria->addSelectColumn(SpyProductImageSetTableMap::COL_FK_LOCALE);
            $criteria->addSelectColumn(SpyProductImageSetTableMap::COL_FK_PRODUCT);
            $criteria->addSelectColumn(SpyProductImageSetTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->addSelectColumn(SpyProductImageSetTableMap::COL_FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE);
            $criteria->addSelectColumn(SpyProductImageSetTableMap::COL_FK_RESOURCE_PRODUCT_SET);
            $criteria->addSelectColumn(SpyProductImageSetTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyProductImageSetTableMap::COL_PRODUCT_IMAGE_SET_KEY);
            $criteria->addSelectColumn(SpyProductImageSetTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductImageSetTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_image_set');
            $criteria->addSelectColumn($alias . '.fk_locale');
            $criteria->addSelectColumn($alias . '.fk_product');
            $criteria->addSelectColumn($alias . '.fk_product_abstract');
            $criteria->addSelectColumn($alias . '.fk_resource_configurable_bundle_template');
            $criteria->addSelectColumn($alias . '.fk_resource_product_set');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.product_image_set_key');
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
            $criteria->removeSelectColumn(SpyProductImageSetTableMap::COL_ID_PRODUCT_IMAGE_SET);
            $criteria->removeSelectColumn(SpyProductImageSetTableMap::COL_FK_LOCALE);
            $criteria->removeSelectColumn(SpyProductImageSetTableMap::COL_FK_PRODUCT);
            $criteria->removeSelectColumn(SpyProductImageSetTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->removeSelectColumn(SpyProductImageSetTableMap::COL_FK_RESOURCE_CONFIGURABLE_BUNDLE_TEMPLATE);
            $criteria->removeSelectColumn(SpyProductImageSetTableMap::COL_FK_RESOURCE_PRODUCT_SET);
            $criteria->removeSelectColumn(SpyProductImageSetTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyProductImageSetTableMap::COL_PRODUCT_IMAGE_SET_KEY);
            $criteria->removeSelectColumn(SpyProductImageSetTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductImageSetTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_image_set');
            $criteria->removeSelectColumn($alias . '.fk_locale');
            $criteria->removeSelectColumn($alias . '.fk_product');
            $criteria->removeSelectColumn($alias . '.fk_product_abstract');
            $criteria->removeSelectColumn($alias . '.fk_resource_configurable_bundle_template');
            $criteria->removeSelectColumn($alias . '.fk_resource_product_set');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.product_image_set_key');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductImageSetTableMap::DATABASE_NAME)->getTable(SpyProductImageSetTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductImageSet or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductImageSet object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductImageSetTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductImage\Persistence\SpyProductImageSet) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductImageSetTableMap::DATABASE_NAME);
            $criteria->add(SpyProductImageSetTableMap::COL_ID_PRODUCT_IMAGE_SET, (array) $values, Criteria::IN);
        }

        $query = SpyProductImageSetQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductImageSetTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductImageSetTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_image_set table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductImageSetQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductImageSet or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductImageSet object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductImageSetTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductImageSet object
        }


        // Set the correct dbName
        $query = SpyProductImageSetQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
