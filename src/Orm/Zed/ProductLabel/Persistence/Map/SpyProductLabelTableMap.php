<?php

namespace Orm\Zed\ProductLabel\Persistence\Map;

use Orm\Zed\ProductLabel\Persistence\SpyProductLabel;
use Orm\Zed\ProductLabel\Persistence\SpyProductLabelQuery;
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
 * This class defines the structure of the 'spy_product_label' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductLabelTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductLabel.Persistence.Map.SpyProductLabelTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_label';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductLabel';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductLabel\\Persistence\\SpyProductLabel';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductLabel.Persistence.SpyProductLabel';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the id_product_label field
     */
    public const COL_ID_PRODUCT_LABEL = 'spy_product_label.id_product_label';

    /**
     * the column name for the front_end_reference field
     */
    public const COL_FRONT_END_REFERENCE = 'spy_product_label.front_end_reference';

    /**
     * the column name for the is_active field
     */
    public const COL_IS_ACTIVE = 'spy_product_label.is_active';

    /**
     * the column name for the is_dynamic field
     */
    public const COL_IS_DYNAMIC = 'spy_product_label.is_dynamic';

    /**
     * the column name for the is_exclusive field
     */
    public const COL_IS_EXCLUSIVE = 'spy_product_label.is_exclusive';

    /**
     * the column name for the is_published field
     */
    public const COL_IS_PUBLISHED = 'spy_product_label.is_published';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_product_label.name';

    /**
     * the column name for the position field
     */
    public const COL_POSITION = 'spy_product_label.position';

    /**
     * the column name for the valid_from field
     */
    public const COL_VALID_FROM = 'spy_product_label.valid_from';

    /**
     * the column name for the valid_to field
     */
    public const COL_VALID_TO = 'spy_product_label.valid_to';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_label.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_label.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductLabel', 'FrontEndReference', 'IsActive', 'IsDynamic', 'IsExclusive', 'IsPublished', 'Name', 'Position', 'ValidFrom', 'ValidTo', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductLabel', 'frontEndReference', 'isActive', 'isDynamic', 'isExclusive', 'isPublished', 'name', 'position', 'validFrom', 'validTo', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductLabelTableMap::COL_ID_PRODUCT_LABEL, SpyProductLabelTableMap::COL_FRONT_END_REFERENCE, SpyProductLabelTableMap::COL_IS_ACTIVE, SpyProductLabelTableMap::COL_IS_DYNAMIC, SpyProductLabelTableMap::COL_IS_EXCLUSIVE, SpyProductLabelTableMap::COL_IS_PUBLISHED, SpyProductLabelTableMap::COL_NAME, SpyProductLabelTableMap::COL_POSITION, SpyProductLabelTableMap::COL_VALID_FROM, SpyProductLabelTableMap::COL_VALID_TO, SpyProductLabelTableMap::COL_CREATED_AT, SpyProductLabelTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_label', 'front_end_reference', 'is_active', 'is_dynamic', 'is_exclusive', 'is_published', 'name', 'position', 'valid_from', 'valid_to', 'created_at', 'updated_at', ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
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
        self::TYPE_PHPNAME       => ['IdProductLabel' => 0, 'FrontEndReference' => 1, 'IsActive' => 2, 'IsDynamic' => 3, 'IsExclusive' => 4, 'IsPublished' => 5, 'Name' => 6, 'Position' => 7, 'ValidFrom' => 8, 'ValidTo' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ],
        self::TYPE_CAMELNAME     => ['idProductLabel' => 0, 'frontEndReference' => 1, 'isActive' => 2, 'isDynamic' => 3, 'isExclusive' => 4, 'isPublished' => 5, 'name' => 6, 'position' => 7, 'validFrom' => 8, 'validTo' => 9, 'createdAt' => 10, 'updatedAt' => 11, ],
        self::TYPE_COLNAME       => [SpyProductLabelTableMap::COL_ID_PRODUCT_LABEL => 0, SpyProductLabelTableMap::COL_FRONT_END_REFERENCE => 1, SpyProductLabelTableMap::COL_IS_ACTIVE => 2, SpyProductLabelTableMap::COL_IS_DYNAMIC => 3, SpyProductLabelTableMap::COL_IS_EXCLUSIVE => 4, SpyProductLabelTableMap::COL_IS_PUBLISHED => 5, SpyProductLabelTableMap::COL_NAME => 6, SpyProductLabelTableMap::COL_POSITION => 7, SpyProductLabelTableMap::COL_VALID_FROM => 8, SpyProductLabelTableMap::COL_VALID_TO => 9, SpyProductLabelTableMap::COL_CREATED_AT => 10, SpyProductLabelTableMap::COL_UPDATED_AT => 11, ],
        self::TYPE_FIELDNAME     => ['id_product_label' => 0, 'front_end_reference' => 1, 'is_active' => 2, 'is_dynamic' => 3, 'is_exclusive' => 4, 'is_published' => 5, 'name' => 6, 'position' => 7, 'valid_from' => 8, 'valid_to' => 9, 'created_at' => 10, 'updated_at' => 11, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductLabel' => 'ID_PRODUCT_LABEL',
        'SpyProductLabel.IdProductLabel' => 'ID_PRODUCT_LABEL',
        'idProductLabel' => 'ID_PRODUCT_LABEL',
        'spyProductLabel.idProductLabel' => 'ID_PRODUCT_LABEL',
        'SpyProductLabelTableMap::COL_ID_PRODUCT_LABEL' => 'ID_PRODUCT_LABEL',
        'COL_ID_PRODUCT_LABEL' => 'ID_PRODUCT_LABEL',
        'id_product_label' => 'ID_PRODUCT_LABEL',
        'spy_product_label.id_product_label' => 'ID_PRODUCT_LABEL',
        'FrontEndReference' => 'FRONT_END_REFERENCE',
        'SpyProductLabel.FrontEndReference' => 'FRONT_END_REFERENCE',
        'frontEndReference' => 'FRONT_END_REFERENCE',
        'spyProductLabel.frontEndReference' => 'FRONT_END_REFERENCE',
        'SpyProductLabelTableMap::COL_FRONT_END_REFERENCE' => 'FRONT_END_REFERENCE',
        'COL_FRONT_END_REFERENCE' => 'FRONT_END_REFERENCE',
        'front_end_reference' => 'FRONT_END_REFERENCE',
        'spy_product_label.front_end_reference' => 'FRONT_END_REFERENCE',
        'IsActive' => 'IS_ACTIVE',
        'SpyProductLabel.IsActive' => 'IS_ACTIVE',
        'isActive' => 'IS_ACTIVE',
        'spyProductLabel.isActive' => 'IS_ACTIVE',
        'SpyProductLabelTableMap::COL_IS_ACTIVE' => 'IS_ACTIVE',
        'COL_IS_ACTIVE' => 'IS_ACTIVE',
        'is_active' => 'IS_ACTIVE',
        'spy_product_label.is_active' => 'IS_ACTIVE',
        'IsDynamic' => 'IS_DYNAMIC',
        'SpyProductLabel.IsDynamic' => 'IS_DYNAMIC',
        'isDynamic' => 'IS_DYNAMIC',
        'spyProductLabel.isDynamic' => 'IS_DYNAMIC',
        'SpyProductLabelTableMap::COL_IS_DYNAMIC' => 'IS_DYNAMIC',
        'COL_IS_DYNAMIC' => 'IS_DYNAMIC',
        'is_dynamic' => 'IS_DYNAMIC',
        'spy_product_label.is_dynamic' => 'IS_DYNAMIC',
        'IsExclusive' => 'IS_EXCLUSIVE',
        'SpyProductLabel.IsExclusive' => 'IS_EXCLUSIVE',
        'isExclusive' => 'IS_EXCLUSIVE',
        'spyProductLabel.isExclusive' => 'IS_EXCLUSIVE',
        'SpyProductLabelTableMap::COL_IS_EXCLUSIVE' => 'IS_EXCLUSIVE',
        'COL_IS_EXCLUSIVE' => 'IS_EXCLUSIVE',
        'is_exclusive' => 'IS_EXCLUSIVE',
        'spy_product_label.is_exclusive' => 'IS_EXCLUSIVE',
        'IsPublished' => 'IS_PUBLISHED',
        'SpyProductLabel.IsPublished' => 'IS_PUBLISHED',
        'isPublished' => 'IS_PUBLISHED',
        'spyProductLabel.isPublished' => 'IS_PUBLISHED',
        'SpyProductLabelTableMap::COL_IS_PUBLISHED' => 'IS_PUBLISHED',
        'COL_IS_PUBLISHED' => 'IS_PUBLISHED',
        'is_published' => 'IS_PUBLISHED',
        'spy_product_label.is_published' => 'IS_PUBLISHED',
        'Name' => 'NAME',
        'SpyProductLabel.Name' => 'NAME',
        'name' => 'NAME',
        'spyProductLabel.name' => 'NAME',
        'SpyProductLabelTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_product_label.name' => 'NAME',
        'Position' => 'POSITION',
        'SpyProductLabel.Position' => 'POSITION',
        'position' => 'POSITION',
        'spyProductLabel.position' => 'POSITION',
        'SpyProductLabelTableMap::COL_POSITION' => 'POSITION',
        'COL_POSITION' => 'POSITION',
        'spy_product_label.position' => 'POSITION',
        'ValidFrom' => 'VALID_FROM',
        'SpyProductLabel.ValidFrom' => 'VALID_FROM',
        'validFrom' => 'VALID_FROM',
        'spyProductLabel.validFrom' => 'VALID_FROM',
        'SpyProductLabelTableMap::COL_VALID_FROM' => 'VALID_FROM',
        'COL_VALID_FROM' => 'VALID_FROM',
        'valid_from' => 'VALID_FROM',
        'spy_product_label.valid_from' => 'VALID_FROM',
        'ValidTo' => 'VALID_TO',
        'SpyProductLabel.ValidTo' => 'VALID_TO',
        'validTo' => 'VALID_TO',
        'spyProductLabel.validTo' => 'VALID_TO',
        'SpyProductLabelTableMap::COL_VALID_TO' => 'VALID_TO',
        'COL_VALID_TO' => 'VALID_TO',
        'valid_to' => 'VALID_TO',
        'spy_product_label.valid_to' => 'VALID_TO',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductLabel.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductLabel.createdAt' => 'CREATED_AT',
        'SpyProductLabelTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_label.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductLabel.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductLabel.updatedAt' => 'UPDATED_AT',
        'SpyProductLabelTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_label.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_label');
        $this->setPhpName('SpyProductLabel');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ProductLabel\\Persistence\\SpyProductLabel');
        $this->setPackage('src.Orm.Zed.ProductLabel.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_label_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_label', 'IdProductLabel', 'INTEGER', true, null, null);
        $this->addColumn('front_end_reference', 'FrontEndReference', 'VARCHAR', false, 255, null);
        $this->addColumn('is_active', 'IsActive', 'BOOLEAN', true, 1, false);
        $this->addColumn('is_dynamic', 'IsDynamic', 'BOOLEAN', true, 1, false);
        $this->addColumn('is_exclusive', 'IsExclusive', 'BOOLEAN', true, 1, false);
        $this->addColumn('is_published', 'IsPublished', 'BOOLEAN', false, 1, false);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('position', 'Position', 'INTEGER', true, null, null);
        $this->addColumn('valid_from', 'ValidFrom', 'TIMESTAMP', false, null, null);
        $this->addColumn('valid_to', 'ValidTo', 'TIMESTAMP', false, null, null);
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
        $this->addRelation('ProductLabelStore', '\\Orm\\Zed\\ProductLabel\\Persistence\\SpyProductLabelStore', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_label',
    1 => ':id_product_label',
  ),
), null, null, 'ProductLabelStores', false);
        $this->addRelation('SpyProductLabelLocalizedAttributes', '\\Orm\\Zed\\ProductLabel\\Persistence\\SpyProductLabelLocalizedAttributes', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_label',
    1 => ':id_product_label',
  ),
), null, null, 'SpyProductLabelLocalizedAttributess', false);
        $this->addRelation('SpyProductLabelProductAbstract', '\\Orm\\Zed\\ProductLabel\\Persistence\\SpyProductLabelProductAbstract', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_product_label',
    1 => ':id_product_label',
  ),
), null, null, 'SpyProductLabelProductAbstracts', false);
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
            'event' => ['spy_product_label_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductLabel', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductLabel', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductLabel', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductLabel', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductLabel', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductLabel', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductLabel', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductLabelTableMap::CLASS_DEFAULT : SpyProductLabelTableMap::OM_CLASS;
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
     * @return array (SpyProductLabel object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductLabelTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductLabelTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductLabelTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductLabelTableMap::OM_CLASS;
            /** @var SpyProductLabel $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductLabelTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductLabelTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductLabelTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductLabel $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductLabelTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductLabelTableMap::COL_ID_PRODUCT_LABEL);
            $criteria->addSelectColumn(SpyProductLabelTableMap::COL_FRONT_END_REFERENCE);
            $criteria->addSelectColumn(SpyProductLabelTableMap::COL_IS_ACTIVE);
            $criteria->addSelectColumn(SpyProductLabelTableMap::COL_IS_DYNAMIC);
            $criteria->addSelectColumn(SpyProductLabelTableMap::COL_IS_EXCLUSIVE);
            $criteria->addSelectColumn(SpyProductLabelTableMap::COL_IS_PUBLISHED);
            $criteria->addSelectColumn(SpyProductLabelTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyProductLabelTableMap::COL_POSITION);
            $criteria->addSelectColumn(SpyProductLabelTableMap::COL_VALID_FROM);
            $criteria->addSelectColumn(SpyProductLabelTableMap::COL_VALID_TO);
            $criteria->addSelectColumn(SpyProductLabelTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductLabelTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_label');
            $criteria->addSelectColumn($alias . '.front_end_reference');
            $criteria->addSelectColumn($alias . '.is_active');
            $criteria->addSelectColumn($alias . '.is_dynamic');
            $criteria->addSelectColumn($alias . '.is_exclusive');
            $criteria->addSelectColumn($alias . '.is_published');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.position');
            $criteria->addSelectColumn($alias . '.valid_from');
            $criteria->addSelectColumn($alias . '.valid_to');
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
            $criteria->removeSelectColumn(SpyProductLabelTableMap::COL_ID_PRODUCT_LABEL);
            $criteria->removeSelectColumn(SpyProductLabelTableMap::COL_FRONT_END_REFERENCE);
            $criteria->removeSelectColumn(SpyProductLabelTableMap::COL_IS_ACTIVE);
            $criteria->removeSelectColumn(SpyProductLabelTableMap::COL_IS_DYNAMIC);
            $criteria->removeSelectColumn(SpyProductLabelTableMap::COL_IS_EXCLUSIVE);
            $criteria->removeSelectColumn(SpyProductLabelTableMap::COL_IS_PUBLISHED);
            $criteria->removeSelectColumn(SpyProductLabelTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyProductLabelTableMap::COL_POSITION);
            $criteria->removeSelectColumn(SpyProductLabelTableMap::COL_VALID_FROM);
            $criteria->removeSelectColumn(SpyProductLabelTableMap::COL_VALID_TO);
            $criteria->removeSelectColumn(SpyProductLabelTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductLabelTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_label');
            $criteria->removeSelectColumn($alias . '.front_end_reference');
            $criteria->removeSelectColumn($alias . '.is_active');
            $criteria->removeSelectColumn($alias . '.is_dynamic');
            $criteria->removeSelectColumn($alias . '.is_exclusive');
            $criteria->removeSelectColumn($alias . '.is_published');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.position');
            $criteria->removeSelectColumn($alias . '.valid_from');
            $criteria->removeSelectColumn($alias . '.valid_to');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductLabelTableMap::DATABASE_NAME)->getTable(SpyProductLabelTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductLabel or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductLabel object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductLabelTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductLabel\Persistence\SpyProductLabel) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductLabelTableMap::DATABASE_NAME);
            $criteria->add(SpyProductLabelTableMap::COL_ID_PRODUCT_LABEL, (array) $values, Criteria::IN);
        }

        $query = SpyProductLabelQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductLabelTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductLabelTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_label table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductLabelQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductLabel or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductLabel object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductLabelTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductLabel object
        }

        if ($criteria->containsKey(SpyProductLabelTableMap::COL_ID_PRODUCT_LABEL) && $criteria->keyContainsValue(SpyProductLabelTableMap::COL_ID_PRODUCT_LABEL) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyProductLabelTableMap::COL_ID_PRODUCT_LABEL.')');
        }


        // Set the correct dbName
        $query = SpyProductLabelQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
