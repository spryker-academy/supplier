<?php

namespace Orm\Zed\ProductReview\Persistence\Map;

use Orm\Zed\ProductReview\Persistence\SpyProductReview;
use Orm\Zed\ProductReview\Persistence\SpyProductReviewQuery;
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
 * This class defines the structure of the 'spy_product_review' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyProductReviewTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.ProductReview.Persistence.Map.SpyProductReviewTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_product_review';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyProductReview';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\ProductReview\\Persistence\\SpyProductReview';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.ProductReview.Persistence.SpyProductReview';

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
     * the column name for the id_product_review field
     */
    public const COL_ID_PRODUCT_REVIEW = 'spy_product_review.id_product_review';

    /**
     * the column name for the fk_locale field
     */
    public const COL_FK_LOCALE = 'spy_product_review.fk_locale';

    /**
     * the column name for the fk_product_abstract field
     */
    public const COL_FK_PRODUCT_ABSTRACT = 'spy_product_review.fk_product_abstract';

    /**
     * the column name for the customer_reference field
     */
    public const COL_CUSTOMER_REFERENCE = 'spy_product_review.customer_reference';

    /**
     * the column name for the description field
     */
    public const COL_DESCRIPTION = 'spy_product_review.description';

    /**
     * the column name for the nickname field
     */
    public const COL_NICKNAME = 'spy_product_review.nickname';

    /**
     * the column name for the rating field
     */
    public const COL_RATING = 'spy_product_review.rating';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'spy_product_review.status';

    /**
     * the column name for the summary field
     */
    public const COL_SUMMARY = 'spy_product_review.summary';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_product_review.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_product_review.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    public const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the status field */
    public const COL_STATUS_PENDING = 'pending';
    public const COL_STATUS_APPROVED = 'approved';
    public const COL_STATUS_REJECTED = 'rejected';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     *
     * @var array<string, mixed>
     */
    protected static $fieldNames = [
        self::TYPE_PHPNAME       => ['IdProductReview', 'FkLocale', 'FkProductAbstract', 'CustomerReference', 'Description', 'Nickname', 'Rating', 'Status', 'Summary', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idProductReview', 'fkLocale', 'fkProductAbstract', 'customerReference', 'description', 'nickname', 'rating', 'status', 'summary', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyProductReviewTableMap::COL_ID_PRODUCT_REVIEW, SpyProductReviewTableMap::COL_FK_LOCALE, SpyProductReviewTableMap::COL_FK_PRODUCT_ABSTRACT, SpyProductReviewTableMap::COL_CUSTOMER_REFERENCE, SpyProductReviewTableMap::COL_DESCRIPTION, SpyProductReviewTableMap::COL_NICKNAME, SpyProductReviewTableMap::COL_RATING, SpyProductReviewTableMap::COL_STATUS, SpyProductReviewTableMap::COL_SUMMARY, SpyProductReviewTableMap::COL_CREATED_AT, SpyProductReviewTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_product_review', 'fk_locale', 'fk_product_abstract', 'customer_reference', 'description', 'nickname', 'rating', 'status', 'summary', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdProductReview' => 0, 'FkLocale' => 1, 'FkProductAbstract' => 2, 'CustomerReference' => 3, 'Description' => 4, 'Nickname' => 5, 'Rating' => 6, 'Status' => 7, 'Summary' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ],
        self::TYPE_CAMELNAME     => ['idProductReview' => 0, 'fkLocale' => 1, 'fkProductAbstract' => 2, 'customerReference' => 3, 'description' => 4, 'nickname' => 5, 'rating' => 6, 'status' => 7, 'summary' => 8, 'createdAt' => 9, 'updatedAt' => 10, ],
        self::TYPE_COLNAME       => [SpyProductReviewTableMap::COL_ID_PRODUCT_REVIEW => 0, SpyProductReviewTableMap::COL_FK_LOCALE => 1, SpyProductReviewTableMap::COL_FK_PRODUCT_ABSTRACT => 2, SpyProductReviewTableMap::COL_CUSTOMER_REFERENCE => 3, SpyProductReviewTableMap::COL_DESCRIPTION => 4, SpyProductReviewTableMap::COL_NICKNAME => 5, SpyProductReviewTableMap::COL_RATING => 6, SpyProductReviewTableMap::COL_STATUS => 7, SpyProductReviewTableMap::COL_SUMMARY => 8, SpyProductReviewTableMap::COL_CREATED_AT => 9, SpyProductReviewTableMap::COL_UPDATED_AT => 10, ],
        self::TYPE_FIELDNAME     => ['id_product_review' => 0, 'fk_locale' => 1, 'fk_product_abstract' => 2, 'customer_reference' => 3, 'description' => 4, 'nickname' => 5, 'rating' => 6, 'status' => 7, 'summary' => 8, 'created_at' => 9, 'updated_at' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdProductReview' => 'ID_PRODUCT_REVIEW',
        'SpyProductReview.IdProductReview' => 'ID_PRODUCT_REVIEW',
        'idProductReview' => 'ID_PRODUCT_REVIEW',
        'spyProductReview.idProductReview' => 'ID_PRODUCT_REVIEW',
        'SpyProductReviewTableMap::COL_ID_PRODUCT_REVIEW' => 'ID_PRODUCT_REVIEW',
        'COL_ID_PRODUCT_REVIEW' => 'ID_PRODUCT_REVIEW',
        'id_product_review' => 'ID_PRODUCT_REVIEW',
        'spy_product_review.id_product_review' => 'ID_PRODUCT_REVIEW',
        'FkLocale' => 'FK_LOCALE',
        'SpyProductReview.FkLocale' => 'FK_LOCALE',
        'fkLocale' => 'FK_LOCALE',
        'spyProductReview.fkLocale' => 'FK_LOCALE',
        'SpyProductReviewTableMap::COL_FK_LOCALE' => 'FK_LOCALE',
        'COL_FK_LOCALE' => 'FK_LOCALE',
        'fk_locale' => 'FK_LOCALE',
        'spy_product_review.fk_locale' => 'FK_LOCALE',
        'FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyProductReview.FkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'spyProductReview.fkProductAbstract' => 'FK_PRODUCT_ABSTRACT',
        'SpyProductReviewTableMap::COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'COL_FK_PRODUCT_ABSTRACT' => 'FK_PRODUCT_ABSTRACT',
        'fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'spy_product_review.fk_product_abstract' => 'FK_PRODUCT_ABSTRACT',
        'CustomerReference' => 'CUSTOMER_REFERENCE',
        'SpyProductReview.CustomerReference' => 'CUSTOMER_REFERENCE',
        'customerReference' => 'CUSTOMER_REFERENCE',
        'spyProductReview.customerReference' => 'CUSTOMER_REFERENCE',
        'SpyProductReviewTableMap::COL_CUSTOMER_REFERENCE' => 'CUSTOMER_REFERENCE',
        'COL_CUSTOMER_REFERENCE' => 'CUSTOMER_REFERENCE',
        'customer_reference' => 'CUSTOMER_REFERENCE',
        'spy_product_review.customer_reference' => 'CUSTOMER_REFERENCE',
        'Description' => 'DESCRIPTION',
        'SpyProductReview.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'spyProductReview.description' => 'DESCRIPTION',
        'SpyProductReviewTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'spy_product_review.description' => 'DESCRIPTION',
        'Nickname' => 'NICKNAME',
        'SpyProductReview.Nickname' => 'NICKNAME',
        'nickname' => 'NICKNAME',
        'spyProductReview.nickname' => 'NICKNAME',
        'SpyProductReviewTableMap::COL_NICKNAME' => 'NICKNAME',
        'COL_NICKNAME' => 'NICKNAME',
        'spy_product_review.nickname' => 'NICKNAME',
        'Rating' => 'RATING',
        'SpyProductReview.Rating' => 'RATING',
        'rating' => 'RATING',
        'spyProductReview.rating' => 'RATING',
        'SpyProductReviewTableMap::COL_RATING' => 'RATING',
        'COL_RATING' => 'RATING',
        'spy_product_review.rating' => 'RATING',
        'Status' => 'STATUS',
        'SpyProductReview.Status' => 'STATUS',
        'status' => 'STATUS',
        'spyProductReview.status' => 'STATUS',
        'SpyProductReviewTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'spy_product_review.status' => 'STATUS',
        'Summary' => 'SUMMARY',
        'SpyProductReview.Summary' => 'SUMMARY',
        'summary' => 'SUMMARY',
        'spyProductReview.summary' => 'SUMMARY',
        'SpyProductReviewTableMap::COL_SUMMARY' => 'SUMMARY',
        'COL_SUMMARY' => 'SUMMARY',
        'spy_product_review.summary' => 'SUMMARY',
        'CreatedAt' => 'CREATED_AT',
        'SpyProductReview.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyProductReview.createdAt' => 'CREATED_AT',
        'SpyProductReviewTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_product_review.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyProductReview.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyProductReview.updatedAt' => 'UPDATED_AT',
        'SpyProductReviewTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_product_review.updated_at' => 'UPDATED_AT',
    ];

    /**
     * The enumerated values for this table
     *
     * @var array<string, array<string>>
     */
    protected static $enumValueSets = [
                SpyProductReviewTableMap::COL_STATUS => [
                            self::COL_STATUS_PENDING,
            self::COL_STATUS_APPROVED,
            self::COL_STATUS_REJECTED,
        ],
    ];

    /**
     * Gets the list of values for all ENUM and SET columns
     * @return array
     */
    public static function getValueSets(): array
    {
      return static::$enumValueSets;
    }

    /**
     * Gets the list of values for an ENUM or SET column
     * @param string $colname
     * @return array list of possible values for the column
     */
    public static function getValueSet(string $colname): array
    {
        $valueSets = self::getValueSets();

        return $valueSets[$colname];
    }

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
        $this->setName('spy_product_review');
        $this->setPhpName('SpyProductReview');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\ProductReview\\Persistence\\SpyProductReview');
        $this->setPackage('src.Orm.Zed.ProductReview.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_product_review_pk_seq');
        // columns
        $this->addPrimaryKey('id_product_review', 'IdProductReview', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_locale', 'FkLocale', 'INTEGER', 'spy_locale', 'id_locale', true, null, null);
        $this->addForeignKey('fk_product_abstract', 'FkProductAbstract', 'INTEGER', 'spy_product_abstract', 'id_product_abstract', true, null, null);
        $this->addColumn('customer_reference', 'CustomerReference', 'VARCHAR', true, 255, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('nickname', 'Nickname', 'VARCHAR', false, 255, null);
        $this->addColumn('rating', 'Rating', 'INTEGER', true, null, 0);
        $this->addColumn('status', 'Status', 'ENUM', true, null, 'pending');
        $this->getColumn('status')->setValueSet(array (
  0 => 'pending',
  1 => 'approved',
  2 => 'rejected',
));
        $this->addColumn('summary', 'Summary', 'LONGVARCHAR', false, null, null);
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
), null, null, null, false);
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
            'event' => ['spy_product_review_all' => ['column' => '*']],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductReview', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductReview', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductReview', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductReview', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductReview', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdProductReview', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdProductReview', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyProductReviewTableMap::CLASS_DEFAULT : SpyProductReviewTableMap::OM_CLASS;
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
     * @return array (SpyProductReview object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyProductReviewTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyProductReviewTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyProductReviewTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyProductReviewTableMap::OM_CLASS;
            /** @var SpyProductReview $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyProductReviewTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyProductReviewTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyProductReviewTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyProductReview $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyProductReviewTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyProductReviewTableMap::COL_ID_PRODUCT_REVIEW);
            $criteria->addSelectColumn(SpyProductReviewTableMap::COL_FK_LOCALE);
            $criteria->addSelectColumn(SpyProductReviewTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->addSelectColumn(SpyProductReviewTableMap::COL_CUSTOMER_REFERENCE);
            $criteria->addSelectColumn(SpyProductReviewTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(SpyProductReviewTableMap::COL_NICKNAME);
            $criteria->addSelectColumn(SpyProductReviewTableMap::COL_RATING);
            $criteria->addSelectColumn(SpyProductReviewTableMap::COL_STATUS);
            $criteria->addSelectColumn(SpyProductReviewTableMap::COL_SUMMARY);
            $criteria->addSelectColumn(SpyProductReviewTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyProductReviewTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_product_review');
            $criteria->addSelectColumn($alias . '.fk_locale');
            $criteria->addSelectColumn($alias . '.fk_product_abstract');
            $criteria->addSelectColumn($alias . '.customer_reference');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.nickname');
            $criteria->addSelectColumn($alias . '.rating');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.summary');
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
            $criteria->removeSelectColumn(SpyProductReviewTableMap::COL_ID_PRODUCT_REVIEW);
            $criteria->removeSelectColumn(SpyProductReviewTableMap::COL_FK_LOCALE);
            $criteria->removeSelectColumn(SpyProductReviewTableMap::COL_FK_PRODUCT_ABSTRACT);
            $criteria->removeSelectColumn(SpyProductReviewTableMap::COL_CUSTOMER_REFERENCE);
            $criteria->removeSelectColumn(SpyProductReviewTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(SpyProductReviewTableMap::COL_NICKNAME);
            $criteria->removeSelectColumn(SpyProductReviewTableMap::COL_RATING);
            $criteria->removeSelectColumn(SpyProductReviewTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SpyProductReviewTableMap::COL_SUMMARY);
            $criteria->removeSelectColumn(SpyProductReviewTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyProductReviewTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_product_review');
            $criteria->removeSelectColumn($alias . '.fk_locale');
            $criteria->removeSelectColumn($alias . '.fk_product_abstract');
            $criteria->removeSelectColumn($alias . '.customer_reference');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.nickname');
            $criteria->removeSelectColumn($alias . '.rating');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.summary');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyProductReviewTableMap::DATABASE_NAME)->getTable(SpyProductReviewTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyProductReview or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyProductReview object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductReviewTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\ProductReview\Persistence\SpyProductReview) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyProductReviewTableMap::DATABASE_NAME);
            $criteria->add(SpyProductReviewTableMap::COL_ID_PRODUCT_REVIEW, (array) $values, Criteria::IN);
        }

        $query = SpyProductReviewQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyProductReviewTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyProductReviewTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_product_review table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyProductReviewQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyProductReview or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyProductReview object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyProductReviewTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyProductReview object
        }


        // Set the correct dbName
        $query = SpyProductReviewQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
