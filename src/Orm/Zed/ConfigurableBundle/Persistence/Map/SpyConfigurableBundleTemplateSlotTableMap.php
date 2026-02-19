<?php

namespace Orm\Zed\ConfigurableBundle\Persistence\Map;

use Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlot;
use Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlotQuery;
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
 * This class defines the structure of the 'spy_configurable_bundle_template_slot' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyConfigurableBundleTemplateSlotTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ConfigurableBundle.Persistence.Map.SpyConfigurableBundleTemplateSlotTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_configurable_bundle_template_slot';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyConfigurableBundleTemplateSlot';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ConfigurableBundle\\Persistence\\SpyConfigurableBundleTemplateSlot';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ConfigurableBundle.Persistence.SpyConfigurableBundleTemplateSlot';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id_configurable_bundle_template_slot field
     */
    public const COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT = 'spy_configurable_bundle_template_slot.id_configurable_bundle_template_slot';

    /**
     * the column name for the fk_configurable_bundle_template field
     */
    public const COL_FK_CONFIGURABLE_BUNDLE_TEMPLATE = 'spy_configurable_bundle_template_slot.fk_configurable_bundle_template';

    /**
     * the column name for the fk_product_list field
     */
    public const COL_FK_PRODUCT_LIST = 'spy_configurable_bundle_template_slot.fk_product_list';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_configurable_bundle_template_slot.key';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_configurable_bundle_template_slot.name';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_configurable_bundle_template_slot.uuid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_configurable_bundle_template_slot.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_configurable_bundle_template_slot.updated_at';

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
        self::TYPE_PHPNAME       => ['IdConfigurableBundleTemplateSlot', 'FkConfigurableBundleTemplate', 'FkProductList', 'Key', 'Name', 'Uuid', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idConfigurableBundleTemplateSlot', 'fkConfigurableBundleTemplate', 'fkProductList', 'key', 'name', 'uuid', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyConfigurableBundleTemplateSlotTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT, SpyConfigurableBundleTemplateSlotTableMap::COL_FK_CONFIGURABLE_BUNDLE_TEMPLATE, SpyConfigurableBundleTemplateSlotTableMap::COL_FK_PRODUCT_LIST, SpyConfigurableBundleTemplateSlotTableMap::COL_KEY, SpyConfigurableBundleTemplateSlotTableMap::COL_NAME, SpyConfigurableBundleTemplateSlotTableMap::COL_UUID, SpyConfigurableBundleTemplateSlotTableMap::COL_CREATED_AT, SpyConfigurableBundleTemplateSlotTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_configurable_bundle_template_slot', 'fk_configurable_bundle_template', 'fk_product_list', 'key', 'name', 'uuid', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
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
        self::TYPE_PHPNAME       => ['IdConfigurableBundleTemplateSlot' => 0, 'FkConfigurableBundleTemplate' => 1, 'FkProductList' => 2, 'Key' => 3, 'Name' => 4, 'Uuid' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idConfigurableBundleTemplateSlot' => 0, 'fkConfigurableBundleTemplate' => 1, 'fkProductList' => 2, 'key' => 3, 'name' => 4, 'uuid' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpyConfigurableBundleTemplateSlotTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT => 0, SpyConfigurableBundleTemplateSlotTableMap::COL_FK_CONFIGURABLE_BUNDLE_TEMPLATE => 1, SpyConfigurableBundleTemplateSlotTableMap::COL_FK_PRODUCT_LIST => 2, SpyConfigurableBundleTemplateSlotTableMap::COL_KEY => 3, SpyConfigurableBundleTemplateSlotTableMap::COL_NAME => 4, SpyConfigurableBundleTemplateSlotTableMap::COL_UUID => 5, SpyConfigurableBundleTemplateSlotTableMap::COL_CREATED_AT => 6, SpyConfigurableBundleTemplateSlotTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_configurable_bundle_template_slot' => 0, 'fk_configurable_bundle_template' => 1, 'fk_product_list' => 2, 'key' => 3, 'name' => 4, 'uuid' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdConfigurableBundleTemplateSlot' => 'ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT',
        'SpyConfigurableBundleTemplateSlot.IdConfigurableBundleTemplateSlot' => 'ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT',
        'idConfigurableBundleTemplateSlot' => 'ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT',
        'spyConfigurableBundleTemplateSlot.idConfigurableBundleTemplateSlot' => 'ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT',
        'SpyConfigurableBundleTemplateSlotTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT' => 'ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT',
        'COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT' => 'ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT',
        'id_configurable_bundle_template_slot' => 'ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT',
        'spy_configurable_bundle_template_slot.id_configurable_bundle_template_slot' => 'ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT',
        'FkConfigurableBundleTemplate' => 'FK_CONFIGURABLE_BUNDLE_TEMPLATE',
        'SpyConfigurableBundleTemplateSlot.FkConfigurableBundleTemplate' => 'FK_CONFIGURABLE_BUNDLE_TEMPLATE',
        'fkConfigurableBundleTemplate' => 'FK_CONFIGURABLE_BUNDLE_TEMPLATE',
        'spyConfigurableBundleTemplateSlot.fkConfigurableBundleTemplate' => 'FK_CONFIGURABLE_BUNDLE_TEMPLATE',
        'SpyConfigurableBundleTemplateSlotTableMap::COL_FK_CONFIGURABLE_BUNDLE_TEMPLATE' => 'FK_CONFIGURABLE_BUNDLE_TEMPLATE',
        'COL_FK_CONFIGURABLE_BUNDLE_TEMPLATE' => 'FK_CONFIGURABLE_BUNDLE_TEMPLATE',
        'fk_configurable_bundle_template' => 'FK_CONFIGURABLE_BUNDLE_TEMPLATE',
        'spy_configurable_bundle_template_slot.fk_configurable_bundle_template' => 'FK_CONFIGURABLE_BUNDLE_TEMPLATE',
        'FkProductList' => 'FK_PRODUCT_LIST',
        'SpyConfigurableBundleTemplateSlot.FkProductList' => 'FK_PRODUCT_LIST',
        'fkProductList' => 'FK_PRODUCT_LIST',
        'spyConfigurableBundleTemplateSlot.fkProductList' => 'FK_PRODUCT_LIST',
        'SpyConfigurableBundleTemplateSlotTableMap::COL_FK_PRODUCT_LIST' => 'FK_PRODUCT_LIST',
        'COL_FK_PRODUCT_LIST' => 'FK_PRODUCT_LIST',
        'fk_product_list' => 'FK_PRODUCT_LIST',
        'spy_configurable_bundle_template_slot.fk_product_list' => 'FK_PRODUCT_LIST',
        'Key' => 'KEY',
        'SpyConfigurableBundleTemplateSlot.Key' => 'KEY',
        'key' => 'KEY',
        'spyConfigurableBundleTemplateSlot.key' => 'KEY',
        'SpyConfigurableBundleTemplateSlotTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_configurable_bundle_template_slot.key' => 'KEY',
        'Name' => 'NAME',
        'SpyConfigurableBundleTemplateSlot.Name' => 'NAME',
        'name' => 'NAME',
        'spyConfigurableBundleTemplateSlot.name' => 'NAME',
        'SpyConfigurableBundleTemplateSlotTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_configurable_bundle_template_slot.name' => 'NAME',
        'Uuid' => 'UUID',
        'SpyConfigurableBundleTemplateSlot.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyConfigurableBundleTemplateSlot.uuid' => 'UUID',
        'SpyConfigurableBundleTemplateSlotTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_configurable_bundle_template_slot.uuid' => 'UUID',
        'CreatedAt' => 'CREATED_AT',
        'SpyConfigurableBundleTemplateSlot.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyConfigurableBundleTemplateSlot.createdAt' => 'CREATED_AT',
        'SpyConfigurableBundleTemplateSlotTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_configurable_bundle_template_slot.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyConfigurableBundleTemplateSlot.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyConfigurableBundleTemplateSlot.updatedAt' => 'UPDATED_AT',
        'SpyConfigurableBundleTemplateSlotTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_configurable_bundle_template_slot.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_configurable_bundle_template_slot');
        $this->setPhpName('SpyConfigurableBundleTemplateSlot');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ConfigurableBundle\\Persistence\\SpyConfigurableBundleTemplateSlot');
        $this->setPackage('src.Orm.Zed.ConfigurableBundle.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_configurable_bundle_template_slot_pk_seq');
        // columns
        $this->addPrimaryKey('id_configurable_bundle_template_slot', 'IdConfigurableBundleTemplateSlot', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_configurable_bundle_template', 'FkConfigurableBundleTemplate', 'INTEGER', 'spy_configurable_bundle_template', 'id_configurable_bundle_template', true, null, null);
        $this->addForeignKey('fk_product_list', 'FkProductList', 'INTEGER', 'spy_product_list', 'id_product_list', false, null, null);
        $this->addColumn('key', 'Key', 'VARCHAR', false, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
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
        $this->addRelation('SpyConfigurableBundleTemplate', '\\Orm\\Zed\\ConfigurableBundle\\Persistence\\SpyConfigurableBundleTemplate', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_configurable_bundle_template',
    1 => ':id_configurable_bundle_template',
  ),
), null, null, null, false);
        $this->addRelation('SpyProductList', '\\Orm\\Zed\\ProductList\\Persistence\\SpyProductList', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_list',
    1 => ':id_product_list',
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_configurable_bundle_template_slot'],
            'timestampable' => ['create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', 'is_timestamp' => 'true'],
            'event' => ['spy_configurable_bundle_template_slot_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdConfigurableBundleTemplateSlot', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdConfigurableBundleTemplateSlot', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdConfigurableBundleTemplateSlot', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdConfigurableBundleTemplateSlot', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdConfigurableBundleTemplateSlot', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdConfigurableBundleTemplateSlot', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdConfigurableBundleTemplateSlot', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyConfigurableBundleTemplateSlotTableMap::CLASS_DEFAULT : SpyConfigurableBundleTemplateSlotTableMap::OM_CLASS;
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
     * @return array (SpyConfigurableBundleTemplateSlot object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyConfigurableBundleTemplateSlotTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyConfigurableBundleTemplateSlotTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyConfigurableBundleTemplateSlotTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyConfigurableBundleTemplateSlotTableMap::OM_CLASS;
            /** @var SpyConfigurableBundleTemplateSlot $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyConfigurableBundleTemplateSlotTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyConfigurableBundleTemplateSlotTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyConfigurableBundleTemplateSlotTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyConfigurableBundleTemplateSlot $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyConfigurableBundleTemplateSlotTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT);
            $criteria->addSelectColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_FK_CONFIGURABLE_BUNDLE_TEMPLATE);
            $criteria->addSelectColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_FK_PRODUCT_LIST);
            $criteria->addSelectColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_configurable_bundle_template_slot');
            $criteria->addSelectColumn($alias . '.fk_configurable_bundle_template');
            $criteria->addSelectColumn($alias . '.fk_product_list');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.name');
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
            $criteria->removeSelectColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT);
            $criteria->removeSelectColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_FK_CONFIGURABLE_BUNDLE_TEMPLATE);
            $criteria->removeSelectColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_FK_PRODUCT_LIST);
            $criteria->removeSelectColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyConfigurableBundleTemplateSlotTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_configurable_bundle_template_slot');
            $criteria->removeSelectColumn($alias . '.fk_configurable_bundle_template');
            $criteria->removeSelectColumn($alias . '.fk_product_list');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyConfigurableBundleTemplateSlotTableMap::DATABASE_NAME)->getTable(SpyConfigurableBundleTemplateSlotTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyConfigurableBundleTemplateSlot or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyConfigurableBundleTemplateSlot object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyConfigurableBundleTemplateSlotTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ConfigurableBundle\Persistence\SpyConfigurableBundleTemplateSlot) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyConfigurableBundleTemplateSlotTableMap::DATABASE_NAME);
            $criteria->add(SpyConfigurableBundleTemplateSlotTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT, (array) $values, Criteria::IN);
        }

        $query = SpyConfigurableBundleTemplateSlotQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyConfigurableBundleTemplateSlotTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyConfigurableBundleTemplateSlotTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_configurable_bundle_template_slot table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyConfigurableBundleTemplateSlotQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyConfigurableBundleTemplateSlot or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyConfigurableBundleTemplateSlot object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyConfigurableBundleTemplateSlotTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyConfigurableBundleTemplateSlot object
        }

        if ($criteria->containsKey(SpyConfigurableBundleTemplateSlotTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT) && $criteria->keyContainsValue(SpyConfigurableBundleTemplateSlotTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyConfigurableBundleTemplateSlotTableMap::COL_ID_CONFIGURABLE_BUNDLE_TEMPLATE_SLOT.')');
        }


        // Set the correct dbName
        $query = SpyConfigurableBundleTemplateSlotQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
