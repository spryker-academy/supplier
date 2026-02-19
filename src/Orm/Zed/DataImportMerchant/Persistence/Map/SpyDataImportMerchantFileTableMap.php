<?php

namespace Orm\Zed\DataImportMerchant\Persistence\Map;

use Orm\Zed\DataImportMerchant\Persistence\SpyDataImportMerchantFile;
use Orm\Zed\DataImportMerchant\Persistence\SpyDataImportMerchantFileQuery;
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
 * This class defines the structure of the 'spy_data_import_merchant_file' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyDataImportMerchantFileTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.DataImportMerchant.Persistence.Map.SpyDataImportMerchantFileTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_data_import_merchant_file';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyDataImportMerchantFile';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\DataImportMerchant\\Persistence\\SpyDataImportMerchantFile';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.DataImportMerchant.Persistence.SpyDataImportMerchantFile';

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
     * the column name for the id_data_import_merchant_file field
     */
    public const COL_ID_DATA_IMPORT_MERCHANT_FILE = 'spy_data_import_merchant_file.id_data_import_merchant_file';

    /**
     * the column name for the uuid field
     */
    public const COL_UUID = 'spy_data_import_merchant_file.uuid';

    /**
     * the column name for the fk_user field
     */
    public const COL_FK_USER = 'spy_data_import_merchant_file.fk_user';

    /**
     * the column name for the merchant_reference field
     */
    public const COL_MERCHANT_REFERENCE = 'spy_data_import_merchant_file.merchant_reference';

    /**
     * the column name for the importer_type field
     */
    public const COL_IMPORTER_TYPE = 'spy_data_import_merchant_file.importer_type';

    /**
     * the column name for the status field
     */
    public const COL_STATUS = 'spy_data_import_merchant_file.status';

    /**
     * the column name for the original_file_name field
     */
    public const COL_ORIGINAL_FILE_NAME = 'spy_data_import_merchant_file.original_file_name';

    /**
     * the column name for the file_info field
     */
    public const COL_FILE_INFO = 'spy_data_import_merchant_file.file_info';

    /**
     * the column name for the import_result field
     */
    public const COL_IMPORT_RESULT = 'spy_data_import_merchant_file.import_result';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_data_import_merchant_file.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_data_import_merchant_file.updated_at';

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
        self::TYPE_PHPNAME       => ['IdDataImportMerchantFile', 'Uuid', 'FkUser', 'MerchantReference', 'ImporterType', 'Status', 'OriginalFileName', 'FileInfo', 'ImportResult', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idDataImportMerchantFile', 'uuid', 'fkUser', 'merchantReference', 'importerType', 'status', 'originalFileName', 'fileInfo', 'importResult', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpyDataImportMerchantFileTableMap::COL_ID_DATA_IMPORT_MERCHANT_FILE, SpyDataImportMerchantFileTableMap::COL_UUID, SpyDataImportMerchantFileTableMap::COL_FK_USER, SpyDataImportMerchantFileTableMap::COL_MERCHANT_REFERENCE, SpyDataImportMerchantFileTableMap::COL_IMPORTER_TYPE, SpyDataImportMerchantFileTableMap::COL_STATUS, SpyDataImportMerchantFileTableMap::COL_ORIGINAL_FILE_NAME, SpyDataImportMerchantFileTableMap::COL_FILE_INFO, SpyDataImportMerchantFileTableMap::COL_IMPORT_RESULT, SpyDataImportMerchantFileTableMap::COL_CREATED_AT, SpyDataImportMerchantFileTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_data_import_merchant_file', 'uuid', 'fk_user', 'merchant_reference', 'importer_type', 'status', 'original_file_name', 'file_info', 'import_result', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdDataImportMerchantFile' => 0, 'Uuid' => 1, 'FkUser' => 2, 'MerchantReference' => 3, 'ImporterType' => 4, 'Status' => 5, 'OriginalFileName' => 6, 'FileInfo' => 7, 'ImportResult' => 8, 'CreatedAt' => 9, 'UpdatedAt' => 10, ],
        self::TYPE_CAMELNAME     => ['idDataImportMerchantFile' => 0, 'uuid' => 1, 'fkUser' => 2, 'merchantReference' => 3, 'importerType' => 4, 'status' => 5, 'originalFileName' => 6, 'fileInfo' => 7, 'importResult' => 8, 'createdAt' => 9, 'updatedAt' => 10, ],
        self::TYPE_COLNAME       => [SpyDataImportMerchantFileTableMap::COL_ID_DATA_IMPORT_MERCHANT_FILE => 0, SpyDataImportMerchantFileTableMap::COL_UUID => 1, SpyDataImportMerchantFileTableMap::COL_FK_USER => 2, SpyDataImportMerchantFileTableMap::COL_MERCHANT_REFERENCE => 3, SpyDataImportMerchantFileTableMap::COL_IMPORTER_TYPE => 4, SpyDataImportMerchantFileTableMap::COL_STATUS => 5, SpyDataImportMerchantFileTableMap::COL_ORIGINAL_FILE_NAME => 6, SpyDataImportMerchantFileTableMap::COL_FILE_INFO => 7, SpyDataImportMerchantFileTableMap::COL_IMPORT_RESULT => 8, SpyDataImportMerchantFileTableMap::COL_CREATED_AT => 9, SpyDataImportMerchantFileTableMap::COL_UPDATED_AT => 10, ],
        self::TYPE_FIELDNAME     => ['id_data_import_merchant_file' => 0, 'uuid' => 1, 'fk_user' => 2, 'merchant_reference' => 3, 'importer_type' => 4, 'status' => 5, 'original_file_name' => 6, 'file_info' => 7, 'import_result' => 8, 'created_at' => 9, 'updated_at' => 10, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdDataImportMerchantFile' => 'ID_DATA_IMPORT_MERCHANT_FILE',
        'SpyDataImportMerchantFile.IdDataImportMerchantFile' => 'ID_DATA_IMPORT_MERCHANT_FILE',
        'idDataImportMerchantFile' => 'ID_DATA_IMPORT_MERCHANT_FILE',
        'spyDataImportMerchantFile.idDataImportMerchantFile' => 'ID_DATA_IMPORT_MERCHANT_FILE',
        'SpyDataImportMerchantFileTableMap::COL_ID_DATA_IMPORT_MERCHANT_FILE' => 'ID_DATA_IMPORT_MERCHANT_FILE',
        'COL_ID_DATA_IMPORT_MERCHANT_FILE' => 'ID_DATA_IMPORT_MERCHANT_FILE',
        'id_data_import_merchant_file' => 'ID_DATA_IMPORT_MERCHANT_FILE',
        'spy_data_import_merchant_file.id_data_import_merchant_file' => 'ID_DATA_IMPORT_MERCHANT_FILE',
        'Uuid' => 'UUID',
        'SpyDataImportMerchantFile.Uuid' => 'UUID',
        'uuid' => 'UUID',
        'spyDataImportMerchantFile.uuid' => 'UUID',
        'SpyDataImportMerchantFileTableMap::COL_UUID' => 'UUID',
        'COL_UUID' => 'UUID',
        'spy_data_import_merchant_file.uuid' => 'UUID',
        'FkUser' => 'FK_USER',
        'SpyDataImportMerchantFile.FkUser' => 'FK_USER',
        'fkUser' => 'FK_USER',
        'spyDataImportMerchantFile.fkUser' => 'FK_USER',
        'SpyDataImportMerchantFileTableMap::COL_FK_USER' => 'FK_USER',
        'COL_FK_USER' => 'FK_USER',
        'fk_user' => 'FK_USER',
        'spy_data_import_merchant_file.fk_user' => 'FK_USER',
        'MerchantReference' => 'MERCHANT_REFERENCE',
        'SpyDataImportMerchantFile.MerchantReference' => 'MERCHANT_REFERENCE',
        'merchantReference' => 'MERCHANT_REFERENCE',
        'spyDataImportMerchantFile.merchantReference' => 'MERCHANT_REFERENCE',
        'SpyDataImportMerchantFileTableMap::COL_MERCHANT_REFERENCE' => 'MERCHANT_REFERENCE',
        'COL_MERCHANT_REFERENCE' => 'MERCHANT_REFERENCE',
        'merchant_reference' => 'MERCHANT_REFERENCE',
        'spy_data_import_merchant_file.merchant_reference' => 'MERCHANT_REFERENCE',
        'ImporterType' => 'IMPORTER_TYPE',
        'SpyDataImportMerchantFile.ImporterType' => 'IMPORTER_TYPE',
        'importerType' => 'IMPORTER_TYPE',
        'spyDataImportMerchantFile.importerType' => 'IMPORTER_TYPE',
        'SpyDataImportMerchantFileTableMap::COL_IMPORTER_TYPE' => 'IMPORTER_TYPE',
        'COL_IMPORTER_TYPE' => 'IMPORTER_TYPE',
        'importer_type' => 'IMPORTER_TYPE',
        'spy_data_import_merchant_file.importer_type' => 'IMPORTER_TYPE',
        'Status' => 'STATUS',
        'SpyDataImportMerchantFile.Status' => 'STATUS',
        'status' => 'STATUS',
        'spyDataImportMerchantFile.status' => 'STATUS',
        'SpyDataImportMerchantFileTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'spy_data_import_merchant_file.status' => 'STATUS',
        'OriginalFileName' => 'ORIGINAL_FILE_NAME',
        'SpyDataImportMerchantFile.OriginalFileName' => 'ORIGINAL_FILE_NAME',
        'originalFileName' => 'ORIGINAL_FILE_NAME',
        'spyDataImportMerchantFile.originalFileName' => 'ORIGINAL_FILE_NAME',
        'SpyDataImportMerchantFileTableMap::COL_ORIGINAL_FILE_NAME' => 'ORIGINAL_FILE_NAME',
        'COL_ORIGINAL_FILE_NAME' => 'ORIGINAL_FILE_NAME',
        'original_file_name' => 'ORIGINAL_FILE_NAME',
        'spy_data_import_merchant_file.original_file_name' => 'ORIGINAL_FILE_NAME',
        'FileInfo' => 'FILE_INFO',
        'SpyDataImportMerchantFile.FileInfo' => 'FILE_INFO',
        'fileInfo' => 'FILE_INFO',
        'spyDataImportMerchantFile.fileInfo' => 'FILE_INFO',
        'SpyDataImportMerchantFileTableMap::COL_FILE_INFO' => 'FILE_INFO',
        'COL_FILE_INFO' => 'FILE_INFO',
        'file_info' => 'FILE_INFO',
        'spy_data_import_merchant_file.file_info' => 'FILE_INFO',
        'ImportResult' => 'IMPORT_RESULT',
        'SpyDataImportMerchantFile.ImportResult' => 'IMPORT_RESULT',
        'importResult' => 'IMPORT_RESULT',
        'spyDataImportMerchantFile.importResult' => 'IMPORT_RESULT',
        'SpyDataImportMerchantFileTableMap::COL_IMPORT_RESULT' => 'IMPORT_RESULT',
        'COL_IMPORT_RESULT' => 'IMPORT_RESULT',
        'import_result' => 'IMPORT_RESULT',
        'spy_data_import_merchant_file.import_result' => 'IMPORT_RESULT',
        'CreatedAt' => 'CREATED_AT',
        'SpyDataImportMerchantFile.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spyDataImportMerchantFile.createdAt' => 'CREATED_AT',
        'SpyDataImportMerchantFileTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_data_import_merchant_file.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpyDataImportMerchantFile.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spyDataImportMerchantFile.updatedAt' => 'UPDATED_AT',
        'SpyDataImportMerchantFileTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_data_import_merchant_file.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_data_import_merchant_file');
        $this->setPhpName('SpyDataImportMerchantFile');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\DataImportMerchant\\Persistence\\SpyDataImportMerchantFile');
        $this->setPackage('src.Orm.Zed.DataImportMerchant.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('id_data_import_merchant_file_pk_seq');
        // columns
        $this->addPrimaryKey('id_data_import_merchant_file', 'IdDataImportMerchantFile', 'INTEGER', true, null, null);
        $this->addColumn('uuid', 'Uuid', 'VARCHAR', false, 36, null);
        $this->addForeignKey('fk_user', 'FkUser', 'INTEGER', 'spy_user', 'id_user', true, null, null);
        $this->addColumn('merchant_reference', 'MerchantReference', 'VARCHAR', true, 255, null);
        $this->addColumn('importer_type', 'ImporterType', 'VARCHAR', true, 255, null);
        $this->addColumn('status', 'Status', 'VARCHAR', true, 255, null);
        $this->addColumn('original_file_name', 'OriginalFileName', 'VARCHAR', true, 255, null);
        $this->addColumn('file_info', 'FileInfo', 'LONGVARCHAR', true, null, null);
        $this->addColumn('import_result', 'ImportResult', 'CLOB', false, null, null);
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
        $this->addRelation('SpyUser', '\\Orm\\Zed\\User\\Persistence\\SpyUser', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_user',
    1 => ':id_user',
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
            'uuid' => ['key_prefix' => NULL, 'key_columns' => 'id_data_import_merchant_file'],
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDataImportMerchantFile', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDataImportMerchantFile', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDataImportMerchantFile', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDataImportMerchantFile', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDataImportMerchantFile', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdDataImportMerchantFile', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdDataImportMerchantFile', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpyDataImportMerchantFileTableMap::CLASS_DEFAULT : SpyDataImportMerchantFileTableMap::OM_CLASS;
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
     * @return array (SpyDataImportMerchantFile object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyDataImportMerchantFileTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyDataImportMerchantFileTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyDataImportMerchantFileTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyDataImportMerchantFileTableMap::OM_CLASS;
            /** @var SpyDataImportMerchantFile $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyDataImportMerchantFileTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyDataImportMerchantFileTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyDataImportMerchantFileTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyDataImportMerchantFile $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyDataImportMerchantFileTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyDataImportMerchantFileTableMap::COL_ID_DATA_IMPORT_MERCHANT_FILE);
            $criteria->addSelectColumn(SpyDataImportMerchantFileTableMap::COL_UUID);
            $criteria->addSelectColumn(SpyDataImportMerchantFileTableMap::COL_FK_USER);
            $criteria->addSelectColumn(SpyDataImportMerchantFileTableMap::COL_MERCHANT_REFERENCE);
            $criteria->addSelectColumn(SpyDataImportMerchantFileTableMap::COL_IMPORTER_TYPE);
            $criteria->addSelectColumn(SpyDataImportMerchantFileTableMap::COL_STATUS);
            $criteria->addSelectColumn(SpyDataImportMerchantFileTableMap::COL_ORIGINAL_FILE_NAME);
            $criteria->addSelectColumn(SpyDataImportMerchantFileTableMap::COL_FILE_INFO);
            $criteria->addSelectColumn(SpyDataImportMerchantFileTableMap::COL_IMPORT_RESULT);
            $criteria->addSelectColumn(SpyDataImportMerchantFileTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpyDataImportMerchantFileTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_data_import_merchant_file');
            $criteria->addSelectColumn($alias . '.uuid');
            $criteria->addSelectColumn($alias . '.fk_user');
            $criteria->addSelectColumn($alias . '.merchant_reference');
            $criteria->addSelectColumn($alias . '.importer_type');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.original_file_name');
            $criteria->addSelectColumn($alias . '.file_info');
            $criteria->addSelectColumn($alias . '.import_result');
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
            $criteria->removeSelectColumn(SpyDataImportMerchantFileTableMap::COL_ID_DATA_IMPORT_MERCHANT_FILE);
            $criteria->removeSelectColumn(SpyDataImportMerchantFileTableMap::COL_UUID);
            $criteria->removeSelectColumn(SpyDataImportMerchantFileTableMap::COL_FK_USER);
            $criteria->removeSelectColumn(SpyDataImportMerchantFileTableMap::COL_MERCHANT_REFERENCE);
            $criteria->removeSelectColumn(SpyDataImportMerchantFileTableMap::COL_IMPORTER_TYPE);
            $criteria->removeSelectColumn(SpyDataImportMerchantFileTableMap::COL_STATUS);
            $criteria->removeSelectColumn(SpyDataImportMerchantFileTableMap::COL_ORIGINAL_FILE_NAME);
            $criteria->removeSelectColumn(SpyDataImportMerchantFileTableMap::COL_FILE_INFO);
            $criteria->removeSelectColumn(SpyDataImportMerchantFileTableMap::COL_IMPORT_RESULT);
            $criteria->removeSelectColumn(SpyDataImportMerchantFileTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpyDataImportMerchantFileTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_data_import_merchant_file');
            $criteria->removeSelectColumn($alias . '.uuid');
            $criteria->removeSelectColumn($alias . '.fk_user');
            $criteria->removeSelectColumn($alias . '.merchant_reference');
            $criteria->removeSelectColumn($alias . '.importer_type');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.original_file_name');
            $criteria->removeSelectColumn($alias . '.file_info');
            $criteria->removeSelectColumn($alias . '.import_result');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyDataImportMerchantFileTableMap::DATABASE_NAME)->getTable(SpyDataImportMerchantFileTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyDataImportMerchantFile or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyDataImportMerchantFile object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDataImportMerchantFileTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\DataImportMerchant\Persistence\SpyDataImportMerchantFile) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyDataImportMerchantFileTableMap::DATABASE_NAME);
            $criteria->add(SpyDataImportMerchantFileTableMap::COL_ID_DATA_IMPORT_MERCHANT_FILE, (array) $values, Criteria::IN);
        }

        $query = SpyDataImportMerchantFileQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyDataImportMerchantFileTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyDataImportMerchantFileTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_data_import_merchant_file table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyDataImportMerchantFileQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyDataImportMerchantFile or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyDataImportMerchantFile object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyDataImportMerchantFileTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyDataImportMerchantFile object
        }

        if ($criteria->containsKey(SpyDataImportMerchantFileTableMap::COL_ID_DATA_IMPORT_MERCHANT_FILE) && $criteria->keyContainsValue(SpyDataImportMerchantFileTableMap::COL_ID_DATA_IMPORT_MERCHANT_FILE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpyDataImportMerchantFileTableMap::COL_ID_DATA_IMPORT_MERCHANT_FILE.')');
        }


        // Set the correct dbName
        $query = SpyDataImportMerchantFileQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
