<?php

namespace Orm\Zed\CompanyRole\Persistence\Map;

use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermission;
use Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermissionQuery;
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
 * This class defines the structure of the 'spy_company_role_to_permission' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class SpyCompanyRoleToPermissionTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    public const CLASS_NAME = 'src.Orm.Zed.CompanyRole.Persistence.Map.SpyCompanyRoleToPermissionTableMap';

    /**
     * The default database name for this class
     */
    public const DATABASE_NAME = 'zed';

    /**
     * The table name for this class
     */
    public const TABLE_NAME = 'spy_company_role_to_permission';

    /**
     * The PHP name of this class (PascalCase)
     */
    public const TABLE_PHP_NAME = 'SpyCompanyRoleToPermission';

    /**
     * The related Propel class for this table
     */
    public const OM_CLASS = '\\Orm\\Zed\\CompanyRole\\Persistence\\SpyCompanyRoleToPermission';

    /**
     * A class that can be returned by this tableMap
     */
    public const CLASS_DEFAULT = 'src.Orm.Zed.CompanyRole.Persistence.SpyCompanyRoleToPermission';

    /**
     * The total number of columns
     */
    public const NUM_COLUMNS = 4;

    /**
     * The number of lazy-loaded columns
     */
    public const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    public const NUM_HYDRATE_COLUMNS = 4;

    /**
     * the column name for the id_company_role_to_permission field
     */
    public const COL_ID_COMPANY_ROLE_TO_PERMISSION = 'spy_company_role_to_permission.id_company_role_to_permission';

    /**
     * the column name for the fk_company_role field
     */
    public const COL_FK_COMPANY_ROLE = 'spy_company_role_to_permission.fk_company_role';

    /**
     * the column name for the fk_permission field
     */
    public const COL_FK_PERMISSION = 'spy_company_role_to_permission.fk_permission';

    /**
     * the column name for the configuration field
     */
    public const COL_CONFIGURATION = 'spy_company_role_to_permission.configuration';

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
        self::TYPE_PHPNAME       => ['IdCompanyRoleToPermission', 'FkCompanyRole', 'FkPermission', 'Configuration', ],
        self::TYPE_CAMELNAME     => ['idCompanyRoleToPermission', 'fkCompanyRole', 'fkPermission', 'configuration', ],
        self::TYPE_COLNAME       => [SpyCompanyRoleToPermissionTableMap::COL_ID_COMPANY_ROLE_TO_PERMISSION, SpyCompanyRoleToPermissionTableMap::COL_FK_COMPANY_ROLE, SpyCompanyRoleToPermissionTableMap::COL_FK_PERMISSION, SpyCompanyRoleToPermissionTableMap::COL_CONFIGURATION, ],
        self::TYPE_FIELDNAME     => ['id_company_role_to_permission', 'fk_company_role', 'fk_permission', 'configuration', ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
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
        self::TYPE_PHPNAME       => ['IdCompanyRoleToPermission' => 0, 'FkCompanyRole' => 1, 'FkPermission' => 2, 'Configuration' => 3, ],
        self::TYPE_CAMELNAME     => ['idCompanyRoleToPermission' => 0, 'fkCompanyRole' => 1, 'fkPermission' => 2, 'configuration' => 3, ],
        self::TYPE_COLNAME       => [SpyCompanyRoleToPermissionTableMap::COL_ID_COMPANY_ROLE_TO_PERMISSION => 0, SpyCompanyRoleToPermissionTableMap::COL_FK_COMPANY_ROLE => 1, SpyCompanyRoleToPermissionTableMap::COL_FK_PERMISSION => 2, SpyCompanyRoleToPermissionTableMap::COL_CONFIGURATION => 3, ],
        self::TYPE_FIELDNAME     => ['id_company_role_to_permission' => 0, 'fk_company_role' => 1, 'fk_permission' => 2, 'configuration' => 3, ],
        self::TYPE_NUM           => [0, 1, 2, 3, ]
    ];

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var array<string>
     */
    protected $normalizedColumnNameMap = [
        'IdCompanyRoleToPermission' => 'ID_COMPANY_ROLE_TO_PERMISSION',
        'SpyCompanyRoleToPermission.IdCompanyRoleToPermission' => 'ID_COMPANY_ROLE_TO_PERMISSION',
        'idCompanyRoleToPermission' => 'ID_COMPANY_ROLE_TO_PERMISSION',
        'spyCompanyRoleToPermission.idCompanyRoleToPermission' => 'ID_COMPANY_ROLE_TO_PERMISSION',
        'SpyCompanyRoleToPermissionTableMap::COL_ID_COMPANY_ROLE_TO_PERMISSION' => 'ID_COMPANY_ROLE_TO_PERMISSION',
        'COL_ID_COMPANY_ROLE_TO_PERMISSION' => 'ID_COMPANY_ROLE_TO_PERMISSION',
        'id_company_role_to_permission' => 'ID_COMPANY_ROLE_TO_PERMISSION',
        'spy_company_role_to_permission.id_company_role_to_permission' => 'ID_COMPANY_ROLE_TO_PERMISSION',
        'FkCompanyRole' => 'FK_COMPANY_ROLE',
        'SpyCompanyRoleToPermission.FkCompanyRole' => 'FK_COMPANY_ROLE',
        'fkCompanyRole' => 'FK_COMPANY_ROLE',
        'spyCompanyRoleToPermission.fkCompanyRole' => 'FK_COMPANY_ROLE',
        'SpyCompanyRoleToPermissionTableMap::COL_FK_COMPANY_ROLE' => 'FK_COMPANY_ROLE',
        'COL_FK_COMPANY_ROLE' => 'FK_COMPANY_ROLE',
        'fk_company_role' => 'FK_COMPANY_ROLE',
        'spy_company_role_to_permission.fk_company_role' => 'FK_COMPANY_ROLE',
        'FkPermission' => 'FK_PERMISSION',
        'SpyCompanyRoleToPermission.FkPermission' => 'FK_PERMISSION',
        'fkPermission' => 'FK_PERMISSION',
        'spyCompanyRoleToPermission.fkPermission' => 'FK_PERMISSION',
        'SpyCompanyRoleToPermissionTableMap::COL_FK_PERMISSION' => 'FK_PERMISSION',
        'COL_FK_PERMISSION' => 'FK_PERMISSION',
        'fk_permission' => 'FK_PERMISSION',
        'spy_company_role_to_permission.fk_permission' => 'FK_PERMISSION',
        'Configuration' => 'CONFIGURATION',
        'SpyCompanyRoleToPermission.Configuration' => 'CONFIGURATION',
        'configuration' => 'CONFIGURATION',
        'spyCompanyRoleToPermission.configuration' => 'CONFIGURATION',
        'SpyCompanyRoleToPermissionTableMap::COL_CONFIGURATION' => 'CONFIGURATION',
        'COL_CONFIGURATION' => 'CONFIGURATION',
        'spy_company_role_to_permission.configuration' => 'CONFIGURATION',
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
        $this->setName('spy_company_role_to_permission');
        $this->setPhpName('SpyCompanyRoleToPermission');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orm\\Zed\\CompanyRole\\Persistence\\SpyCompanyRoleToPermission');
        $this->setPackage('src.Orm.Zed.CompanyRole.Persistence');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('spy_company_role_to_permission_pk_seq');
        $this->setIsCrossRef(true);
        // columns
        $this->addPrimaryKey('id_company_role_to_permission', 'IdCompanyRoleToPermission', 'INTEGER', true, null, null);
        $this->addForeignPrimaryKey('fk_company_role', 'FkCompanyRole', 'INTEGER' , 'spy_company_role', 'id_company_role', true, null, null);
        $this->addForeignPrimaryKey('fk_permission', 'FkPermission', 'INTEGER' , 'spy_permission', 'id_permission', true, null, null);
        $this->addColumn('configuration', 'Configuration', 'LONGVARCHAR', true, null, null);
    }

    /**
     * Build the RelationMap objects for this table relationships
     *
     * @return void
     */
    public function buildRelations(): void
    {
        $this->addRelation('Permission', '\\Orm\\Zed\\Permission\\Persistence\\SpyPermission', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_permission',
    1 => ':id_permission',
  ),
), 'CASCADE', null, null, false);
        $this->addRelation('CompanyRole', '\\Orm\\Zed\\CompanyRole\\Persistence\\SpyCompanyRole', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':fk_company_role',
    1 => ':id_company_role',
  ),
), 'CASCADE', null, null, false);
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
            '\Spryker\Zed\AclEntity\Persistence\Propel\Behavior\AclEntityBehavior' => [],
        ];
    }

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermission $obj A \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermission object.
     * @param string|null $key Key (optional) to use for instance map (for performance boost if key was already calculated externally).
     *
     * @return void
     */
    public static function addInstanceToPool(SpyCompanyRoleToPermission $obj, ?string $key = null): void
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getIdCompanyRoleToPermission() || is_scalar($obj->getIdCompanyRoleToPermission()) || is_callable([$obj->getIdCompanyRoleToPermission(), '__toString']) ? (string) $obj->getIdCompanyRoleToPermission() : $obj->getIdCompanyRoleToPermission()), (null === $obj->getFkCompanyRole() || is_scalar($obj->getFkCompanyRole()) || is_callable([$obj->getFkCompanyRole(), '__toString']) ? (string) $obj->getFkCompanyRole() : $obj->getFkCompanyRole()), (null === $obj->getFkPermission() || is_scalar($obj->getFkPermission()) || is_callable([$obj->getFkPermission(), '__toString']) ? (string) $obj->getFkPermission() : $obj->getFkPermission())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermission object or a primary key value.
     *
     * @return void
     */
    public static function removeInstanceFromPool($value): void
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermission) {
                $key = serialize([(null === $value->getIdCompanyRoleToPermission() || is_scalar($value->getIdCompanyRoleToPermission()) || is_callable([$value->getIdCompanyRoleToPermission(), '__toString']) ? (string) $value->getIdCompanyRoleToPermission() : $value->getIdCompanyRoleToPermission()), (null === $value->getFkCompanyRole() || is_scalar($value->getFkCompanyRole()) || is_callable([$value->getFkCompanyRole(), '__toString']) ? (string) $value->getFkCompanyRole() : $value->getFkCompanyRole()), (null === $value->getFkPermission() || is_scalar($value->getFkPermission()) || is_callable([$value->getFkPermission(), '__toString']) ? (string) $value->getFkPermission() : $value->getFkPermission())]);

            } elseif (is_array($value) && count($value) === 3) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1]), (null === $value[2] || is_scalar($value[2]) || is_callable([$value[2], '__toString']) ? (string) $value[2] : $value[2])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermission object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyRoleToPermission', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FkCompanyRole', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('FkPermission', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyRoleToPermission', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyRoleToPermission', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyRoleToPermission', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyRoleToPermission', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('IdCompanyRoleToPermission', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FkCompanyRole', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FkCompanyRole', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FkCompanyRole', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FkCompanyRole', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('FkCompanyRole', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('FkPermission', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('FkPermission', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('FkPermission', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('FkPermission', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 2 + $offset : static::translateFieldName('FkPermission', TableMap::TYPE_PHPNAME, $indexType)])]);
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
            $pks = [];

        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('IdCompanyRoleToPermission', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('FkCompanyRole', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 2 + $offset
                : self::translateFieldName('FkPermission', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
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
        return $withPrefix ? SpyCompanyRoleToPermissionTableMap::CLASS_DEFAULT : SpyCompanyRoleToPermissionTableMap::OM_CLASS;
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
     * @return array (SpyCompanyRoleToPermission object, last column rank)
     */
    public static function populateObject(array $row, int $offset = 0, string $indexType = TableMap::TYPE_NUM): array
    {
        $key = SpyCompanyRoleToPermissionTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SpyCompanyRoleToPermissionTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SpyCompanyRoleToPermissionTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SpyCompanyRoleToPermissionTableMap::OM_CLASS;
            /** @var SpyCompanyRoleToPermission $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SpyCompanyRoleToPermissionTableMap::addInstanceToPool($obj, $key);
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
            $key = SpyCompanyRoleToPermissionTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SpyCompanyRoleToPermissionTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var SpyCompanyRoleToPermission $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SpyCompanyRoleToPermissionTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SpyCompanyRoleToPermissionTableMap::COL_ID_COMPANY_ROLE_TO_PERMISSION);
            $criteria->addSelectColumn(SpyCompanyRoleToPermissionTableMap::COL_FK_COMPANY_ROLE);
            $criteria->addSelectColumn(SpyCompanyRoleToPermissionTableMap::COL_FK_PERMISSION);
            $criteria->addSelectColumn(SpyCompanyRoleToPermissionTableMap::COL_CONFIGURATION);
        } else {
            $criteria->addSelectColumn($alias . '.id_company_role_to_permission');
            $criteria->addSelectColumn($alias . '.fk_company_role');
            $criteria->addSelectColumn($alias . '.fk_permission');
            $criteria->addSelectColumn($alias . '.configuration');
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
            $criteria->removeSelectColumn(SpyCompanyRoleToPermissionTableMap::COL_ID_COMPANY_ROLE_TO_PERMISSION);
            $criteria->removeSelectColumn(SpyCompanyRoleToPermissionTableMap::COL_FK_COMPANY_ROLE);
            $criteria->removeSelectColumn(SpyCompanyRoleToPermissionTableMap::COL_FK_PERMISSION);
            $criteria->removeSelectColumn(SpyCompanyRoleToPermissionTableMap::COL_CONFIGURATION);
        } else {
            $criteria->removeSelectColumn($alias . '.id_company_role_to_permission');
            $criteria->removeSelectColumn($alias . '.fk_company_role');
            $criteria->removeSelectColumn($alias . '.fk_permission');
            $criteria->removeSelectColumn($alias . '.configuration');
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
        return Propel::getServiceContainer()->getDatabaseMap(SpyCompanyRoleToPermissionTableMap::DATABASE_NAME)->getTable(SpyCompanyRoleToPermissionTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a SpyCompanyRoleToPermission or Criteria object OR a primary key value.
     *
     * @param mixed $values Criteria or SpyCompanyRoleToPermission object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyRoleToPermissionTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orm\Zed\CompanyRole\Persistence\SpyCompanyRoleToPermission) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SpyCompanyRoleToPermissionTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = [$values];
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(SpyCompanyRoleToPermissionTableMap::COL_ID_COMPANY_ROLE_TO_PERMISSION, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(SpyCompanyRoleToPermissionTableMap::COL_FK_COMPANY_ROLE, $value[1]));
                $criterion->addAnd($criteria->getNewCriterion(SpyCompanyRoleToPermissionTableMap::COL_FK_PERMISSION, $value[2]));
                $criteria->addOr($criterion);
            }
        }

        $query = SpyCompanyRoleToPermissionQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SpyCompanyRoleToPermissionTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SpyCompanyRoleToPermissionTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the spy_company_role_to_permission table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(?ConnectionInterface $con = null): int
    {
        return SpyCompanyRoleToPermissionQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a SpyCompanyRoleToPermission or Criteria object.
     *
     * @param mixed $criteria Criteria or SpyCompanyRoleToPermission object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed The new primary key.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SpyCompanyRoleToPermissionTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from SpyCompanyRoleToPermission object
        }


        // Set the correct dbName
        $query = SpyCompanyRoleToPermissionQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

}
