<?php

namespace Orm\Zed\ProductSet\Persistence\Map;

use Orm\Zed\ProductSet\Persistence\SpyProductSetData;
use Orm\Zed\ProductSet\Persistence\SpyProductSetDataQuery;
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
 * This class defines the structure of the 'spy_product_set_data' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductSetDataTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductSet.Persistence.Map.SpyProductSetDataTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_set_data';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductSetData';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductSet\\Persistence\\SpyProductSetData';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductSet.Persistence.SpyProductSetData';

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
     * the column name for the id_product_set_data field
     */
    public const COL_ID_PRODUCT_SET_DATA = 'spy_product_set_data.id_product_set_data';

    /**
     * the column name for the fk_locale field
     */
    public const COL_FK_LOCALE = 'spy_product_set_data.fk_locale';

    /**
     * the column name for the fk_product_set field
     */
    public const COL_FK_PRODUCT_SET = 'spy_product_set_data.fk_product_set';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'spy_product_set_data.description';

    /**
     * the column name for the meta_description field
     */
    public const COL_META_DESCRIPTION = 'spy_product_set_data.meta_description';

    /**
     * the column name for the meta_keywords field
     */
    public const COL_META_KEYWORDS = 'spy_product_set_data.meta_keywords';

    /**
     * the column name for the meta_title field
     */
    public const COL_META_TITLE = 'spy_product_set_data.meta_title';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_product_set_data.name';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_set_data.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_set_data.updated_at';

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
        self::TYPE_PHPNAME       => ['IdProductSetData', 'FkLocale', 'FkProductSet', 'Description', 'MetaDescription', 'MetaKeywords', 'MetaTitle', 'Name', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductSetData', 'fkLocale', 'fkProductSet', 'description', 'metaDescription', 'metaKeywords', 'metaTitle', 'name', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductSetDataTableMap::COL_ID_PRODUCT_SET_DATA, SpyProductSetDataTableMap::COL_FK_LOCALE, SpyProductSetDataTableMap::COL_FK_PRODUCT_SET, SpyProductSetDataTableMap::COL_DESCRIPTION, SpyProductSetDataTableMap::COL_META_DESCRIPTION, SpyProductSetDataTableMap::COL_META_KEYWORDS, SpyProductSetDataTableMap::COL_META_TITLE, SpyProductSetDataTableMap::COL_NAME, SpyProductSetDataTableMap::COL_CREATED_AT, SpyProductSetDataTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_set_data', 'fk_locale', 'fk_product_set', 'description', 'meta_description', 'meta_keywords', 'meta_title', 'name', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProductSetData' => 0, 'FkLocale' => 1, 'FkProductSet' => 2, 'Description' => 3, 'MetaDescription' => 4, 'MetaKeywords' => 5, 'MetaTitle' => 6, 'Name' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, ],
        self::TYPE_CAMELNAME     => ['idProductSetData' => 0, 'fkLocale' => 1, 'fkProductSet' => 2, 'description' => 3, 'metaDescription' => 4, 'metaKeywords' => 5, 'metaTitle' => 6, 'name' => 7, 'createdAt' => 8, 'updatedAt' => 9, ],
        self::TYPE_COLNAME       => [SpyProductSetDataTableMap::COL_ID_PRODUCT_SET_DATA => 0, SpyProductSetDataTableMap::COL_FK_LOCALE => 1, SpyProductSetDataTableMap::COL_FK_PRODUCT_SET => 2, SpyProductSetDataTableMap::COL_DESCRIPTION => 3, SpyProductSetDataTableMap::COL_META_DESCRIPTION => 4, SpyProductSetDataTableMap::COL_META_KEYWORDS => 5, SpyProductSetDataTableMap::COL_META_TITLE => 6, SpyProductSetDataTableMap::COL_NAME => 7, SpyProductSetDataTableMap::COL_CREATED_AT => 8, SpyProductSetDataTableMap::COL_UPDATED_AT => 9, ],
        self::TYPE_FIELDNAME     => ['id_product_set_data' => 0, 'fk_locale' => 1, 'fk_product_set' => 2, 'description' => 3, 'meta_description' => 4, 'meta_keywords' => 5, 'meta_title' => 6, 'name' => 7, 'created_at' => 8, 'updated_at' => 9, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductSetData' => 'ID_PRODUCT_SET_DATA',
        'SpyProductSetData.IdProductSetData' => 'ID_PRODUCT_SET_DATA',
        'idProductSetData' => 'ID_PRODUCT_SET_DATA',
        'spyProductSetData.idProductSetData' => 'ID_PRODUCT_SET_DATA',
        'SpyProductSetDataTableMap::COL_ID_PRODUCT_SET_DATA' => 'ID_PRODUCT_SET_DATA',
        'COL_ID_PRODUCT_SET_DATA' => 'ID_PRODUCT_SET_DATA',
        'id_product_set_data' => 'ID_PRODUCT_SET_DATA',
        'spy_product_set_data.id_product_set_data' => 'ID_PRODUCT_SET_DATA',
        'FkLocale' => 'FK_LOCALE',
        'SpyProductSetData.FkLocale' => 'FK_LOCALE',
        'fkLocale' => 'FK_LOCALE',
        'spyProductSetData.fkLocale' => 'FK_LOCALE',
        'SpyProductSetDataTableMap::COL_FK_LOCALE' => 'FK_LOCALE',
        'COL_FK_LOCALE' => 'FK_LOCALE',
        'fk_locale' => 'FK_LOCALE',
        'spy_product_set_data.fk_locale' => 'FK_LOCALE',
        'FkProductSet' => 'FK_PRODUCT_SET',
        'SpyProductSetData.FkProductSet' => 'FK_PRODUCT_SET',
        'fkProductSet' => 'FK_PRODUCT_SET',
        'spyProductSetData.fkProductSet' => 'FK_PRODUCT_SET',
        'SpyProductSetDataTableMap::COL_FK_PRODUCT_SET' => 'FK_PRODUCT_SET',
        'COL_FK_PRODUCT_SET' => 'FK_PRODUCT_SET',
        'fk_product_set' => 'FK_PRODUCT_SET',
        'spy_product_set_data.fk_product_set' => 'FK_PRODUCT_SET',
        'Description' => 'DESCRIPTION',
        'SpyProductSetData.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'spyProductSetData.description' => 'DESCRIPTION',
        'SpyProductSetDataTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'spy_product_set_data.description' => 'DESCRIPTION',
        'MetaDescription' => 'META_DESCRIPTION',
        'SpyProductSetData.MetaDescription' => 'META_DESCRIPTION',
        'metaDescription' => 'META_DESCRIPTION',
        'spyProductSetData.metaDescription' => 'META_DESCRIPTION',
        'SpyProductSetDataTableMap::COL_META_DESCRIPTION' => 'META_DESCRIPTION',
        'COL_META_DESCRIPTION' => 'META_DESCRIPTION',
        'meta_description' => 'META_DESCRIPTION',
        'spy_product_set_data.meta_description' => 'META_DESCRIPTION',
        'MetaKeywords' => 'META_KEYWORDS',
        'SpyProductSetData.MetaKeywords' => 'META_KEYWORDS',
        'metaKeywords' => 'META_KEYWORDS',
        'spyProductSetData.metaKeywords' => 'META_KEYWORDS',
        'SpyProductSetDataTableMap::COL_META_KEYWORDS' => 'META_KEYWORDS',
        'COL_META_KEYWORDS' => 'META_KEYWORDS',
        'meta_keywords' => 'META_KEYWORDS',
        'spy_product_set_data.meta_keywords' => 'META_KEYWORDS',
        'MetaTitle' => 'META_TITLE',
        'SpyProductSetData.MetaTitle' => 'META_TITLE',
        'metaTitle' => 'META_TITLE',
        'spyProductSetData.metaTitle' => 'META_TITLE',
        'SpyProductSetDataTableMap::COL_META_TITLE' => 'META_TITLE',
        'COL_META_TITLE' => 'META_TITLE',
        'meta_title' => 'META_TITLE',
        'spy_product_set_data.meta_title' => 'META_TITLE',
        'Name' => 'NAME',
        'SpyProductSetData.Name' => 'NAME',
        'name' => 'NAME',
        'spyProductSetData.name' => 'NAME',
        'SpyProductSetDataTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_product_set_data.name' => 'NAME',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductSetData.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductSetData.createdAt' => 'CREATED_AT',
        'SpyProductSetDataTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_set_data.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductSetData.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductSetData.updatedAt' => 'UPDATED_AT',
        'SpyProductSetDataTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_set_data.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_set_data');
        $this->setPhpName('SpyProductSetData');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\ProductSet\\Persistence\\SpyProductSetData');
        $this->setPackage('src.Orm.Zed.ProductSet.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_set_data_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_set_data', 'IdProductSetData', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_locale', 'FkLocale', 'INTEGER', 'spy_locale', 'id_locale', true, null, null);
        $this->addForeignKey('fk_product_set', 'FkProductSet', 'INTEGER', 'spy_product_set', 'id_product_set', true, null, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('meta_description', 'MetaDescription', 'LONGVARCHAR', false, null, null);
        $this->addColumn('meta_keywords', 'MetaKeywords', 'LONGVARCHAR', false, null, null);
        $this->addColumn('meta_title', 'MetaTitle', 'VARCHAR', false, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
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
        $this->addRelation('SpyProductSet', '\\Orm\\Zed\\ProductSet\\Persistence\\SpyProductSet', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_set',
    1 => ':id_product_set',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('SpyLocale', '\\Orm\\Zed\\Locale\\Persistence\\SpyLocale', RelationMap::MANY_TO_ONE, array (
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
            'event' => ['spy_product_set_data_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSetData', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSetData', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSetData', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSetData', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSetData', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductSetData', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductSetData', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductSetDataTableMap::CLASS_DEFAULT : SpyProductSetDataTableMap::OM_CLASS;
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
     * @return array (SpyProductSetData object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductSetDataTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductSetDataTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductSetDataTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductSetDataTableMap::OM_CLASS;
            /** @var SpyProductSetData $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductSetDataTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductSetDataTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductSetDataTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductSetData $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductSetDataTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductSetDataTableMap::COL_ID_PRODUCT_SET_DATA);
            $criteria->addSelectColumn(SpyProductSetDataTableMap::COL_FK_LOCALE);
            $criteria->addSelectColumn(SpyProductSetDataTableMap::COL_FK_PRODUCT_SET);
            $criteria->addSelectColumn(SpyProductSetDataTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SpyProductSetDataTableMap::COL_META_DESCRIPTION);
            $criteria->addSelectColumn(SpyProductSetDataTableMap::COL_META_KEYWORDS);
            $criteria->addSelectColumn(SpyProductSetDataTableMap::COL_META_TITLE);
            $criteria->addSelectColumn(SpyProductSetDataTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyProductSetDataTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductSetDataTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_set_data');
            $criteria->addSelectColumn($alias . '.fk_locale');
            $criteria->addSelectColumn($alias . '.fk_product_set');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.meta_description');
            $criteria->addSelectColumn($alias . '.meta_keywords');
            $criteria->addSelectColumn($alias . '.meta_title');
            $criteria->addSelectColumn($alias . '.name');
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
            $criteria->removeSelectColumn(SpyProductSetDataTableMap::COL_ID_PRODUCT_SET_DATA);
            $criteria->removeSelectColumn(SpyProductSetDataTableMap::COL_FK_LOCALE);
            $criteria->removeSelectColumn(SpyProductSetDataTableMap::COL_FK_PRODUCT_SET);
            $criteria->removeSelectColumn(SpyProductSetDataTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(SpyProductSetDataTableMap::COL_META_DESCRIPTION);
            $criteria->removeSelectColumn(SpyProductSetDataTableMap::COL_META_KEYWORDS);
            $criteria->removeSelectColumn(SpyProductSetDataTableMap::COL_META_TITLE);
            $criteria->removeSelectColumn(SpyProductSetDataTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyProductSetDataTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductSetDataTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_set_data');
            $criteria->removeSelectColumn($alias . '.fk_locale');
            $criteria->removeSelectColumn($alias . '.fk_product_set');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.meta_description');
            $criteria->removeSelectColumn($alias . '.meta_keywords');
            $criteria->removeSelectColumn($alias . '.meta_title');
            $criteria->removeSelectColumn($alias . '.name');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductSetDataTableMap::DATABASE_NAME)->getTable(SpyProductSetDataTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductSetData or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductSetData object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductSetDataTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductSet\Persistence\SpyProductSetData) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductSetDataTableMap::DATABASE_NAME);
            $criteria->add(SpyProductSetDataTableMap::COL_ID_PRODUCT_SET_DATA, (array) $values, Criteria::IN);
        }

        $query = SpyProductSetDataQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductSetDataTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductSetDataTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_set_data table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductSetDataQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductSetData or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductSetData object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductSetDataTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductSetData object
        }


        // Set the correct dbName
        $query = SpyProductSetDataQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
