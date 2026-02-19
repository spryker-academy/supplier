<?php

namespace Orm\Zed\SelfServicePortal\Persistence\Map;

use Orm\Zed\SelfServicePortal\Persistence\SpySspModel;
use Orm\Zed\SelfServicePortal\Persistence\SpySspModelQuery;
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
 * This class defines the structure of the 'spy_ssp_model' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpySspModelTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.SelfServicePortal.Persistence.Map.SpySspModelTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_ssp_model';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpySspModel';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspModel';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.SelfServicePortal.Persistence.SpySspModel';

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
     * the column name for the id_ssp_model field
     */
    public const COL_ID_SSP_MODEL = 'spy_ssp_model.id_ssp_model';

    /**
     * the column name for the fk_image_file field
     */
    public const COL_FK_IMAGE_FILE = 'spy_ssp_model.fk_image_file';

    /**
     * the column name for the code field
     */
    public const COL_CODE = 'spy_ssp_model.code';

    /**
     * the column name for the image_url field
     */
    public const COL_IMAGE_URL = 'spy_ssp_model.image_url';

    /**
     * the column name for the name field
     */
    public const COL_NAME = 'spy_ssp_model.name';

    /**
     * the column name for the reference field
     */
    public const COL_REFERENCE = 'spy_ssp_model.reference';

    /**
     * the column name for the created_at field
     */
    public const COL_CREATED_AT = 'spy_ssp_model.created_at';

    /**
     * the column name for the updated_at field
     */
    public const COL_UPDATED_AT = 'spy_ssp_model.updated_at';

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
        self::TYPE_PHPNAME       => ['IdSspModel', 'FkImageFile', 'Code', 'ImageUrl', 'Name', 'Reference', 'CreatedAt', 'UpdatedAt', ],
        self::TYPE_CAMELNAME     => ['idSspModel', 'fkImageFile', 'code', 'imageUrl', 'name', 'reference', 'createdAt', 'updatedAt', ],
        self::TYPE_COLNAME       => [SpySspModelTableMap::COL_ID_SSP_MODEL, SpySspModelTableMap::COL_FK_IMAGE_FILE, SpySspModelTableMap::COL_CODE, SpySspModelTableMap::COL_IMAGE_URL, SpySspModelTableMap::COL_NAME, SpySspModelTableMap::COL_REFERENCE, SpySspModelTableMap::COL_CREATED_AT, SpySspModelTableMap::COL_UPDATED_AT, ],
        self::TYPE_FIELDNAME     => ['id_ssp_model', 'fk_image_file', 'code', 'image_url', 'name', 'reference', 'created_at', 'updated_at', ],
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
        self::TYPE_PHPNAME       => ['IdSspModel' => 0, 'FkImageFile' => 1, 'Code' => 2, 'ImageUrl' => 3, 'Name' => 4, 'Reference' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ],
        self::TYPE_CAMELNAME     => ['idSspModel' => 0, 'fkImageFile' => 1, 'code' => 2, 'imageUrl' => 3, 'name' => 4, 'reference' => 5, 'createdAt' => 6, 'updatedAt' => 7, ],
        self::TYPE_COLNAME       => [SpySspModelTableMap::COL_ID_SSP_MODEL => 0, SpySspModelTableMap::COL_FK_IMAGE_FILE => 1, SpySspModelTableMap::COL_CODE => 2, SpySspModelTableMap::COL_IMAGE_URL => 3, SpySspModelTableMap::COL_NAME => 4, SpySspModelTableMap::COL_REFERENCE => 5, SpySspModelTableMap::COL_CREATED_AT => 6, SpySspModelTableMap::COL_UPDATED_AT => 7, ],
        self::TYPE_FIELDNAME     => ['id_ssp_model' => 0, 'fk_image_file' => 1, 'code' => 2, 'image_url' => 3, 'name' => 4, 'reference' => 5, 'created_at' => 6, 'updated_at' => 7, ],
        self::TYPE_NUM           => [0, 1, 2, 3, 4, 5, 6, 7, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdSspModel' => 'ID_SSP_MODEL',
        'SpySspModel.IdSspModel' => 'ID_SSP_MODEL',
        'idSspModel' => 'ID_SSP_MODEL',
        'spySspModel.idSspModel' => 'ID_SSP_MODEL',
        'SpySspModelTableMap::COL_ID_SSP_MODEL' => 'ID_SSP_MODEL',
        'COL_ID_SSP_MODEL' => 'ID_SSP_MODEL',
        'id_ssp_model' => 'ID_SSP_MODEL',
        'spy_ssp_model.id_ssp_model' => 'ID_SSP_MODEL',
        'FkImageFile' => 'FK_IMAGE_FILE',
        'SpySspModel.FkImageFile' => 'FK_IMAGE_FILE',
        'fkImageFile' => 'FK_IMAGE_FILE',
        'spySspModel.fkImageFile' => 'FK_IMAGE_FILE',
        'SpySspModelTableMap::COL_FK_IMAGE_FILE' => 'FK_IMAGE_FILE',
        'COL_FK_IMAGE_FILE' => 'FK_IMAGE_FILE',
        'fk_image_file' => 'FK_IMAGE_FILE',
        'spy_ssp_model.fk_image_file' => 'FK_IMAGE_FILE',
        'Code' => 'CODE',
        'SpySspModel.Code' => 'CODE',
        'code' => 'CODE',
        'spySspModel.code' => 'CODE',
        'SpySspModelTableMap::COL_CODE' => 'CODE',
        'COL_CODE' => 'CODE',
        'spy_ssp_model.code' => 'CODE',
        'ImageUrl' => 'IMAGE_URL',
        'SpySspModel.ImageUrl' => 'IMAGE_URL',
        'imageUrl' => 'IMAGE_URL',
        'spySspModel.imageUrl' => 'IMAGE_URL',
        'SpySspModelTableMap::COL_IMAGE_URL' => 'IMAGE_URL',
        'COL_IMAGE_URL' => 'IMAGE_URL',
        'image_url' => 'IMAGE_URL',
        'spy_ssp_model.image_url' => 'IMAGE_URL',
        'Name' => 'NAME',
        'SpySspModel.Name' => 'NAME',
        'name' => 'NAME',
        'spySspModel.name' => 'NAME',
        'SpySspModelTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'spy_ssp_model.name' => 'NAME',
        'Reference' => 'REFERENCE',
        'SpySspModel.Reference' => 'REFERENCE',
        'reference' => 'REFERENCE',
        'spySspModel.reference' => 'REFERENCE',
        'SpySspModelTableMap::COL_REFERENCE' => 'REFERENCE',
        'COL_REFERENCE' => 'REFERENCE',
        'spy_ssp_model.reference' => 'REFERENCE',
        'CreatedAt' => 'CREATED_AT',
        'SpySspModel.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'spySspModel.createdAt' => 'CREATED_AT',
        'SpySspModelTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'spy_ssp_model.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'SpySspModel.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'spySspModel.updatedAt' => 'UPDATED_AT',
        'SpySspModelTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'spy_ssp_model.updated_at' => 'UPDATED_AT',
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
        $this->setName('spy_ssp_model');
        $this->setPhpName('SpySspModel');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspModel');
        $this->setPackage('src.Orm.Zed.SelfServicePortal.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_ssp_model_pk_seq');
        // columns
        $this->addPrimaryKey('id_ssp_model', 'IdSspModel', 'INTEGER', true, null, null);
        $this->addForeignKey('fk_image_file', 'FkImageFile', 'INTEGER', 'spy_file', 'id_file', false, null, null);
        $this->addColumn('code', 'Code', 'VARCHAR', false, 255, null);
        $this->addColumn('image_url', 'ImageUrl', 'VARCHAR', false, 255, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('reference', 'Reference', 'VARCHAR', true, 255, null);
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
        $this->addRelation('File', '\\Orm\\Zed\\FileManager\\Persistence\\SpyFile', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_image_file',
    1 => ':id_file',
  ),
), 'SET NULL', null, null, false);
        $this->addRelation('SpySspModelToFile', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspModelToFile', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_ssp_model',
    1 => ':id_ssp_model',
  ),
), null, null, 'SpySspModelToFiles', false);
        $this->addRelation('SpySspModelToProductList', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspModelToProductList', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_ssp_model',
    1 => ':id_ssp_model',
  ),
), 'CASCADE', null, 'SpySspModelToProductLists', false);
        $this->addRelation('SpySspAssetToSspModel', '\\Orm\\Zed\\SelfServicePortal\\Persistence\\SpySspAssetToSspModel', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':fk_ssp_model',
    1 => ':id_ssp_model',
  ),
), 'CASCADE', null, 'SpySspAssetToSspModels', false);
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
            'event' => ['spy_ssp_model_all' => ['column' => '*']],
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Method to invalidate the instance pool of all tables related to spy_ssp_model     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool(): void
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        SpySspModelToProductListTableMap::clearInstancePool();
        SpySspAssetToSspModelTableMap::clearInstancePool();
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspModel', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspModel', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspModel', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspModel', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspModel', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdSspModel', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('IdSspModel', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? SpySspModelTableMap::CLASS_DEFAULT : SpySspModelTableMap::OM_CLASS;
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
     * @return array (SpySspModel object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpySspModelTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpySspModelTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpySspModelTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpySspModelTableMap::OM_CLASS;
            /** @var SpySspModel $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpySspModelTableMap::addInstanceToPool($obj, $key);
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
            $key = SpySspModelTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpySspModelTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpySspModel $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpySspModelTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpySspModelTableMap::COL_ID_SSP_MODEL);
            $criteria->addSelectColumn(SpySspModelTableMap::COL_FK_IMAGE_FILE);
            $criteria->addSelectColumn(SpySspModelTableMap::COL_CODE);
            $criteria->addSelectColumn(SpySspModelTableMap::COL_IMAGE_URL);
            $criteria->addSelectColumn(SpySspModelTableMap::COL_NAME);
            $criteria->addSelectColumn(SpySspModelTableMap::COL_REFERENCE);
            $criteria->addSelectColumn(SpySspModelTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SpySspModelTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id_ssp_model');
            $criteria->addSelectColumn($alias . '.fk_image_file');
            $criteria->addSelectColumn($alias . '.code');
            $criteria->addSelectColumn($alias . '.image_url');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.reference');
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
            $criteria->removeSelectColumn(SpySspModelTableMap::COL_ID_SSP_MODEL);
            $criteria->removeSelectColumn(SpySspModelTableMap::COL_FK_IMAGE_FILE);
            $criteria->removeSelectColumn(SpySspModelTableMap::COL_CODE);
            $criteria->removeSelectColumn(SpySspModelTableMap::COL_IMAGE_URL);
            $criteria->removeSelectColumn(SpySspModelTableMap::COL_NAME);
            $criteria->removeSelectColumn(SpySspModelTableMap::COL_REFERENCE);
            $criteria->removeSelectColumn(SpySspModelTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(SpySspModelTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id_ssp_model');
            $criteria->removeSelectColumn($alias . '.fk_image_file');
            $criteria->removeSelectColumn($alias . '.code');
            $criteria->removeSelectColumn($alias . '.image_url');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.reference');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpySspModelTableMap::DATABASE_NAME)->getTable(SpySspModelTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpySspModel or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpySspModel object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspModelTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\SelfServicePortal\Persistence\SpySspModel) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpySspModelTableMap::DATABASE_NAME);
            $criteria->add(SpySspModelTableMap::COL_ID_SSP_MODEL, (array) $values, Criteria::IN);
        }

        $query = SpySspModelQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpySspModelTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpySspModelTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_ssp_model table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpySspModelQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpySspModel or Criteria object.
     *
     * @param mixed $criteria Criteria or SpySspModel object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpySspModelTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpySspModel object
        }

        if ($criteria->containsKey(SpySspModelTableMap::COL_ID_SSP_MODEL) && $criteria->keyContainsValue(SpySspModelTableMap::COL_ID_SSP_MODEL) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SpySspModelTableMap::COL_ID_SSP_MODEL.')');
        }


        // Set the correct dbName
        $query = SpySspModelQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
