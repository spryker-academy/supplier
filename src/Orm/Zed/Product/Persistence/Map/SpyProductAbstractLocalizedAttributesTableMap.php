<?php

namespace Orm\Zed\Product\Persistence\Map;

use Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes;
use Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributesQuery;
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
 * This class defines the structure of the 'spy_product_abstract_localized_attributes' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductAbstractLocalizedAttributesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Product.Persistence.Map.SpyProductAbstractLocalizedAttributesTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_abstract_localized_attributes';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductAbstractLocalizedAttributes';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstractLocalizedAttributes';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Product.Persistence.SpyProductAbstractLocalizedAttributes';

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
     * the column name for the id_abstract_attributes field
     */
    public const COL_ID_ABSTRACT_ATTRIBUTES = 'spy_product_abstract_localized_attributes.id_abstract_attributes';

    /**
     * the column name for the fk_locale field
     */
    public const COL_FK_LOCALE = 'spy_product_abstract_localized_attributes.fk_locale';

    /**
     * the column name for the fk_product_abstract field
     */
    public const COL_FK_PRODUCT_ABSTRACT = 'spy_product_abstract_localized_attributes.fk_product_abstract';

    /**
     * the column name for the attributes field
     */
    public const COL_ATTRIBUTES = 'spy_product_abstract_localized_attributes.attributes';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'spy_product_abstract_localized_attributes.description';

    /**
     * the column name for the meta_description field
     */
    public const COL_META_DESCRIPTION = 'spy_product_abstract_localized_attributes.meta_description';

    /**
     * the column name for the meta_keywords field
     */
    public const COL_META_KEYWORDS = 'spy_product_abstract_localized_attributes.meta_keywords';

    /**
     * the column name for the meta_title field
     */
    public const COL_META_TITLE = 'spy_product_abstract_localized_attributes.meta_title';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_product_abstract_localized_attributes.name';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_abstract_localized_attributes.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_abstract_localized_attributes.updated_at';

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
        self::TYPE_PHPNAME       => ['IdAbstractAttributes', 'FkLocale', 'FkProductAbstract', 'Attributes', 'Description', 'MetaDescription', 'MetaKeywords', 'MetaTitle', 'Name', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idAbstractAttributes', 'fkLocale', 'fkProductAbstract', 'attributes', 'description', 'metaDescription', 'metaKeywords', 'metaTitle', 'name', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductAbstractLocalizedAttributesTableMap::COL_ID_ABSTRACT_ATTRIBUTES, SpyProductAbstractLocalizedAttributesTableMap::COL_FK_LOCALE, SpyProductAbstractLocalizedAttributesTableMap::COL_FK_PRODUCT_ABSTRACT, SpyProductAbstractLocalizedAttributesTableMap::COL_ATTRIBUTES, SpyProductAbstractLocalizedAttributesTableMap::COL_DESCRIPTION, SpyProductAbstractLocalizedAttributesTableMap::COL_META_DESCRIPTION, SpyProductAbstractLocalizedAttributesTableMap::COL_META_KEYWORDS, SpyProductAbstractLocalizedAttributesTableMap::COL_META_TITLE, SpyProductAbstractLocalizedAttributesTableMap::COL_NAME, SpyProductAbstractLocalizedAttributesTableMap::COL_CREATED_AT, SpyProductAbstractLocalizedAttributesTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_abstract_attributes', 'fk_locale', 'fk_product_abstract', 'attributes', 'description', 'meta_description', 'meta_keywords', 'meta_title', 'name', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdAbstractAttributes' => 0, 'FkLocale' => 1, 'FkProductAbstract' => 2, 'Attributes' => 3, 'Description' => 4, 'MetaDescription' => 5, 'MetaKeywords' => 6, 'MetaTitle' => 7, 'Name' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ],
        self::TYPE_CAMELNAME     => ['idAbstractAttributes' => 0, 'fkLocale' => 1, 'fkProductAbstract' => 2, 'attributes' => 3, 'description' => 4, 'metaDescription' => 5, 'metaKeywords' => 6, 'metaTitle' => 7, 'name' => 8, 'createdAt' => 9, 'updatedAt' => 10, ],
        self::TYPE_COLNAME       => [SpyProductAbstractLocalizedAttributesTableMap::COL_ID_ABSTRACT_ATTRIBUTES => 0, SpyProductAbstractLocalizedAttributesTableMap::COL_FK_LOCALE => 1, SpyProductAbstractLocalizedAttributesTableMap::COL_FK_PRODUCT_ABSTRACT => 2, SpyProductAbstractLocalizedAttributesTableMap::COL_ATTRIBUTES => 3, SpyProductAbstractLocalizedAttributesTableMap::COL_DESCRIPTION => 4, SpyProductAbstractLocalizedAttributesTableMap::COL_META_DESCRIPTION => 5, SpyProductAbstractLocalizedAttributesTableMap::COL_META_KEYWORDS => 6, SpyProductAbstractLocalizedAttributesTableMap::COL_META_TITLE => 7, SpyProductAbstractLocalizedAttributesTableMap::COL_NAME => 8, SpyProductAbstractLocalizedAttributesTableMap::COL_CREATED_AT => 9, SpyProductAbstractLocalizedAttributesTableMap::COL_UPDATED_AT => 10, ],
        self::TYPE_FIELDNAME     => ['id_abstract_attributes' => 0, 'fk_locale' => 1, 'fk_product_abstract' => 2, 'attributes' => 3, 'description' => 4, 'meta_description' => 5, 'meta_keywords' => 6, 'meta_title' => 7, 'name' => 8, 'created_at' => 9, 'updated_at' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdAbstractAttributes' => 'ID_ABSTRACT_ATTRIBUTES',
        'SpyProductAbstractLocalizedAttributes.IdAbstractAttributes' => 'ID_ABSTRACT_ATTRIBUTES',
        'idAbstractAttributes' => 'ID_ABSTRACT_ATTRIBUTES',
        'spyProductAbstractLocalizedAttributes.idAbstractAttributes' => 'ID_ABSTRACT_ATTRIBUTES',
        'SpyProductAbstractLocalizedAttributesTableMap::COL_ID_ABSTRACT_ATTRIBUTES' => 'ID_ABSTRACT_ATTRIBUTES',
        'COL_ID_ABSTRACT_ATTRIBUTES' => 'ID_ABSTRACT_ATTRIBUTES',
        'id_abstract_attributes' => 'ID_ABSTRACT_ATTRIBUTES',
        'spy_product_abstract_localized_attributes.id_abstract_attributes' => 'ID_ABSTRACT_ATTRIBUTES',
        'FkLocale' => 'FK_LOCALE',
        'SpyProductAbstractLocalizedAttributes.FkLocale' => 'FK_LOCALE',
        'fkLocale' => 'FK_LOCALE',
        'spyProductAbstractLocalizedAttributes.fkLocale' => 'FK_LOCALE',
        'SpyProductAbstractLocalizedAttributesTableMap::COL_FK_LOCALE' => 'FK_LOCALE',
        'COL_FK_LOCALE' => 'FK_LOCALE',
        'fk_locale' => 'FK_LOCALE',
        'spy_product_abstract_localized_attributes.fk_locale' => 'FK_LOCALE',
        'FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyProductAbstractLocalizedAttributes.FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'spyProductAbstractLocalizedAttributes.fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyProductAbstractLocalizedAttributesTableMap::COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'spy_product_abstract_localized_attributes.fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'Attributes' => 'ATTRIBUTES',
        'SpyProductAbstractLocalizedAttributes.Attributes' => 'ATTRIBUTES',
        'attributes' => 'ATTRIBUTES',
        'spyProductAbstractLocalizedAttributes.attributes' => 'ATTRIBUTES',
        'SpyProductAbstractLocalizedAttributesTableMap::COL_ATTRIBUTES' => 'ATTRIBUTES',
        'COL_ATTRIBUTES' => 'ATTRIBUTES',
        'spy_product_abstract_localized_attributes.attributes' => 'ATTRIBUTES',
        'Description' => 'DESCRIPTION',
        'SpyProductAbstractLocalizedAttributes.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'spyProductAbstractLocalizedAttributes.description' => 'DESCRIPTION',
        'SpyProductAbstractLocalizedAttributesTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'spy_product_abstract_localized_attributes.description' => 'DESCRIPTION',
        'MetaDescription' => 'META_DESCRIPTION',
        'SpyProductAbstractLocalizedAttributes.MetaDescription' => 'META_DESCRIPTION',
        'metaDescription' => 'META_DESCRIPTION',
        'spyProductAbstractLocalizedAttributes.metaDescription' => 'META_DESCRIPTION',
        'SpyProductAbstractLocalizedAttributesTableMap::COL_META_DESCRIPTION' => 'META_DESCRIPTION',
        'COL_META_DESCRIPTION' => 'META_DESCRIPTION',
        'meta_description' => 'META_DESCRIPTION',
        'spy_product_abstract_localized_attributes.meta_description' => 'META_DESCRIPTION',
        'MetaKeywords' => 'META_KEYWORDS',
        'SpyProductAbstractLocalizedAttributes.MetaKeywords' => 'META_KEYWORDS',
        'metaKeywords' => 'META_KEYWORDS',
        'spyProductAbstractLocalizedAttributes.metaKeywords' => 'META_KEYWORDS',
        'SpyProductAbstractLocalizedAttributesTableMap::COL_META_KEYWORDS' => 'META_KEYWORDS',
        'COL_META_KEYWORDS' => 'META_KEYWORDS',
        'meta_keywords' => 'META_KEYWORDS',
        'spy_product_abstract_localized_attributes.meta_keywords' => 'META_KEYWORDS',
        'MetaTitle' => 'META_TITLE',
        'SpyProductAbstractLocalizedAttributes.MetaTitle' => 'META_TITLE',
        'metaTitle' => 'META_TITLE',
        'spyProductAbstractLocalizedAttributes.metaTitle' => 'META_TITLE',
        'SpyProductAbstractLocalizedAttributesTableMap::COL_META_TITLE' => 'META_TITLE',
        'COL_META_TITLE' => 'META_TITLE',
        'meta_title' => 'META_TITLE',
        'spy_product_abstract_localized_attributes.meta_title' => 'META_TITLE',
        'Name' => 'NAME',
        'SpyProductAbstractLocalizedAttributes.Name' => 'NAME',
        'name' => 'NAME',
        'spyProductAbstractLocalizedAttributes.name' => 'NAME',
        'SpyProductAbstractLocalizedAttributesTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_product_abstract_localized_attributes.name' => 'NAME',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductAbstractLocalizedAttributes.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductAbstractLocalizedAttributes.createdAt' => 'CREATED_AT',
        'SpyProductAbstractLocalizedAttributesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_abstract_localized_attributes.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductAbstractLocalizedAttributes.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductAbstractLocalizedAttributes.updatedAt' => 'UPDATED_AT',
        'SpyProductAbstractLocalizedAttributesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_abstract_localized_attributes.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_product_abstract_localized_attributes');
        $this->setPhpName('SpyProductAbstractLocalizedAttributes');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstractLocalizedAttributes');
        $this->setPackage('src.Orm.Zed.Product.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_product_abstract_localized_attributes_pk_seq');
        // columns
        $this->addPrimaryKey('id_abstract_attributes', 'IdAbstractAttributes', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_locale', 'FkLocale', 'INTEGER', 'spy_locale', 'id_locale', true, null, null);
        $this->addForeignKey('fk_product_abstract', 'FkProductAbstract', 'INTEGER', 'spy_product_abstract', 'id_product_abstract', true, null, null);
        $this->addColumn('attributes', 'Attributes', 'LONGVARCHAR', true, null, null);
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
        $this->addRelation('SpyProductAbstract', '\\Orm\\Zed\\Product\\Persistence\\SpyProductAbstract', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_product_abstract',
    1 => ':id_product_abstract',
  ),
), 'CASCADE', 'CASCADE', null, false);
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
            'event' => ['spy_product_abstract_localized_attributes_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAbstractAttributes', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAbstractAttributes', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAbstractAttributes', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAbstractAttributes', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAbstractAttributes', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdAbstractAttributes', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdAbstractAttributes', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductAbstractLocalizedAttributesTableMap::CLASS_DEFAULT : SpyProductAbstractLocalizedAttributesTableMap::OM_CLASS;
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
     * @return array (SpyProductAbstractLocalizedAttributes object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductAbstractLocalizedAttributesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductAbstractLocalizedAttributesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductAbstractLocalizedAttributesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductAbstractLocalizedAttributesTableMap::OM_CLASS;
            /** @var SpyProductAbstractLocalizedAttributes $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductAbstractLocalizedAttributesTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductAbstractLocalizedAttributesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductAbstractLocalizedAttributesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductAbstractLocalizedAttributes $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductAbstractLocalizedAttributesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_ID_ABSTRACT_ATTRIBUTES);
            $criteria->addSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_FK_LOCALE);
            $criteria->addSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->addSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_ATTRIBUTES);
            $criteria->addSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_META_DESCRIPTION);
            $criteria->addSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_META_KEYWORDS);
            $criteria->addSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_META_TITLE);
            $criteria->addSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_NAME);
            $criteria->addSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_abstract_attributes');
            $criteria->addSelectColumn($alias . '.fk_locale');
            $criteria->addSelectColumn($alias . '.fk_product_abstract');
            $criteria->addSelectColumn($alias . '.attributes');
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
            $criteria->removeSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_ID_ABSTRACT_ATTRIBUTES);
            $criteria->removeSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_FK_LOCALE);
            $criteria->removeSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->removeSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_ATTRIBUTES);
            $criteria->removeSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_META_DESCRIPTION);
            $criteria->removeSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_META_KEYWORDS);
            $criteria->removeSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_META_TITLE);
            $criteria->removeSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductAbstractLocalizedAttributesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_abstract_attributes');
            $criteria->removeSelectColumn($alias . '.fk_locale');
            $criteria->removeSelectColumn($alias . '.fk_product_abstract');
            $criteria->removeSelectColumn($alias . '.attributes');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductAbstractLocalizedAttributesTableMap::DATABASE_NAME)->getTable(SpyProductAbstractLocalizedAttributesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductAbstractLocalizedAttributes or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductAbstractLocalizedAttributes object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductAbstractLocalizedAttributesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Product\Persistence\SpyProductAbstractLocalizedAttributes) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductAbstractLocalizedAttributesTableMap::DATABASE_NAME);
            $criteria->add(SpyProductAbstractLocalizedAttributesTableMap::COL_ID_ABSTRACT_ATTRIBUTES, (array) $values, Criteria::IN);
        }

        $query = SpyProductAbstractLocalizedAttributesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductAbstractLocalizedAttributesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductAbstractLocalizedAttributesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_abstract_localized_attributes table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductAbstractLocalizedAttributesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductAbstractLocalizedAttributes or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductAbstractLocalizedAttributes object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductAbstractLocalizedAttributesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductAbstractLocalizedAttributes object
        }


        // Set the correct dbName
        $query = SpyProductAbstractLocalizedAttributesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
