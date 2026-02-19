<?php

namespace Orm\Zed\Comment\Persistence\Map;

use Orm\Zed\Comment\Persistence\SpyComment;
use Orm\Zed\Comment\Persistence\SpyCommentQuery;
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
 * This class defines the structure of the 'spy_comment' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCommentTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.Comment.Persistence.Map.SpyCommentTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_comment';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyComment';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\Comment\\Persistence\\SpyComment';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.Comment.Persistence.SpyComment';

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
     * the column name for the id_comment field
     */
    public const COL_ID_COMMENT = 'spy_comment.id_comment';

    /**
     * the column name for the fk_comment_thread field
     */
    public const COL_FK_COMMENT_THREAD = 'spy_comment.fk_comment_thread';

    /**
     * the column name for the fk_customer field
     */
    public const COL_FK_CUSTOMER = 'spy_comment.fk_customer';

    /**
     * the column name for the fk_user field
     */
    public const COL_FK_USER = 'spy_comment.fk_user';

    /**
     * the column name for the is_deleted field
     */
    public const COL_IS_DELETED = 'spy_comment.is_deleted';

    /**
     * the column name for the is_updated field
     */
    public const COL_IS_UPDATED = 'spy_comment.is_updated';

    /**
     * the column name for the key field
     */
    public const COL_KEY = 'spy_comment.key';

    /**
     * the column name for the message field
     */
    public const COL_MESSAGE = 'spy_comment.message';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_comment.uuid';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_comment.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_comment.updated_at';

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
        self::TYPE_PHPNAME       => ['IdComment', 'FkCommentThread', 'FkCustomer', 'FkUser', 'IsDeleted', 'IsUpdated', 'Key', 'Message', 'Uuid', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idComment', 'fkCommentThread', 'fkCustomer', 'fkUser', 'isDeleted', 'isUpdated', 'key', 'message', 'uuid', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyCommentTableMap::COL_ID_COMMENT, SpyCommentTableMap::COL_FK_COMMENT_THREAD, SpyCommentTableMap::COL_FK_CUSTOMER, SpyCommentTableMap::COL_FK_USER, SpyCommentTableMap::COL_IS_DELETED, SpyCommentTableMap::COL_IS_UPDATED, SpyCommentTableMap::COL_KEY, SpyCommentTableMap::COL_MESSAGE, SpyCommentTableMap::COL_UUID, SpyCommentTableMap::COL_CREATED_AT, SpyCommentTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_comment', 'fk_comment_thread', 'fk_customer', 'fk_user', 'is_deleted', 'is_updated', 'key', 'message', 'uuid', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdComment' => 0, 'FkCommentThread' => 1, 'FkCustomer' => 2, 'FkUser' => 3, 'IsDeleted' => 4, 'IsUpdated' => 5, 'Key' => 6, 'Message' => 7, 'Uuid' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ],
        self::TYPE_CAMELNAME     => ['idComment' => 0, 'fkCommentThread' => 1, 'fkCustomer' => 2, 'fkUser' => 3, 'isDeleted' => 4, 'isUpdated' => 5, 'key' => 6, 'message' => 7, 'uuid' => 8, 'createdAt' => 9, 'updatedAt' => 10, ],
        self::TYPE_COLNAME       => [SpyCommentTableMap::COL_ID_COMMENT => 0, SpyCommentTableMap::COL_FK_COMMENT_THREAD => 1, SpyCommentTableMap::COL_FK_CUSTOMER => 2, SpyCommentTableMap::COL_FK_USER => 3, SpyCommentTableMap::COL_IS_DELETED => 4, SpyCommentTableMap::COL_IS_UPDATED => 5, SpyCommentTableMap::COL_KEY => 6, SpyCommentTableMap::COL_MESSAGE => 7, SpyCommentTableMap::COL_UUID => 8, SpyCommentTableMap::COL_CREATED_AT => 9, SpyCommentTableMap::COL_UPDATED_AT => 10, ],
        self::TYPE_FIELDNAME     => ['id_comment' => 0, 'fk_comment_thread' => 1, 'fk_customer' => 2, 'fk_user' => 3, 'is_deleted' => 4, 'is_updated' => 5, 'key' => 6, 'message' => 7, 'uuid' => 8, 'created_at' => 9, 'updated_at' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdComment' => 'ID_COMMENT',
        'SpyComment.IdComment' => 'ID_COMMENT',
        'idComment' => 'ID_COMMENT',
        'spyComment.idComment' => 'ID_COMMENT',
        'SpyCommentTableMap::COL_ID_COMMENT' => 'ID_COMMENT',
        'COL_ID_COMMENT' => 'ID_COMMENT',
        'id_comment' => 'ID_COMMENT',
        'spy_comment.id_comment' => 'ID_COMMENT',
        'FkCommentThread' => 'FK_COMMENT_THREAD',
        'SpyComment.FkCommentThread' => 'FK_COMMENT_THREAD',
        'fkCommentThread' => 'FK_COMMENT_THREAD',
        'spyComment.fkCommentThread' => 'FK_COMMENT_THREAD',
        'SpyCommentTableMap::COL_FK_COMMENT_THREAD' => 'FK_COMMENT_THREAD',
        'COL_FK_COMMENT_THREAD' => 'FK_COMMENT_THREAD',
        'fk_comment_thread' => 'FK_COMMENT_THREAD',
        'spy_comment.fk_comment_thread' => 'FK_COMMENT_THREAD',
        'FkCustomer' => 'FK_CUSTOMER',
        'SpyComment.FkCustomer' => 'FK_CUSTOMER',
        'fkCustomer' => 'FK_CUSTOMER',
        'spyComment.fkCustomer' => 'FK_CUSTOMER',
        'SpyCommentTableMap::COL_FK_CUSTOMER' => 'FK_CUSTOMER',
        'COL_FK_CUSTOMER' => 'FK_CUSTOMER',
        'fk_customer' => 'FK_CUSTOMER',
        'spy_comment.fk_customer' => 'FK_CUSTOMER',
        'FkUser' => 'FK_USER',
        'SpyComment.FkUser' => 'FK_USER',
        'fkUser' => 'FK_USER',
        'spyComment.fkUser' => 'FK_USER',
        'SpyCommentTableMap::COL_FK_USER' => 'FK_USER',
        'COL_FK_USER' => 'FK_USER',
        'fk_user' => 'FK_USER',
        'spy_comment.fk_user' => 'FK_USER',
        'IsDeleted' => 'IS_DELETED',
        'SpyComment.IsDeleted' => 'IS_DELETED',
        'isDeleted' => 'IS_DELETED',
        'spyComment.isDeleted' => 'IS_DELETED',
        'SpyCommentTableMap::COL_IS_DELETED' => 'IS_DELETED',
        'COL_IS_DELETED' => 'IS_DELETED',
        'is_deleted' => 'IS_DELETED',
        'spy_comment.is_deleted' => 'IS_DELETED',
        'IsUpdated' => 'IS_UPDATED',
        'SpyComment.IsUpdated' => 'IS_UPDATED',
        'isUpdated' => 'IS_UPDATED',
        'spyComment.isUpdated' => 'IS_UPDATED',
        'SpyCommentTableMap::COL_IS_UPDATED' => 'IS_UPDATED',
        'COL_IS_UPDATED' => 'IS_UPDATED',
        'is_updated' => 'IS_UPDATED',
        'spy_comment.is_updated' => 'IS_UPDATED',
        'Key' => 'KEY',
        'SpyComment.Key' => 'KEY',
        'key' => 'KEY',
        'spyComment.key' => 'KEY',
        'SpyCommentTableMap::COL_KEY' => 'KEY',
        'COL_KEY' => 'KEY',
        'spy_comment.key' => 'KEY',
        'Message' => 'MESSAGE',
        'SpyComment.Message' => 'MESSAGE',
        'message' => 'MESSAGE',
        'spyComment.message' => 'MESSAGE',
        'SpyCommentTableMap::COL_MESSAGE' => 'MESSAGE',
        'COL_MESSAGE' => 'MESSAGE',
        'spy_comment.message' => 'MESSAGE',
        'Uuid' => 'UUID',
        'SpyComment.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyComment.uuid' => 'UUID',
        'SpyCommentTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_comment.uuid' => 'UUID',
        'CreatedAt' => 'CREATED_AT',
        'SpyComment.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyComment.createdAt' => 'CREATED_AT',
        'SpyCommentTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_comment.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyComment.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyComment.updatedAt' => 'UPDATED_AT',
        'SpyCommentTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_comment.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_comment');
        $this->setPhpName('SpyComment');
        $this->setIdentifierQuoting(true);
        $this->setClassName('\\Orm\\Zed\\Comment\\Persistence\\SpyComment');
        $this->setPackage('src.Orm.Zed.Comment.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_comment_pk_seq');
        // columns
        $this->addPrimaryKey('id_comment', 'IdComment', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_comment_thread', 'FkCommentThread', 'INTEGER', 'spy_comment_thread', 'id_comment_thread', true, null, null);
        $this->addForeignKey('fk_customer', 'FkCustomer', 'INTEGER', 'spy_customer', 'id_customer', false, null, null);
        $this->addForeignKey('fk_user', 'FkUser', 'INTEGER', 'spy_user', 'id_user', false, null, null);
        $this->addColumn('is_deleted', 'IsDeleted', 'BOOLEAN', false, 1, false);
        $this->addColumn('is_updated', 'IsUpdated', 'BOOLEAN', false, 1, false);
        $this->addColumn('key', 'Key', 'VARCHAR', false, 255, null);
        $this->addColumn('message', 'Message', 'VARCHAR', true, 5000, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 36, null);
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
        $this->addRelation('User', '\\Orm\\Zed\\User\\Persistence\\SpyUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_user',
    1 => ':id_user',
  ),
), null, null, null, false);
        $this->addRelation('SpyCustomer', '\\Orm\\Zed\\Customer\\Persistence\\SpyCustomer', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_customer',
    1 => ':id_customer',
  ),
), null, null, null, false);
        $this->addRelation('SpyCommentThread', '\\Orm\\Zed\\Comment\\Persistence\\SpyCommentThread', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_comment_thread',
    1 => ':id_comment_thread',
  ),
), null, null, null, false);
        $this->addRelation('SpyCommentToCommentTag', '\\Orm\\Zed\\Comment\\Persistence\\SpyCommentToCommentTag', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_comment',
    1 => ':id_comment',
  ),
), null, null, 'SpyCommentToCommentTags', false);
        $this->addRelation('SpyCommentTag', '\\Orm\\Zed\\Comment\\Persistence\\SpyCommentTag', RelationMap::MANY_TO_MANY, array(), null, null, 'SpyCommentTags');
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_comment'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdComment', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdComment', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdComment', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdComment', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdComment', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdComment', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdComment', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyCommentTableMap::CLASS_DEFAULT : SpyCommentTableMap::OM_CLASS;
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
     * @return array (SpyComment object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCommentTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCommentTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCommentTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCommentTableMap::OM_CLASS;
            /** @var SpyComment $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCommentTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCommentTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCommentTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyComment $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCommentTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCommentTableMap::COL_ID_COMMENT);
            $criteria->addSelectColumn(SpyCommentTableMap::COL_FK_COMMENT_THREAD);
            $criteria->addSelectColumn(SpyCommentTableMap::COL_FK_CUSTOMER);
            $criteria->addSelectColumn(SpyCommentTableMap::COL_FK_USER);
            $criteria->addSelectColumn(SpyCommentTableMap::COL_IS_DELETED);
            $criteria->addSelectColumn(SpyCommentTableMap::COL_IS_UPDATED);
            $criteria->addSelectColumn(SpyCommentTableMap::COL_KEY);
            $criteria->addSelectColumn(SpyCommentTableMap::COL_MESSAGE);
            $criteria->addSelectColumn(SpyCommentTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyCommentTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyCommentTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_comment');
            $criteria->addSelectColumn($alias . '.fk_comment_thread');
            $criteria->addSelectColumn($alias . '.fk_customer');
            $criteria->addSelectColumn($alias . '.fk_user');
            $criteria->addSelectColumn($alias . '.is_deleted');
            $criteria->addSelectColumn($alias . '.is_updated');
            $criteria->addSelectColumn($alias . '.key');
            $criteria->addSelectColumn($alias . '.message');
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
            $criteria->removeSelectColumn(SpyCommentTableMap::COL_ID_COMMENT);
            $criteria->removeSelectColumn(SpyCommentTableMap::COL_FK_COMMENT_THREAD);
            $criteria->removeSelectColumn(SpyCommentTableMap::COL_FK_CUSTOMER);
            $criteria->removeSelectColumn(SpyCommentTableMap::COL_FK_USER);
            $criteria->removeSelectColumn(SpyCommentTableMap::COL_IS_DELETED);
            $criteria->removeSelectColumn(SpyCommentTableMap::COL_IS_UPDATED);
            $criteria->removeSelectColumn(SpyCommentTableMap::COL_KEY);
            $criteria->removeSelectColumn(SpyCommentTableMap::COL_MESSAGE);
            $criteria->removeSelectColumn(SpyCommentTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyCommentTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyCommentTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_comment');
            $criteria->removeSelectColumn($alias . '.fk_comment_thread');
            $criteria->removeSelectColumn($alias . '.fk_customer');
            $criteria->removeSelectColumn($alias . '.fk_user');
            $criteria->removeSelectColumn($alias . '.is_deleted');
            $criteria->removeSelectColumn($alias . '.is_updated');
            $criteria->removeSelectColumn($alias . '.key');
            $criteria->removeSelectColumn($alias . '.message');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCommentTableMap::DATABASE_NAME)->getTable(SpyCommentTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyComment or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyComment object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCommentTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\Comment\Persistence\SpyComment) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCommentTableMap::DATABASE_NAME);
            $criteria->add(SpyCommentTableMap::COL_ID_COMMENT, (array) $values, Criteria::IN);
        }

        $query = SpyCommentQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCommentTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCommentTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_comment table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCommentQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyComment or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyComment object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCommentTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyComment object
        }


        // Set the correct dbName
        $query = SpyCommentQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
